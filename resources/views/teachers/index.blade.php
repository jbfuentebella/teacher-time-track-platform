@extends('layouts/app')

@section('title', 'Teachers')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">@yield('title')</div>
        <div class="card-body">
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
                            <th>Login Date</th>
                            <th>Login Time</th>
                            <th>Logout Date</th>                            
                            <th>Logout Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($teachers as $key => $teacher)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $teacher->account->first_name }}</td>
                            <td>{{ $teacher->account->last_name }}</td>
                            <td>{{ $teacher->account->username }}</td>
                            <td>{{ $teacher->account->email }}</td>
                            <td>{{ ucwords($teacher->status) }}</td>
                            <td>{{ $teacher->login_dt }}</td>
                            <td>{{ $teacher->login_time }}</td>
                            <td>{{ !empty($teacher->logout_dt) ? $teacher->logout_dt : '-' }}</td>
                            <td>{{ !empty($teacher->logout_time) ? $teacher->logout_time : '-'}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop