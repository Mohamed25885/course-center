<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Traits\HomeReports;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    use HomeReports;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $data = ['reports' => [
            $this->coursesReport(),
            $this->enrollmentsReport(),
            $this->examsReport(),
            $this->studentsReport(),
            $this->teachersReport()
        ]];

        return view('dashboard.home', $data);
    }
}
