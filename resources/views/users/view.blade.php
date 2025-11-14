@extends('layouts.app')

@section('content')

<div class="card shadow p-4">
    <h4>User Details</h4>

    <table class="table table-bordered mt-3">
        <tr><th>ID</th><td>{{ $user->id }}</td></tr>
        <tr><th>First Name</th><td>{{ $user->first_name }}</td></tr>
        <tr><th>Last Name</th><td>{{ $user->last_name }}</td></tr>
        <tr><th>Email</th><td>{{ $user->email }}</td></tr>
        <tr><th>Status</th><td>{{ $user->is_active ? 'Active' : 'Inactive' }}</td></tr>
        <tr><th>Created</th><td>{{ $user->created_at->format('d-m-Y h:i A') }}</td></tr>
    </table>

    <a href="{{ route('users.index') }}" class="btn btn-secondary">Back</a>
</div>

@endsection
