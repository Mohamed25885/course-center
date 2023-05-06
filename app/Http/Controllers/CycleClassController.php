<?php

namespace App\Http\Controllers;

use App\Models\CycleClass;
use App\Http\Requests\StoreCycleClassRequest;
use App\Http\Requests\UpdateCycleClassRequest;
use App\Models\CourseCycles;
use App\Models\Teacher;

class CycleClassController extends Controller
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
            'classes' => $courseCycles->classes()->orderBy('ClassDay', 'asc')->paginate(),
            'days' => week_days(),
        ];
        return view('courses.classes.classes', $data);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCycleClassRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCycleClassRequest $request, CourseCycles $courseCycles)
    {
        $courseCycles->classes()->create($request->validated());
        return back();
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCycleClassRequest  $request
     * @param  \App\Models\CycleClass  $cycleClass
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCycleClassRequest $request, CourseCycles $courseCycles, CycleClass $cycleClass)
    {
        $courseCycles->classes()->updateOrCreate(
            ['ClassNo' => $cycleClass->ClassNo],
            $request->validated(),
        );
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CycleClass  $cycleClass
     * @return \Illuminate\Http\Response
     */
    public function destroy(CourseCycles $courseCycles, CycleClass $cycleClass)
    {
        $courseCycles->classes()->where('ClassNo', $cycleClass->ClassNo)->delete();

        return back();
    }
}
