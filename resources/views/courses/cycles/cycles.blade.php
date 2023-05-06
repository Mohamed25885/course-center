<hr>
<div class="container">
    <div class="row">
        <div class="col-12 d-flex justify-content-between align-items-baseline">
            <h4>Cycles</h4>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createCycleModalForm">
                Add Cycle</button>
        </div>
        <div class="col-12 mt-4 pb-4">
            @if (!empty($course->cycles))
                <div class="accordion" id="courseCycles">


                    @foreach ($course->cycles as $cycle)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading{{ $cycle->CycleId }}">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse{{ $cycle->CycleId }}" aria-expanded="false"
                                    aria-controls="collapse{{ $cycle->CycleId }}">
                                    {{ $cycle->StartDate->format('M d') }} - {{ $cycle->EndDate->format('M d') }}
                                </button>
                            </h2>
                            <div id="collapse{{ $cycle->CycleId }}" class="accordion-collapse collapse"
                                aria-labelledby="heading{{ $cycle->CycleId }}" data-bs-parent="#courseCycles">
                                <div class="accordion-body">
                                    <div class="row">
                                        <div class="col-12 mb-2">
                                            <div class="row">
                                                <div class="col-6">
                                                    <h5>From {{ $cycle->StartDate->format('Y M d') }}</h5>
                                                </div>
                                                <div class="col-6">
                                                    <h5>To {{ $cycle->EndDate->format('Y M d') }}</h5>
                                                </div>
                                                <div class="col-12">
                                                    By <a href="{{ route('teachers.edit', @$cycle->teacher ?? '-1') }}">
                                                        {{ @$cycle->teacher?->full_name ?? 'N/a' }}</a>
                                                </div>
                                                @if (!empty(@$cycle->classes[0]))
                                                    <div class="col-12">
                                                        From {{week_days(@$cycle->classes[0]->start_day) ?? ''}} To {{week_days(@$cycle->classes[0]?->end_day) ?? ''}}
                                                    </div>
                                                @endif
                                                <div class="col-12">
                                                    <p>
                                                        {{ $cycle->CycleDescription }}
                                                    </p>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-12 d-flex justify-content-around">
                                            <a href="{{ route('cycles.enrollments.index', $cycle) }}"
                                                class="btn btn-primary">Students</a>
                                            <a href="{{ route('cycles.classes.index', $cycle) }}"
                                                class="btn btn-warning">Classes</a>
                                            <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                                                data-bs-target="#updateCycle{{ $cycle->CycleId }}ModalForm">
                                                Update</button>
                                            <form action="{{ route('cycles.destroy', $cycle) }}" method="post"
                                                class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-danger">Delete</button>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @push('scripts_bottom')
                            @include('courses.cycles.editCycle', ['cycle' => $cycle])
                        @endpush
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@push('scripts_bottom')
    @include('courses.cycles.createCycle')
@endpush
