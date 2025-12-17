@extends('layout')
@section('content')

<div class="row align-items-center mb-5">
    <div class="col-md-8">
        <h6 class="text-uppercase text-secondary mb-1">Staff Portal</h6>
        <h2 class="display-6 fw-bold mb-0">My Client Roster</h2>
    </div>
    <div class="col-md-4 text-md-end mt-3 mt-md-0">
        <a href="/customers/create" class="btn btn-primary btn-lg shadow-sm">
            <i class="bi bi-plus-lg me-2"></i> Register New Client
        </a>
    </div>
</div>

<!-- Stats Row -->
<div class="row mb-4">
    <div class="col-md-4">
        <div class="card bg-white p-3 border-start border-5 border-primary">
            <div class="text-secondary small text-uppercase">Total Assigned</div>
            <div class="fs-2 fw-bold">{{ $customers->count() }} <small class="fs-6 text-muted fw-normal">Clients</small></div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-white p-3 border-start border-5 border-success">
            <div class="text-secondary small text-uppercase">Converted</div>
            <div class="fs-2 fw-bold">{{ $customers->where('lead.lead_stage', 'Converted')->count() }} <small class="fs-6 text-muted fw-normal">Members</small></div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-white p-3 border-start border-5 border-warning">
            <div class="text-secondary small text-uppercase">Pending / New</div>
            <div class="fs-2 fw-bold">{{ $customers->where('lead.lead_stage', 'New')->count() }} <small class="fs-6 text-muted fw-normal">Leads</small></div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header bg-white">
        <i class="bi bi-list-task me-2 text-primary"></i> Client Management List
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light text-secondary text-uppercase small">
                    <tr>
                        <th class="ps-4">Client Name</th>
                        <th>Contact Email</th>
                        <th>Current Status</th>
                        <th class="text-end pe-4">Manage</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($customers as $c)
                    <tr>
                        <td class="ps-4">
                            <div class="fw-bold">{{ $c->first_name }} {{ $c->last_name }}</div>
                            <small class="text-muted">{{ $c->contact_number }}</small>
                        </td>
                        <td>{{ $c->email }}</td>
                        <td>
                             @php
                                $badges = [
                                    'New' => 'bg-primary',
                                    'Contacted' => 'bg-info text-dark',
                                    'Qualified' => 'bg-warning text-dark',
                                    'Converted' => 'bg-success'
                                ];
                                $badgeClass = $badges[$c->lead->lead_stage ?? ''] ?? 'bg-secondary';
                            @endphp
                            <span class="badge {{ $badgeClass }} rounded-pill px-3">{{ $c->lead->lead_stage ?? 'New' }}</span>
                        </td>
                        <td class="text-end pe-4">
                            <a href="/customers/{{ $c->customer_id }}" class="btn btn-sm btn-outline-primary px-3">
                                View Profile
                            </a>
                        </td>
                    </tr>
                    @endforeach
                    @if($customers->isEmpty())
                    <tr>
                        <td colspan="4" class="text-center py-5 text-muted">
                            <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                            No clients assigned yet. Click "Register New Client" to start.
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection