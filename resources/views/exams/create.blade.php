@extends('layouts.app_layout')

@section('content')
    <section class="section">


        <div class="section-body">


            <section class="card">
                <div class="card-header">
                    @if (!empty($exam))
                        <h1>Edit {{ $exam->TestTitle }}</h1>
                    @else
                        <h1>Create New Exam</h1>
                    @endif
                </div>
                <div class="card-body">
                    <form action="{{ empty($exam) ? route('exams.store') : route('exams.update', $exam) }}" method="POST"
                        class="mb-0" id="createEditExam">
                        @csrf
                        <input type="hidden" name="TestNo" value="{{ @$exam?->TestNo }}">
                        @method(empty($exam) ? 'POST' : 'PUT')
                        <div class="row">
                            <x-input-form type="text" name="TestTitle" :value="@$exam?->TestTitle">
                                Exam Title</x-input-form>
                            <x-select-group-form name="CycleId" :selected="@$exam->CycleId" :values=$cycles>Course Cycle
                            </x-select-group-form>
                            <x-input-form type="text" name="MinGrade" :value="@$exam?->MinGrade">
                                Minimum Grade</x-input-form>
                            <x-input-form type="date" name="TestDate" :value="@$exam?->TestDate?->format('Y-m-d')">
                                Date</x-input-form>
                            <x-input-form type="time" name="TestTime" :value="@$exam?->TestTime?->format('H:i')">
                                Time</x-input-form>
                            <x-input-form type="number" name="TestDuration" :value="@$exam?->TestDuration">
                                Duration (in mins)</x-input-form>
                        </div>
                    </form>
                </div>
            </section>

            <div class="row mt-4">
                <div class="col-12 col-md-12">
                    <button type="submit" form="createEditExam" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </section>
@endsection
