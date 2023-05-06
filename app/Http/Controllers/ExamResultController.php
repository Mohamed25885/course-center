<?php

namespace App\Http\Controllers;

use App\Models\ExamResult;
use App\Http\Requests\StoreExamResultRequest;
use App\Http\Requests\UpdateExamResultRequest;
use App\Models\Exam;
use App\Models\Student;
use Illuminate\Http\Request;

class ExamResultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $data['exams'] = Exam::pluck('TestTitle', 'TestNo');
        $data['students'] = Student::selectRaw("concat(`FirstName`, ' ' ,`LastName`) as FullName, StudentId")
        ->pluck('FullName', 'StudentId');
        $data['results'] = ExamResult::query()
            ->with(['student:FirstName,LastName,StudentId', 'exam:TestNo,TestTitle,MinGrade'])
            ->when(request('TestNo'), fn ($q) => $q->whereRelation('exam', 'TestNo', request('TestNo'))->orderBy('Grade', 'desc'))
            ->when(request('StudentId'), fn ($q) => $q->whereRelation('student', 'StudentId', request('StudentId'))->orderBy('Grade', 'desc'))
            ->paginate();
        return view('results.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $exams = Exam::query()
            ->with(['cycle:CycleId,CoursesId', 'cycle.course:CourseId,CourseName'])
            ->get(['TestTitle', 'TestNo', 'CycleId'])
            ->each(fn ($exam) => $exam->TestTitle = $exam->TestTitle . ' - ' . $exam?->cycle?->course?->CourseName ?? '')
            ->pluck('TestTitle', 'TestNo');
        $students = Student::selectRaw("concat(`FirstName`, ' ' ,`LastName`) as FullName, StudentId")->pluck('FullName', 'StudentId');
        return view('results.create', ['result' => null, 'exams' => $exams, 'students' => $students]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreExamResultRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreExamResultRequest $request)
    {
        ExamResult::create($request->validated());
        return to_route('results.index');
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ExamResult  $result
     * @return \Illuminate\Http\Response
     */
    public function edit(ExamResult $result)
    {
        $exams = Exam::query()
            ->with(['cycle:CycleId,CoursesId', 'cycle.course:CourseId,CourseName'])
            ->get(['TestTitle', 'TestNo', 'CycleId'])
            ->each(fn ($exam) => $exam->TestTitle = $exam->TestTitle . ' - ' . $exam?->cycle?->course?->CourseName ?? '')
            ->pluck('TestTitle', 'TestNo');
        $students = Student::selectRaw("concat(`FirstName`, ' ' ,`LastName`) as FullName, StudentId")->pluck('FullName', 'StudentId');
        return view('results.create', ['result' => $result, 'exams' => $exams, 'students' => $students]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateExamResultRequest  $request
     * @param  \App\Models\ExamResult  $result
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateExamResultRequest $request, ExamResult $result)
    {
        /* dd($request->all(), $result); */
        $result->update($request->validated());
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ExamResult  $result
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExamResult $result)
    {
        $result->delete();
        return to_route('results.index');
    }
}
