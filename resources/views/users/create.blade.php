@extends('layouts.app')

@section('title', 'Create User')

@section('content')

<div class="card shadow p-4">
    <h4 class="mb-3">Create New User</h4>

    <form action="{{ route('users.store') }}" method="POST">
        @csrf

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>First Name</label>
                <input type="text" name="first_name" class="form-control" required>
                @error('first_name') 
                    <small class="text-danger">{{ $message }}</small> 
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label>Last Name</label>
                <input type="text" name="last_name" class="form-control" required>
                @error('last_name') 
                    <small class="text-danger">{{ $message }}</small> 
                @enderror
            </div>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
            @error('email') 
                <small class="text-danger">{{ $message }}</small> 
            @enderror
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
                @error('password') 
                    <small class="text-danger">{{ $message }}</small> 
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label>Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>
        </div>

        <div class="mb-3 form-check form-switch">
            <input class="form-check-input" type="checkbox" name="is_active" checked>
            <label class="form-check-label">Active User</label>
        </div>

        <button class="btn btn-success">Create User</button>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>

@endsection
