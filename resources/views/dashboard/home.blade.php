@extends('layouts.app_layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h3>Welcome Back <strong class="fs-2">{{auth()->user()->name}}</strong></h3>
        </div>
    </div>
</div>
@endsection
