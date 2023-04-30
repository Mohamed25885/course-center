<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::query()
            ->when(request('search'), function ($q) {
                $search = strtolower(request('search'));
                $q->where('FirstName', 'like', "%" . $search . "%")
                    ->orWhere('LastName', 'like', "%" . $search . "%")
                    ->when(is_email($search), fn ($q) => $q->orWhere('Email', 'like', "%" . $search  . "%"))
                    ->when(is_integer($search), fn ($q) => $q->orWhere('Phone', 'like', "%" . request('search') . "%"));
            })
            ->paginate();
        $data = [
            'students' => $students,
        ];
        return view('students.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('students.create', ['student' => null]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreStudentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStudentRequest $request)
    {
        Student::create(
            $request->validated()
        );
        return to_route('students.index');
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        return view('students.create', ['student' => $student]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStudentRequest  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        $student->update(
            $request->validated()
        );
        return to_route('students.edit', $student);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return to_route('students.index');
    }
}
