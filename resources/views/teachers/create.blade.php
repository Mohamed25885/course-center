@extends('layouts.app_layout')

@section('content')
    <section class="section">


        <div class="section-body">


            <section class="card">
                <div class="card-header">
                    <h1>Create New Teacher</h1>
                </div>
                <div class="card-body">
                    <form action="{{ empty($teacher) ? route('teachers.store') : route('teachers.update',$teacher) }}" method="POST" class="mb-0"
                        id="createEditteacher">
                        @csrf
                        <input type="hidden" name="TeacherId" value="{{@$teacher?->TeacherId}}">
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
