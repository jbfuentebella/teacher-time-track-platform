@extends('layouts/app')

@section('title', 'Clock Success')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h1 class="cover-heading">Hi {{ $log->account->first_name }},</h1>
            <p class="lead">
                You've successfully {{ $log->status }} today 
                    @if ($log->status == \App\Log::STATUS_CLOCK_IN) 
                        {{ $log->login_dt }} at {{ $log->login_time }} 
                    @else 
                        {{ $log->logout_dt }} at {{ $log->logout_time }}  
                    @endif
            </p>
            <p class="lead">
              <a href="{{ route('login') }}" class="btn btn-lg btn-primary">Next Teacher</a>
            </p>
        </div>
    </div>
</div>
@stop