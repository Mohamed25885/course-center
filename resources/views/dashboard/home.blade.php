@extends('layouts.app_layout')

@section('content')
<div class="container">
    <div class="bg-primary py-3 text-white text-center">
        <h3>Welcome Back <strong class="fs-2">{{auth()->user()->name}}</strong></h3>
    </div>
</div>
@endsection
