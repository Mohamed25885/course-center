@extends('layouts.app_layout')

@section('content')
    <section class="section">


        <div class="section-body">


            <section class="card">
                <div class="card-header">
                    @if (empty($course))
                        <h1>Create New Course</h1>
                    @else
                        <h1>Edit {{ $course->CourseName }}</h1>
                    @endif
                </div>
                <div class="card-body">
                    @if (!empty($course) && !empty($course->Image))
                        <figure>
                            <img src="{{ $course->image_file }}" class="img-thumbnail" width="150" alt="">
                        </figure>
                    @endif
                    <form action="{{ empty($course) ? route('courses.store') : route('courses.update', $course) }}"
                        method="POST" class="mb-0" id="createEditStudent" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="CourseId" value="{{ @$course?->CourseId }}">
                        @method(empty($course) ? 'POST' : 'PUT')
                        <div class="row">
                            <x-input-form type="text" name="CourseName" :value="@$course?->CourseName" grid="col-12 col-md-6">
                                Course Name</x-input-form>
                            <x-input-form type="text" name="Slug" :value="@$course?->Slug" grid="col-12 col-md-6">
                                Course Slug</x-input-form>
                            <x-input-form type="file" name="Image" :value="@$course?->Image" grid="col-12 col-md-6">
                                Thumbnail</x-input-form>
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
