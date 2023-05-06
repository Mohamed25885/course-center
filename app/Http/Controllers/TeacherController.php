<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Http\Requests\StoreTeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teachers = Teacher::query()
            ->when(request('search'), function ($q) {
                $search = strtolower(request('search'));
                $q->where('FirstName', 'like', "%" . $search . "%")
                    ->orWhere('LastName', 'like', "%" . $search . "%")
                    ->when(is_email($search), fn ($q) => $q->orWhere('Email', 'like', "%" . $search  . "%"))
                    ->when(is_integer($search), fn ($q) => $q->orWhere('Phone', 'like', "%" . request('search') . "%"));
            })
            ->paginate();
        $data = [
            'teachers' => $teachers,
        ];
        return view('teachers.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('teachers.create', ['teacher' => null]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTeacherRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTeacherRequest $request)
    {
        $teacher = Teacher::create(
            $request->except(['Image'])
        );
        if ($request->hasFile('Image')) {
            $teacher->image_file = $request->file('Image');
            $teacher->save();
        }
        return to_route('teachers.index');
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit(Teacher $teacher)
    {
        return view('teachers.create', ['teacher' => $teacher]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTeacherRequest  $request
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTeacherRequest $request, Teacher $teacher)
    {
        $teacher->fill(
            $request->except(['Image'])
        );
        if ($request->hasFile('Image')) {
            $teacher->image_file = $request->file('Image');
        }
        $teacher->save();
        return to_route('teachers.edit', $teacher);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $teacher)
    {
        $teacher->delete();
        return to_route('teachers.index');
    }
}
