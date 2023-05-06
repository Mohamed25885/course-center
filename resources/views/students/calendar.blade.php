@extends('layouts.app_layout')

@section('content')
    <section class="section">


        <div class="section-body">


            <section class="card">
                <div class="card-header">
                    {{ $student->full_name }} Calendar
                </div>
                <div class="card-body">
                    @include('students.includes.calendar')
                </div>
            </section>



        </div>
    </section>
@endsection
