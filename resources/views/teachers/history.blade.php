@section('sub-content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="cover-heading">History</h4>
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Status</th>
                            <th>Login Date</th>
                            <th>Login Time</th>
                            <th>Logout Date</th>                            
                            <th>Logout Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $logs = auth()->user()->logs()->orderBy('id', 'desc')->paginate(15);
                        ?>
                        @foreach($logs as $key => $log)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ ucwords($log->status) }}</td>
                            <td>{{ $log->login_dt }}</td>
                            <td>{{ $log->login_time }}</td>
                            <td>{{ !empty($log->logout_dt) ? $log->logout_dt : '-' }}</td>
                            <td>{{ !empty($log->logout_time) ? $log->logout_time : '-'}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $logs->links() }}
            </div>
        </div>
    </div>
</div>
@stop