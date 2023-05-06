@extends('layouts.app_layout')

@section('content')
    <section class="section">



        <div class="section-body">


            <section class="card">
                <div class="card-body">
                    <form method="get" class="mb-0">
                        <div class="row align-items-baseline">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="input-label">Search</label>
                                    <input type="search" class="form-control" name="search"
                                        value="{{ request()->get('search') }}">
                                </div>
                            </div>

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
                            <a href="{{ route('students.create') }}" class="btn btn-primary">Create New Student</a>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped font-14">
                                    <tr>
                                        <th>#</th>
                                        <th class="text-left">Name</th>
                                        <th class="text-left">Email</th>
                                        <th class="text-left">Phone</th>
                                        <th class="text-left">Age</th>

                                        <th width="120">Actions</th>
                                    </tr>

                                    @foreach ($students as $student)
                                        <tr>
                                            <td>{{ $student->StudentId }}</td>

                                            <td class="text-left">
                                                {{ $student->full_name }}
                                            </td>
                                            <td class="text-left">
                                                {{ $student->Email }}
                                            </td>
                                            <td class="text-left">
                                                {{ $student->Phone }}
                                            </td>
                                            <td class="text-left">
                                                {{ $student->BirthDate->age }}
                                            </td>


                                            <td>
                                                <div class="btn-group dropdown table-actions">
                                                    <button type="button" class="btn-transparent dropdown-toggle"
                                                        data-bs-toggle="dropdown" aria-bs-haspopup="true"
                                                        aria-bs-expanded="false">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <div class="dropdown-menu text-left webinars-lists-dropdown">
                                                        <a href="{{ route('students.edit', $student) }}"
                                                            class="d-flex align-items-center text-dark text-decoration-none btn-transparent btn-sm text-primary mt-1 ">
                                                            <i class="fa fa-history" aria-bs-hidden="true"></i>
                                                            <span>Edit</span>
                                                        </a>

                                                        <a href="{{ route('student-enrollments', ['student'=>$student]) }}"
                                                            class="d-flex align-items-center text-dark text-decoration-none btn-transparent btn-sm text-primary mt-1 ">
                                                            <i class="fa fa-history" aria-bs-hidden="true"></i>
                                                            <span>Enrollments</span>
                                                        </a>

                                                        <a href="{{ route('results.index', ['StudentId'=>$student->StudentId]) }}"
                                                            class="d-flex align-items-center text-dark text-decoration-none btn-transparent btn-sm text-primary mt-1 ">
                                                            <i class="fa fa-history" aria-bs-hidden="true"></i>
                                                            <span>Exams' Results</span>
                                                        </a>

                                                        <form action="{{ route('students.destroy', $student) }}" method="post">
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
                            {{ $students->appends(request()->input())->links() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
