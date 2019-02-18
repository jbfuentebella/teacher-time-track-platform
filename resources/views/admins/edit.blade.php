@extends('layouts/app')

@section('title', 'Update Admin')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header"><h3>@yield('title')</h3></div>
        <div class="card-body">
            <form method="POST" action="{{ route('admins.update', ['slug' => $admin->slug]) }}">
                @method('PATCH')
                @csrf

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="first_name">First Name</label>
                        <input type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" id="first_name" name="first_name" placeholder="First Name" value="{{ $admin->first_name }}">

                        @if ($errors->has('first_name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('first_name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="last_name">Last Name</label>
                        <input type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" id="last_name" name="last_name" placeholder="Last Name" value="{{ $admin->last_name }}">
                        @if ($errors->has('last_name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('last_name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" disabled="disabled" id="username" name="username" placeholder="Username" value="{{ $admin->username }}">

                    @if ($errors->has('username'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('username') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" name="email" disabled="disabled" placeholder="Email" value="{{ $admin->email }}">
                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-row">
                    <div class="col-sm-4"><button type="submit" class="btn btn-primary btn-block">Update</button></div>
                    <div class="col-sm-4"><a href="{{ route('accounts-change-password.edit', ['slug' => $admin->slug]) }}" class="btn btn-success btn-block">Change Password</button></a></div>
                    <div class="col-sm-4">
                        <a href="{{ route('admins.show', ['slug' => $admin->slug]) }}" class="btn btn-light btn-block">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop