<?php

namespace App\Http\Controllers;

use App\Models\{Enrollment, Student};
use Illuminate\Http\Request;

class StudentEnrollmentController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Student $student)
    {
        $enrollments = Enrollment::query()
            ->where('StudentId', $student->StudentId)->where('Cancelled', false)
            ->with(['cycle:CycleId,StartDate,EndDate,CoursesId', 'cycle.course:CourseId,CourseName'])
            ->paginate();
        return view('students.enrollments', ['student' => $student, 'enrollments'=>$enrollments]);
    }
}
