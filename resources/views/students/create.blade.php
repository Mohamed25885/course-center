@extends('layouts.app_layout')

@section('content')
    <section class="section">


        <div class="section-body">


            <section class="card">
                <div class="card-header">
                    @if (!empty($student))
                        <h1>Edit {{ $student->FirstName }}</h1>
                    @else
                        <h1>Create New Student</h1>
                    @endif
                </div>
                <div class="card-body">
                    <form action="{{ empty($student) ? route('students.store') : route('students.update',$student) }}" method="POST" class="mb-0"
                        id="createEditStudent">
                        @csrf
                        <input type="hidden" name="StudentId" value="{{@$student?->StudentId}}">
                        @method(empty($student) ? 'POST' : 'PUT')
                        <div class="row">
                            <x-input-form type="text" name="FirstName" :value="@$student?->FirstName">
                                First Name</x-input-form>
                            <x-input-form type="text" name="LastName" :value="@$student?->LastName">
                                Last Name</x-input-form>
                            <x-input-form type="email" name="Email" :value="@$student?->Email">
                                Email</x-input-form>
                            <x-input-form type="tel" name="Phone" :value="@$student?->Phone">
                                Phone</x-input-form>
                            <x-input-form type="date" name="BirthDate" :value="@$student?->BirthDate?->format('Y-m-d')">
                                Birth Date</x-input-form>
                        </div>
                    </form>
                </div>
            </section>

            <div class="row mt-4">
                <div class="col-12 col-md-12">
                    <button type="submit" form="createEditStudent" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </section>
@endsection
