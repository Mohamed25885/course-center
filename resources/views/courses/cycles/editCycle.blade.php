<div class="modal fade" id="updateCycle{{ $cycle->CycleId }}ModalForm" tabindex="-1"
    aria-labelledby="updateCycle{{ $cycle->CycleId }}Modal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title" id="updateCycle{{ $cycle->CycleId }}Modal">Create New Cycle</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('cycles.update', ['course' => $course, 'courseCycles' => $cycle]) }}"
                    method="post" id="updateCycle{{ $cycle->CycleId }}">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <x-select-form type="date" :selected="$cycle->TeacherId" name="TeacherId" grid="col-12"
                            :values="$teachers">
                            Teacher
                        </x-select-form>

                        <x-input-form type="date" name="StartDate" grid="col-12 col-md-6" :value="$cycle->StartDate->format('Y-m-d')">Start
                            Date</x-input-form>
                        <x-input-form type="date" name="EndDate" grid="col-12 col-md-6" :value="$cycle->EndDate->format('Y-m-d')">End Date
                        </x-input-form>
                        <x-textarea-form type="text" name="CycleDescription" grid="col-12"
                            placeholder="Cycle Description">
                            {{ $cycle->CycleDescription }}
                        </x-textarea-form>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" form="updateCycle{{ $cycle->CycleId }}" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
