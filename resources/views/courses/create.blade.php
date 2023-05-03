@extends('layouts.app_layout')

@section('content')
    <section class="section">


        <div class="section-body">


            <section class="card">
                <div class="card-header">
                    <h1>Create New Student</h1>
                </div>
                <div class="card-body">
                    <form action="{{ empty($course) ? route('courses.store') : route('courses.update', $course) }}"
                        method="POST" class="mb-0" id="createEditStudent">
                        @csrf
                        <input type="hidden" name="CourseId" value="{{ @$course?->CourseId }}">
                        @method(empty($course) ? 'POST' : 'PUT')
                        <div class="row">
                            <x-input-form type="text" name="CourseName" :value="@$course?->CourseName" grid="col-8">
                                Course Name</x-input-form>
                            <x-textarea-form type="text" name="CourseDescription" placeholder="Course Description">
                                {{ @$course?->CourseDescription }}
                            </x-textarea-form>

                        </div>
                    </form>
                </div>

                @if (!empty($course))
                    @include('courses.cycles.cycles')
                @endif
            </section>

            <div class="row mt-4">
                <div class="col-12 col-md-12">
                    <button type="submit" form="createEditStudent" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </section>
@endsection
