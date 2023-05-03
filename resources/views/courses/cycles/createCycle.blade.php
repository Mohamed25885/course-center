<div class="modal fade" id="createCycleModalForm" tabindex="-1" aria-labelledby="createCycleModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title" id="createCycleModal">Create New Cycle</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('cycles.store',$course) }}" method="post" id="createCycleForm">
                    @csrf
                    <div class="row">
                        <x-select-form type="date" name="TeacherId" grid="col-12" :values=$teachers>Teacher
                        </x-select-form>

                        <x-input-form type="date" name="StartDate" grid="col-12 col-md-6">Start Date</x-input-form>
                        <x-input-form type="date" name="EndDate" grid="col-12 col-md-6">End Date</x-input-form>
                        <x-textarea-form type="text" name="CycleDescription" grid="col-12"
                            placeholder="Cycle Description">
                        </x-textarea-form>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" form="createCycleForm" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
