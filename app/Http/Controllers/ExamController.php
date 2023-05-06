<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Http\Requests\StoreExamRequest;
use App\Http\Requests\UpdateExamRequest;
use App\Models\Course;
use App\Models\CourseCycles;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exams = Exam::with('cycle.course')
            ->when(request('search'), function ($q) {

                return $q->where('TestTitle', 'LIKE', '%' . request('search') . '%');
            })
            ->when(request('CourseId'), function ($q) {
                return $q->whereRelation('cycle.course', 'CoursesId', request('CourseId'));
            })
            ->withAvg('results','Grade')
            ->paginate();

        $courses = Course::pluck('CourseName', 'CourseId');
        return view('exams.index', ['exams' => $exams, 'courses' => $courses]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cycles = CourseCycles::selectRaw("CycleId, CoursesId, concat(`StartDate`, ' - ', `EndDate`) as Title")
            ->with('course:CourseId,CourseName')
            ->get()
            ->groupBy('course.CourseName')
            ->map(fn ($i) => $i->pluck('Title', 'CycleId'))
            ->toArray();

        return view('exams.create', ['exam' => null, 'cycles' => $cycles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreExamRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreExamRequest $request)
    {
        Exam::create($request->validated());
        return to_route('exams.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function edit(Exam $exam)
    {
        $cycles = CourseCycles::selectRaw("CycleId, CoursesId, concat(`StartDate`, ' - ', `EndDate`) as Title")
            ->with('course:CourseId,CourseName')
            ->get()
            ->groupBy('course.CourseName')
            ->map(fn ($i) => $i->pluck('Title', 'CycleId'))
            ->toArray();

        return view('exams.create', ['exam' => $exam, 'cycles' => $cycles]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateExamRequest  $request
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateExamRequest $request, Exam $exam)
    {
        $exam->update($request->validated());
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exam $exam)
    {
        $exam->delete();
        return to_route('exams.index');
    }
}
