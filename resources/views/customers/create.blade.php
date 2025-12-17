@extends('layout')
@section('content')
<div class="card">
    <div class="card-header bg-primary text-white">Create New Customer Record</div>
    <div class="card-body">
        
        <!-- ITO ANG KULANG KANINA: Error Message Display -->
        @if($errors->any())
            <div class="alert alert-danger">
                <strong>Error:</strong> {{ $errors->first() }}
            </div>
        @endif
        <!-- End of Error Message -->

        <form action="/customers" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>First Name</label>
                    <input type="text" name="first_name" class="form-control" value="{{ old('first_name') }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Last Name</label>
                    <input type="text" name="last_name" class="form-control" value="{{ old('last_name') }}" required>
                </div>
            </div>
            <div class="mb-3">
                <label>Contact Number</label>
                <input type="text" name="contact_number" class="form-control" value="{{ old('contact_number') }}">
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}">
            </div>
            <div class="mb-3">
                <label>Address</label>
                <textarea name="address" class="form-control">{{ old('address') }}</textarea>
            </div>
            <button type="submit" class="btn btn-success">Create Record</button>
            <a href="/dashboard" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection