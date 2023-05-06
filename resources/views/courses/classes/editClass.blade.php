<div class="modal fade" id="updateCycleClass{{ $class->ClassNo }}" tabindex="-1"
    aria-labelledby="updateCycleClass{{ $class->ClassNo }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title" id="updateCycleClass{{ $class->ClassNo }}">Edit {{ week_days($class->ClassDay) }}
                    Cycle</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('cycles.classes.update', ['courseCycles' => $cycle, 'cycleClass' => $class]) }}"
                    method="post" id="updateClassForm{{ $class->ClassNo }}">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <x-input-form type="text" name="ClassTitle" grid="col-12 col-md-6" :value="$class->ClassTitle">Class
                            Title</x-input-form>


                        <x-input-form type="time" name="StartTime" grid="col-12 col-md-6" :value="$class->StartTime->format('H:i')">Start
                            Time</x-input-form>
                        <x-input-form type="time" name="EndTime" grid="col-12 col-md-6" :value="$class->EndTime->format('H:i')">End Time
                        </x-input-form>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" form="updateClassForm{{ $class->ClassNo }}" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
