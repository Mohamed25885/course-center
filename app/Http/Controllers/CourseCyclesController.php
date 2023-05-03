<?php

namespace App\Http\Controllers;

use App\Models\CourseCycles;
use App\Http\Requests\StoreCourseCyclesRequest;
use App\Http\Requests\UpdateCourseCyclesRequest;
use App\Models\Course;

class CourseCyclesController extends Controller
{




    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCourseCyclesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCourseCyclesRequest $request, Course $course)
    {
        $course->cycles()->create($request->validated());
        return back();
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CourseCycles  $courseCycles
     * @return \Illuminate\Http\Response
     */
    public function edit(CourseCycles $courseCycles)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCourseCyclesRequest  $request
     * @param  \App\Models\CourseCycles  $courseCycles
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCourseCyclesRequest $request, Course $course, CourseCycles $courseCycles)
    {
        $course->cycles()->updateOrCreate(["CycleId" => $courseCycles->CycleId], $request->validated());
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CourseCycles  $courseCycles
     * @return \Illuminate\Http\Response
     */
    public function destroy(CourseCycles $courseCycles)
    {
        $courseCycles->delete();
        return back();
    }
}
