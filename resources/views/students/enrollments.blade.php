@extends('layouts.app_layout')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1><strong>{{ $student->full_name }}</strong> Enrollments</h1>
        </div>


        <div class="section-body">



            <div class="row mt-4">
                <div class="col-12 col-md-12">
                    <div class="card">


                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped font-14">
                                    <tr>
                                        <th>#</th>
                                        <th class="text-left">Course</th>
                                        <th class="text-left">Cycle</th>
                                        <th class="text-center">Enrollment Date</th>
                                        <th class="text-center">Is cancelled?</th>


                                        <th width="120">Actions</th>
                                    </tr>

                                    @foreach ($enrollments as $enrollment)
                                        <tr>
                                            <td>{{ $enrollment->EnrollmentID }}</td>

                                            <td class="text-left">
                                                <a href="{{ route('courses.edit', $enrollment->cycle?->course ?? -1) }}">
                                                    {{ $enrollment->cycle?->course?->CourseName ?? 'N/a' }}
                                                </a>
                                            </td>
                                            <td class="text-left">
                                                From {{ @$enrollment->cycle?->StartDate?->format('M d') ?? 'N/a' }} To
                                                {{ @$enrollment->cycle?->EndDate?->format('M d') ?? 'N/a' }}
                                            </td>
                                            <td class="text-center">
                                                {{ $enrollment->EnrollDate->format('Y-m-d') }}
                                            </td>
                                            <td class="text-center">
                                                @if ($enrollment->Cancelled)
                                                    <span class="text-danger">Yes</span>
                                                @else
                                                    <span class="text-success">No</span>
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

                                                        <a href="javascript:void(0);" data-bs-toggle="modal"
                                                            data-bs-target="#updateCycleEnrollment{{ $enrollment->EnrollmentID }}"
                                                            class="d-flex align-items-center text-dark text-decoration-none btn-transparent btn-sm text-primary mt-1 ">
                                                            <i class="fa fa-history" aria-bs-hidden="true"></i>
                                                            <span>Edit</span>
                                                        </a>

                                                        <form
                                                            action="{{ route('cycles.enrollments.destroy', $enrollment) }}"
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
                                            @include('courses.enrollments.editEnrollment', [
                                                'enrollment' => $enrollment,
                                                'cycle' => $enrollment->cycle,
                                            ])
                                        @endpush
                                    @endforeach

                                </table>
                            </div>
                        </div>

                        <div class="card-footer text-center">
                            {{ $enrollments->appends(request()->input())->links() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
