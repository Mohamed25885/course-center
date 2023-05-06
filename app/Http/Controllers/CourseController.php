<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Models\Teacher;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::query()
            ->when(request('search'), function ($q) {
                $search = strtolower(request('search'));
                $q->where('CourseName', 'like', "%" . $search . "%");
            })
            ->withCount([
                'cycles',
                'enrollments as total_enrollment',
                'enrollments as active_enrollment' => fn ($q) => $q->where('Cancelled', false)
            ])
            ->paginate();
        $data = [
            'courses' => $courses,
        ];
        return view('courses.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('courses.create', ['course' => null]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCourseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCourseRequest $request)
    {
        $course = Course::create(
            $request->except(['Image'])
        );
        if ($request->hasFile('Image')) {
            $course->image_file = $request->file('Image');
            $course->save();
        }
        return to_route('courses.index');
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        $teachers = Teacher::select('FirstName', 'LastName', 'TeacherId')->get()->pluck('full_name', 'TeacherId');
        $course = $course->load(['cycles' => function ($q) {
            return $q->orderBy('StartDate')->orderBy('EndDate')->with([
                'teacher:TeacherId,FirstName,LastName',
                'classes' => function ($q) {
                    return $q->selectRaw('max(ClassDay) as end_day, min(ClassDay) as start_day, CycleId')->groupBy('CycleId')->limit(1);
                }
            ]);
        }]);
        return view('courses.create', ['course' =>  $course, 'teachers' => $teachers]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCourseRequest  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCourseRequest $request, Course $course)
    {

        $course->fill(
            $request->except(['Image'])
        );
        if ($request->hasFile('Image')) {

            $course->image_file = $request->file('Image');
        }
        $course->save();
        return to_route('courses.edit', $course);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        $course->delete();
        return to_route('courses.index');
    }
}
