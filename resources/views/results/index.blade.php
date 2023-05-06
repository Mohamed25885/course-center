@extends('layouts.app_layout')

@section('content')
    <section class="section">



        <div class="section-body">


            <section class="card">
                <div class="card-body">
                    <form method="get" class="mb-0">
                        <div class="row align-items-baseline">


                            <x-select-form reset=true name='TestNo' grid="col-md-4" :selected="request('TestNo')" :values=$exams>
                                Exams
                            </x-select-form>
                            <x-select-form reset=true name='StudentId' grid="col-md-4" :selected="request('StudentId')" :values=$students>
                                Students
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
                            <a href="{{ route('results.create') }}" class="btn btn-primary">Create New Result</a>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped font-14">
                                    <tr>
                                        <th>#</th>
                                        <th class="text-left">Student Name</th>
                                        <th class="text-center">Exam</th>
                                        <th class="text-center">Grade</th>
                                        <th class="text-center">Passed</th>

                                        <th width="120">Actions</th>
                                    </tr>

                                    @foreach ($results as $result)
                                        <tr>
                                            <td>{{ $result->GradeId }}</td>
                                            <td class="text-left">
                                                <a href="{{ route('students.edit', $result?->student ?? -1) }}">
                                                    {{ @$result->student->full_name ?? 'N/a' }}
                                                </a>
                                            </td>

                                            <td class="text-center">
                                                <a href="{{ route('exams.edit', $result?->exam ?? -1) }}">
                                                    {{ @$result->exam?->TestTitle ?? 'N/a' }}
                                                </a>
                                            </td>


                                            <td class="text-center">
                                                {{ $result->Grade }}
                                            </td>
                                            <td class="text-center">
                                                @if (empty($result->exam))
                                                @elseif ($result->Grade >= $result->exam->MinGrade)
                                                    <span class="text-success">Yes</span>
                                                @else
                                                    <span class="text-danger">No</span>
                                                @endif
                                            </td>

                                            <td>
                                                <div class="btn-group dropdown table-actions">
                                                    <button type="button" class="btn-transparent dropdown-toggle"
                                                        data-bs-toggle="dropdown" aria-bs-haspopup="true"
                                                        aria-bs-expanded="false">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <div class="dropdown-menu text-left webinars-lists-dropdown">
                                                        <a href="{{ route('results.edit', $result) }}"
                                                            class="d-flex align-items-center text-dark text-decoration-none btn-transparent btn-sm text-primary mt-1 ">
                                                            <i class="fa fa-history" aria-bs-hidden="true"></i>
                                                            <span>Edit</span>
                                                        </a>

                                                        <form action="{{ route('results.destroy', $result) }}"
                                                            method="post">
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
                            {{ $results->appends(request()->input())->links() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
