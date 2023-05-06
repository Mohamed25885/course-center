<?php

namespace App\Traits;

use App\Models\Course;
use App\Models\CourseCycles;
use App\Models\Enrollment;
use App\Models\Exam;
use App\Models\ExamResult;
use App\Models\Student;
use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

trait HomeReports
{
    public function examsReport()
    {

        return [
            'title' => 'Total Exams',
            'total' => Exam::count(),
            'icon' => 'fa-scroll',
            'sub_title' => 'Total Passed',
            'sub' => Exam::query()->join('examsgrades as res', 'res.TestNo', '=', 'exams.TestNo')
                ->whereRaw('res.Grade >= coalesce(exams.MinGrade, 0)')->count(),
        ];
    }
    public function coursesReport()
    {

        return [
            'title' => 'Total Courses',
            'total' => Course::count(),
            'icon' => 'fa-school',
            'sub_title' => 'Total Cycles',
            'sub' => CourseCycles::count(),
        ];
    }
    public function enrollmentsReport()
    {

        return [
            'title' => 'Total Enrollments',
            'total' => Enrollment::count(),
            'icon' => 'fa-graduation-cap',
            'sub_title' => 'Total Cancelled Enrollment',
            'sub' => Enrollment::where('Cancelled', true)->count(),
        ];
    }
    public function studentsReport()
    {

        return [
            'title' => 'Total Students',
            'total' => Student::count(),
            'icon' => 'fa-users',
            'sub_title' => '',
            'sub' => '',
        ];
    }
    public function teachersReport()
    {

        return [
            'title' => 'Total Teachers',
            'total' => Teacher::count(),
            'icon' => 'fa-user',
            'sub_title' => '',
            'sub' => '',
        ];
    }
}
