@extends('layout')
@section('content')

<div class="d-flex justify-content-between align-items-end mb-5">
    <div>
        <h6 class="text-uppercase text-secondary mb-1">Overview</h6>
        <h2 class="display-6 fw-bold mb-0">Manager Dashboard</h2>
    </div>
    <a href="/reports" class="btn btn-dark btn-lg shadow-sm">
        <i class="bi bi-bar-chart-fill me-2" style="color: var(--gym-orange);"></i> View Analytics
    </a>
</div>

<div class="row">
    <!-- Main Customer Table -->
    <div class="col-lg-8 mb-4">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="bi bi-people-fill me-2 text-muted"></i> All Customers (Team View)</span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light text-secondary text-uppercase small">
                            <tr>
                                <th class="ps-4">Customer Name</th>
                                <th>Assigned Staff</th>
                                <th>Lead Stage</th>
                                <th class="text-end pe-4">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($customers as $c)
                            <tr>
                                <td class="ps-4 fw-bold text-dark">{{ $c->first_name }} {{ $c->last_name }}</td>
                                <td>
                                    <span class="d-flex align-items-center">
                                        <i class="bi bi-person-badge me-2 text-muted"></i>
                                        {{ $c->staff->first_name ?? 'Unassigned' }}
                                    </span>
                                </td>
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
                                    <span class="badge {{ $badgeClass }} rounded-pill px-3">{{ $c->lead->lead_stage ?? 'N/A' }}</span>
                                </td>
                                <td class="text-end pe-4">
                                    <a href="/customers/{{ $c->customer_id }}" class="btn btn-sm btn-outline-dark">
                                        Details <i class="bi bi-chevron-right ms-1"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Recent Interactions Feed -->
    <div class="col-lg-4 mb-4">
        <div class="card h-100 bg-dark text-white" style="background: linear-gradient(180deg, #212529 0%, #2c3034 100%);">
            <div class="card-header bg-transparent text-white border-secondary">
                <i class="bi bi-activity me-2" style="color: var(--gym-orange);"></i> Live Activity Feed
            </div>
            <div class="card-body">
                <ul class="list-unstyled">
                    @foreach($interactions as $i)
                    <li class="mb-4 pb-4 border-bottom border-secondary position-relative">
                        <div class="d-flex w-100 justify-content-between mb-1">
                            <span class="text-uppercase small fw-bold" style="color: var(--gym-orange);">{{ $i->staff->first_name }}</span>
                            <small class="text-secondary" style="font-size: 0.75rem;">{{ \Carbon\Carbon::parse($i->date_time)->diffForHumans() }}</small>
                        </div>
                        <div class="mb-1">
                            <span class="text-light">Log: {{ $i->interaction_type }} with <strong>{{ $i->customer->first_name }}</strong></span>
                        </div>
                        <small class="text-white-50 fst-italic">"{{ Str::limit($i->notes, 50) }}"</small>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection