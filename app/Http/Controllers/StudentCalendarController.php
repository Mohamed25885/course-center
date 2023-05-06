<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Carbon\{Carbon, CarbonPeriod};

use Illuminate\Http\Request;

class StudentCalendarController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Student $student)
    {
        $student->with(['cycles' => function ($q) {
            return $q->with([
                    'exams' => fn ($q) => $q->orderBy('TestDate'),
                    'classes' => fn ($q) => $q->orderBy('ClassDay'),
                ]);
        }]);
        $exams = $student->cycles?->map(fn ($i) => $i->exams)?->flatten() ?? [];
        $classes = $student->cycles?->map(fn ($i) => $i->classes)?->flatten()  ?? [];
        $start = Carbon::now()->subDays(15);
        $end = Carbon::now()->addDays(15);
        $days = CarbonPeriod::create($start->copy()->format('Y-m-d'), $end->copy()->format('Y-m-d'));
        $labels = CarbonPeriod::create($start->copy()->format('Y-m-d'), $start->copy()->addDays(6)->format('Y-m-d'));
        return view('students.calendar', ['student' => $student, 'classes' => $classes, 'exams' => $exams, 'days' => $days, 'labels' => $labels]);
    }
}
