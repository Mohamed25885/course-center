@extends('layouts.app_layout')

@section('content')
    <section class="section">


        <div class="section-body">


            <section class="card">
                <div class="card-header">
                    <h1>Hello {{ $user->name }}</h1>
                </div>
                <div class="card-body">
                    @if (!empty($user) && !empty($user->image))
                        <figure>
                            <img src="{{ $user->image_file }}" class="img-thumbnail" width="200" alt="">
                        </figure>
                    @endif
                    <form action="{{ route('profile.update') }}" method="POST" class="mb-0" id="updateProfile"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="user_id" value="{{ @$user?->id }}">
                        <div class="row">
                            <x-input-form type="text" name="name" :value="@$user?->name">
                                Name</x-input-form>

                            <x-input-form type="email" name="email" :value="@$user?->email">
                                Email</x-input-form>

                            <x-input-form type="password" name="password">
                                Password</x-input-form>
                            <x-input-form type="password" name="password_confirmation">
                                Password Confirmation</x-input-form>

                            <x-input-form type="file" name="image" :value="@$user?->Image">
                                Personal Image</x-input-form>
                        </div>
                    </form>
                </div>
            </section>

            <div class="row mt-4">
                <div class="col-12 col-md-12">
                    <button type="submit" form="updateProfile" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </section>
@endsection
