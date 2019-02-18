@extends('layouts/app')

@section('title', 'Change Password')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header"><h3>@yield('title')</h3></div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <h3>Error(s) found:</h3>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('accounts-change-password.update', ['slug' => $admin->slug]) }}">
                @method('PATCH')
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="password">New Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="New Password">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="confirm_password">Confirm Password</label>
                        <input type="password" class="form-control" id="confirm_password" name="password_confirmation" placeholder="Confirm Password">
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-sm-6"><button type="submit" class="btn btn-primary btn-block">Update</button></div>
                    <div class="col-sm-6">
                        <a href="{{ route('admins.edit', ['slug' => $admin->slug]) }}" class="btn btn-light btn-block">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop