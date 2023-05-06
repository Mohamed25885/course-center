@extends('layouts.app_layout')

@section('content')
    <section class="section">


        <div class="section-body">


            <section class="card">
                <div class="card-header">
                    @if (!empty($result))
                        <h1>Edit Result</h1>
                    @else
                        <h1>Create New Result</h1>
                    @endif
                </div>

                <div class="card-body">
                    <form action="{{ empty($result) ? route('results.store') : route('results.update', $result) }}"
                        method="POST" class="mb-0" id="createEditResult">
                        @csrf

                        @method(empty($result) ? 'POST' : 'PUT')
                        <div class="row">

                            @if (empty($result))
                                <x-select-form name="StudentId" :selected="@$result->StudentId" :values=$students>Student
                                </x-select-form>
                                <x-select-form name="TestNo" :selected="@$result->TestNo" :values=$exams>Exam
                                </x-select-form>
                            @endif
                            <x-input-form type="text" name="Grade" :value="@$result?->Grade">
                                Grade</x-input-form>
                        </div>
                    </form>
                </div>
            </section>

            <div class="row mt-4">
                <div class="col-12 col-md-12">
                    <button type="submit" form="createEditResult" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </section>
@endsection
