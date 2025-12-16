@extends('layout')
@section('content')

<!-- Dito yung part na may Button para sa Reports -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Manager Overview</h2>
    <a href="/reports" class="btn btn-primary">View Summary Reports</a>
</div>

<div class="row mb-4">
    <div class="col-md-8">
        <div class="card h-100">
            <div class="card-header bg-dark text-white">All Customers (Team View)</div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Customer</th>
                            <th>Assigned Staff</th>
                            <th>Stage</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($customers as $c)
                        <tr>
                            <td>{{ $c->first_name }} {{ $c->last_name }}</td>
                            <td>{{ $c->staff->first_name ?? 'Unassigned' }}</td>
                            <td>
                                <span class="badge bg-secondary">{{ $c->lead->lead_stage ?? 'N/A' }}</span>
                            </td>
                            <td><a href="/customers/{{ $c->customer_id }}" class="btn btn-sm btn-primary">View</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card h-100">
            <div class="card-header bg-dark text-white">Recent Interactions</div>
            <ul class="list-group list-group-flush">
                @foreach($interactions as $i)
                <li class="list-group-item">
                    <div class="d-flex w-100 justify-content-between">
                        <small class="fw-bold">{{ $i->staff->first_name }}</small>
                        <small class="text-muted">{{ $i->date_time }}</small>
                    </div>
                    <small>Interacted with: {{ $i->customer->first_name }}</small><br>
                    <small class="text-primary">{{ $i->interaction_type }}</small>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection