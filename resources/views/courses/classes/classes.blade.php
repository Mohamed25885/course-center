@extends('layouts.app_layout')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ $cycle->course->CourseName }}</h1>
            <h4>Cycle: {{ $cycle->StartDate->format('M d') }} - {{ $cycle->EndDate->format('M d') }}</h4>
        </div>


        <div class="section-body">

            {{-- <section class="card">
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
            </section> --}}


            <div class="row mt-4">
                <div class="col-12 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#createCycleClass">
                                Create New Class</button>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped font-14">
                                    <tr>
                                        <th>#</th>
                                        <th class="text-left">Title</th>
                                        <th class="text-center">Day</th>
                                        <th class="text-center">Start Time</th>
                                        <th class="text-center">End Time</th>


                                        <th width="120">Actions</th>
                                    </tr>

                                    @foreach ($classes as $class)
                                        <tr>
                                            <td>{{ $class->ClassNo }}</td>

                                            <td class="text-left">
                                                {{ $class->ClassTitle }}
                                            </td>
                                            <td class="text-center">
                                                {{ week_days($class->ClassDay) }}
                                            </td>
                                            <td class="text-center">
                                                {{ $class->StartTime->format('h:i A') }}
                                            </td>
                                            <td class="text-center">
                                                {{ $class->EndTime->format('h:i A') }}
                                            </td>

                                            <td>
                                                <div class="btn-group dropdown table-actions">
                                                    <button type="button" class="btn-transparent dropdown-toggle"
                                                        data-bs-toggle="dropdown" aria-bs-haspopup="true"
                                                        aria-bs-expanded="false">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <div class="dropdown-menu text-left webinars-lists-dropdown">

                                                        <a href="javascript:void(0);" data-bs-toggle="modal"
                                                            data-bs-target="#updateCycleClass{{ $class->ClassNo }}"
                                                            class="d-flex align-items-center text-dark text-decoration-none btn-transparent btn-sm text-primary mt-1 ">
                                                            <i class="fa fa-history" aria-bs-hidden="true"></i>
                                                            <span>Edit</span>
                                                        </a>

                                                        <form
                                                            action="{{ route('cycles.classes.destroy', ['courseCycles' => $cycle, 'cycleClass' => $class]) }}"
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

                                        @push('scripts_bottom')
                                            @include('courses.classes.editClass', [
                                                'class' => $class,
                                            ])
                                        @endpush
                                    @endforeach

                                </table>
                            </div>
                        </div>

                        <div class="card-footer text-center">
                            {{ $classes->appends(request()->input())->links() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts_bottom')
    @include('courses.classes.createClass')
@endpush
