@extends('layouts/app')

@section('title', 'Clock In')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('clock-in.store') }}">
                @csrf
                
                <h1 class="cover-heading">Hi {{ auth()->user()->first_name }},</h1>
                <p class="lead">Are you ready to clock-in and make a change in the world?</p>
                <p class="lead">
                  <button type="submit" class="btn btn-lg btn-primary">Clock-In</button>
                </p>
            </form>

            @include('teachers.history')
            @yield('sub-content')
        </div>
    </div>
</div>
@stop