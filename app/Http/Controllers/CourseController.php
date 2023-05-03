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
        Course::create(
            $request->validated()
        );
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
            return $q->orderBy('StartDate')->orderBy('EndDate')->with('teacher:TeacherId,FirstName,LastName');
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
        $course->update(
            $request->validated()
        );
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
