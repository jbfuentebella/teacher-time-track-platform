@extends('layouts/app')

@section('title', 'Clock Out')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('clock-out.update') }}">
                @method('PATCH')
                @csrf
                
                <h1 class="cover-heading">Hi {{ auth()->user()->first_name }},</h1>
                <p class="lead">Looks like you're done for today. That's nice. Go home for now and see you again tomorrow.</p>
                <p class="lead">
                  <button type="submit" class="btn btn-lg btn-primary">Clock-out</button>
                </p>
            </form>

            @include('teachers.history')
            @yield('sub-content')
        </div>
    </div>
</div>
@stop