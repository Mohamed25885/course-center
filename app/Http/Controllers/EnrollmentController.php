<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEnrollmentRequest;
use App\Http\Requests\UpdateEnrollmentRequest;
use App\Models\CourseCycles;
use App\Models\Enrollment;
use App\Models\Student;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CourseCycles $courseCycles)
    {
        $data = [
            'cycle' => $courseCycles->load('course'),
            'enrollments' => $courseCycles->enrollments()->with(['student'])->orderBy('EnrollDate', 'desc')->paginate(),
            'students' => Student::select('FirstName', 'LastName', 'StudentId')->get()->pluck('full_name', 'StudentId')
        ];
        return view('courses.enrollments.enrollments', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEnrollmentRequest $request, CourseCycles $courseCycles)
    {
        $courseCycles->enrollments()->updateOrCreate(
            ['StudentId' => $request->StudentId],
            [
                'Cancelled' => false,
                'EnrollDate' => $request->EnrollDate,

            ]
        );
        return back();
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEnrollmentRequest $request, CourseCycles $courseCycles, Enrollment $enrollment)
    {
        $courseCycles->enrollments()->updateOrCreate(
            ['EnrollmentID' => $enrollment->EnrollmentID],
            [
                'Cancelled' => $request->Cancelled,
                'EnrollDate' => $request->EnrollDate,
            ]
        );
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Enrollment $enrollment)
    {
        $enrollment->delete();
        return back();
    }
}
