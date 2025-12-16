@extends('layout')
@section('content')
<h2>My Customers</h2>
<a href="/customers/create" class="btn btn-success mb-3">Add New Customer</a>

<table class="table table-bordered bg-white">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Lead Stage</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($customers as $c)
        <tr>
            <td>{{ $c->first_name }} {{ $c->last_name }}</td>
            <td>{{ $c->email }}</td>
            <td>
                <span class="badge bg-info">{{ $c->lead ? $c->lead->lead_stage : 'New' }}</span>
            </td>
            <td>
                <a href="/customers/{{ $c->customer_id }}" class="btn btn-sm btn-primary">View / Update</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection