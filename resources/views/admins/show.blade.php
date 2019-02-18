<?php use App\Account; ?>

@extends('layouts/app')

@section('title', 'Show Account')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">Show Account</div>
        <div class="card-body">
            <label for="first_name">First Name</label>
            <p id="first_name">
                <strong>{{ $admin->first_name }}</strong>
            </p>

            <label for="last_name">Last Name</label>
            <p id="last_name">
                <strong>{{ $admin->last_name }}</strong>
            </p>

            <label for="username">Username</label>
            <p id="username">
                <strong>{{ ucwords($admin->username) }}</strong>
            </p>

            <label for="email">Email</label>
            <p id="email">
                <strong>{{ $admin->email }}</strong>
            </p>

            <label for="status">Status</label>
            <p id="status">
                <strong>{{ ucwords($admin->status) }}</strong>
            </p>

            <div class="form-row">
                <div class="col-sm-4">
                    <a href="{{ route('admins.edit', ['slug' => $admin->slug]) }}" class="btn btn-primary btn-block">
                        Update Admin
                    </a>
                </div>
                <div class="col-sm-4">
                    <form action="{{ route('accounts-change-status.update', ['slug' => $admin->slug]) }}" method="POST">
                        @method('PATCH') @csrf
                        @if ($admin->status == Account::STATUS_ACTIVE)
                            <button type="submit" class="btn btn-danger btn-block">Deactivate Admin</button>
                        @else
                            <button type="submit" class="btn btn-success btn-block">Activate Admin</button>
                        @endif
                    </form>
                </div>
                <div class="col-sm-4">
                    <a href="{{ route('admins.index') }}" class="btn btn-light btn-block">Cancel</a>
                </div>
            </div>
        </div>
    </div>
</div>
@stop