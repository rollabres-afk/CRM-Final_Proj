@extends('layout')
@section('content')
<div class="row">
    <!-- Customer Profile -->
    <div class="col-md-4">
        <div class="card mb-3">
            <div class="card-header bg-primary text-white">Customer Profile</div>
            <div class="card-body">
                <h5>{{ $customer->first_name }} {{ $customer->last_name }}</h5>
                <p><strong>Email:</strong> {{ $customer->email }}</p>
                <p><strong>Phone:</strong> {{ $customer->contact_number }}</p>
                <p><strong>Address:</strong> {{ $customer->address }}</p>
                <p><strong>Assigned To:</strong> {{ $customer->staff->first_name ?? 'N/A' }}</p>
                
                <hr>

                <!-- Lead Status Update -->
                <form action="/customers/{{ $customer->customer_id }}/status" method="POST" class="mb-3">
                    @csrf
                    <label><strong>Current Lead Stage:</strong></label>
                    <select name="lead_stage" class="form-select mb-2">
                        @foreach(['New', 'Contacted', 'Qualified', 'Converted'] as $stage)
                            <option value="{{ $stage }}" {{ ($customer->lead->lead_stage ?? '') == $stage ? 'selected' : '' }}>
                                {{ $stage }}
                            </option>
                        @endforeach
                    </select>
                    <button class="btn btn-sm btn-warning w-100">Update Status</button>
                </form>

                <hr>

                <!-- Delete Button -->
                <form action="/customers/{{ $customer->customer_id }}" method="POST" onsubmit="return confirm('Are you sure you want to permanently delete this customer and all their history?');">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger w-100">Delete Record</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Interaction History & Logging -->
    <div class="col-md-8">
        <div class="card mb-3">
            <div class="card-header">Log New Interaction</div>
            <div class="card-body">
                <form action="/customers/{{ $customer->customer_id }}/interaction" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <select name="interaction_type" class="form-select" required>
                                <option value="Call">Call</option>
                                <option value="Email">Email</option>
                                <option value="Meeting">Meeting</option>
                                <option value="Walk-in">Walk-in</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="notes" class="form-control" placeholder="Enter interaction notes..." required>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-success w-100">Log</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header">Interaction History</div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Type</th>
                        <th>Staff</th>
                        <th>Notes</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($customer->interactions->sortByDesc('date_time') as $log)
                    <tr>
                        <td>{{ $log->date_time }}</td>
                        <td>{{ $log->interaction_type }}</td>
                        <td>{{ $log->staff->first_name }}</td>
                        <td>{{ $log->notes }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<a href="/dashboard" class="btn btn-secondary mt-3">Back to Dashboard</a>
@endsection