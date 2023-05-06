<div class="modal fade" id="createCycleClass" tabindex="-1" aria-labelledby="createClassModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title" id="createClassModal">Create New Cycle</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('cycles.classes.store', $cycle) }}" method="post" id="createClassForm">
                    @csrf
                    <div class="row">
                        <x-input-form type="text" name="ClassTitle"  grid="col-12 col-md-6">Class Title</x-input-form>
                        <x-select-form type="date" name="ClassDay"  grid="col-12 col-md-6" :values=$days>Day
                        </x-select-form>

                        <x-input-form type="time" name="StartTime" grid="col-12 col-md-6">Start Time</x-input-form>
                        <x-input-form type="time" name="EndTime" grid="col-12 col-md-6">End Time</x-input-form>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" form="createClassForm" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
