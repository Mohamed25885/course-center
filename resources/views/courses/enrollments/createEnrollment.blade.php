<div class="modal fade" id="createCycleEnrollment" tabindex="-1" aria-labelledby="createEnrollmentModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title" id="createEnrollmentModal">Create New Cycle</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('cycles.enrollments.store', $cycle) }}" method="post" id="createEnrollmentForm">
                    @csrf
                    <div class="row">
                        <x-select-form type="date" name="StudentId" grid="col-12" :values=$students>Student
                        </x-select-form>

                        <x-input-form type="date" name="EnrollDate" grid="col-12 col-md-6">Enrollment Date</x-input-form>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" form="createEnrollmentForm" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
