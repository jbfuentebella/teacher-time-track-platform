@extends('layouts/app')

@section('title', 'Admins')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">@yield('title')</div>
        <div class="card-body">
            <a href="{{ route('admins.create') }}" class="btn btn-primary">Add Admin</a>
            <br><br>
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Status</th>                            
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($admins as $key => $admin)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $admin->first_name }}</td>
                            <td>{{ $admin->last_name }}</td>
                            <td>{{ $admin->username }}</td>
                            <td>{{ $admin->email }}</td>
                            <td>{{ ucwords($admin->status) }}</td>
                            <td>
                                <a href="{{ route('admins.show', ['slug' => $admin->slug]) }}" class="btn btn-primary btn-block">View</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop