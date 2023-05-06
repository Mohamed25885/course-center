<div class="modal fade" id="updateCycleEnrollment{{ $enrollment->EnrollmentID }}" tabindex="-1"
    aria-labelledby="updateCycleEnrollment{{ $enrollment->EnrollmentID }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title" id="updateCycleEnrollment{{ $enrollment->EnrollmentID }}">Create New Cycle</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form
                    action="{{ route('cycles.enrollments.update', ['courseCycles' => $cycle, 'enrollment' => $enrollment]) }}"
                    method="post" id="updateEnrollmentForm{{ $enrollment->EnrollmentID }}">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        @php
                            $yes_no_values = ['1' => 'Yes', '0' => 'No'];

                        @endphp

                        <x-input-form type="date" name="EnrollDate" :value="$enrollment->EnrollDate->format('Y-m-d')" grid="col-12 col-md-6">Start
                            Date</x-input-form>

                        <x-radio-form name="Cancelled" :values="$yes_no_values" :checked="$enrollment->Cancelled">
                            Cancelled
                        </x-radio-form>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" form="updateEnrollmentForm{{ $enrollment->EnrollmentID }}"
                    class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
