@extends('layouts.app_layout')
@push('styles_top')
@endpush
@section('content')
    <div class="container dashboard">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h3>Welcome Back <strong class="fs-2">{{ auth()->user()->name }}</strong></h3>
            </div>
        </div>

        <div class="section">
            <div class="section-header space-1">
                <h5>Quick Reports</h5>
            </div>
            <div class="section-body">
                <div class="row">
                    @foreach ($reports as $report)
                        @include('dashboard.includes.report_card', ['report' => $report])
                    @endforeach
                </div>

                {{-- <div class="row">
                    @include('dashboard.includes.calender')
                </div> --}}

            </div>
        </div>
    </div>
@endsection
