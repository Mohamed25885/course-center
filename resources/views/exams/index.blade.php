@extends('layouts.app_layout')

@section('content')
    <section class="section">



        <div class="section-body">


            <section class="card">
                <div class="card-body">
                    <form method="get" class="mb-0">
                        <div class="row align-items-baseline">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="input-label">Search</label>
                                    <input type="search" class="form-control" name="search"
                                        value="{{ request()->get('search') }}">
                                </div>
                            </div>

                            <x-select-form reset=true name='CourseId' grid="col-md-4" :selected="request('CourseId')" :values=$courses>
                                Course
                            </x-select-form>

                            <div class="col-md-3">
                                <div class="form-group mt-1">
                                    <label class="input-label mb-4"> </label>
                                    <input type="submit" class="text-center btn btn-secondary w-100" value="Show Results">
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </section>

            <div class="row mt-4">
                <div class="col-12 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('exams.create') }}" class="btn btn-primary">Create New Exam</a>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped font-14">
                                    <tr>
                                        <th>#</th>
                                        <th class="text-left">Name</th>
                                        <th class="text-center">Cycle</th>
                                        <th class="text-center">Min Grade</th>
                                        <th class="text-center">Avg Grades</th>
                                        <th class="text-center">Date</th>
                                        <th class="text-center">Duration</th>

                                        <th width="120">Actions</th>
                                    </tr>

                                    @foreach ($exams as $exam)
                                        <tr>
                                            <td>{{ $exam->TestNo }}</td>

                                            <td class="text-left">
                                                {{ $exam->TestTitle }}
                                            </td>
                                            <td class="text-center d-flex flex-column">
                                                <span>{{ $exam->cycle->StartDate->format('Y-m-d') }} -
                                                    {{ $exam->cycle->EndDate->format('Y-m-d') }}</span>
                                                <small>{{ $exam->cycle->course->CourseName }}</small>
                                            </td>
                                            <td class="text-center">
                                                {{$exam?->MinGrade??0}}
                                            </td>
                                            <td class="text-center">
                                                {{round($exam?->results_avg_grade??0,2)}}
                                            </td>
                                            <td class="text-center">
                                                {{ $exam->TestDate->format('Y-m-d') }}
                                            </td>

                                            <td class="text-center">
                                                {{ $exam->TestDuration }} min(s)
                                            </td>

                                            <td>
                                                <div class="btn-group dropdown table-actions">
                                                    <button type="button" class="btn-transparent dropdown-toggle"
                                                        data-bs-toggle="dropdown" aria-bs-haspopup="true"
                                                        aria-bs-expanded="false">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <div class="dropdown-menu text-left webinars-lists-dropdown">
                                                        <a href="{{ route('exams.edit', $exam) }}"
                                                            class="d-flex align-items-center text-dark text-decoration-none btn-transparent btn-sm text-primary mt-1 ">
                                                            <i class="fa fa-history" aria-bs-hidden="true"></i>
                                                            <span>Edit</span>
                                                        </a>
                                                        <a href="{{ route('results.index', ['TestNo'=>$exam->TestNo]) }}"
                                                            class="d-flex align-items-center text-dark text-decoration-none btn-transparent btn-sm text-primary mt-1 ">
                                                            <i class="fa fa-history" aria-bs-hidden="true"></i>
                                                            <span>Results</span>
                                                        </a>

                                                        <form action="{{ route('exams.destroy', $exam) }}" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button
                                                                class="d-flex align-items-center text-dark text-decoration-none btn-transparent btn-sm text-primary mt-1 ">
                                                                <i class="fa fa-history" aria-bs-hidden="true"></i>
                                                                <span>Delete</span>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                </table>
                            </div>
                        </div>

                        <div class="card-footer text-center">
                            {{ $exams->appends(request()->input())->links() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
