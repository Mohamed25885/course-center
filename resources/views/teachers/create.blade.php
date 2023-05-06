@extends('layouts.app_layout')

@section('content')
    <section class="section">


        <div class="section-body">


            <section class="card">
                <div class="card-header">
                    @if (!empty($teacher))
                        <h1>Edit {{ $teacher->FirstName }}</h1>
                    @else
                        <h1>Create New Teacher</h1>
                    @endif
                </div>
                <div class="card-body">
                    @if (!empty($teacher) && !empty($teacher->Image))
                        <figure>
                            <img src="{{ $teacher->image_file }}" class="img-thumbnail" width="200" alt="">
                        </figure>
                    @endif
                    <form action="{{ empty($teacher) ? route('teachers.store') : route('teachers.update', $teacher) }}"
                        method="POST" class="mb-0" id="createEditteacher" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="TeacherId" value="{{ @$teacher?->TeacherId }}">
                        @method(empty($teacher) ? 'POST' : 'PUT')
                        <div class="row">
                            <x-input-form type="text" name="FirstName" :value="@$teacher?->FirstName">
                                First Name</x-input-form>
                            <x-input-form type="text" name="LastName" :value="@$teacher?->LastName">
                                Last Name</x-input-form>
                            <x-input-form type="email" name="Email" :value="@$teacher?->Email">
                                Email</x-input-form>
                            <x-input-form type="tel" name="Phone" :value="@$teacher?->Phone">
                                Phone</x-input-form>
                            <x-input-form type="file" name="Image" :value="@$teacher?->Image">
                                Personal Image</x-input-form>
                        </div>
                    </form>
                </div>
            </section>

            <div class="row mt-4">
                <div class="col-12 col-md-12">
                    <button type="submit" form="createEditteacher" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </section>
@endsection
