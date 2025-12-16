@extends('layout')

@section('content')
<h2>System Reports</h2>
<a href="/dashboard" class="btn btn-secondary mb-4">Back to Dashboard</a>

<div class="row">
    <!-- Lead Status Distribution -->
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header bg-success text-white">Lead Status Distribution</div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Stage</th>
                            <th>Total Customers</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($leadStats as $stat)
                        <tr>
                            <td>{{ $stat->lead_stage }}</td>
                            <td class="text-center">
                                <span class="badge bg-primary rounded-pill" style="font-size: 1rem;">
                                    {{ $stat->total }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Staff Performance -->
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header bg-info text-white">Staff Interaction Performance</div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Staff Name</th>
                            <th>Total Interactions Logged</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($staffStats as $stat)
                        <tr>
                            <td>{{ $stat->staff->first_name ?? 'Unknown' }} {{ $stat->staff->last_name ?? '' }}</td>
                            <td class="text-center">{{ $stat->total }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection