@extends('layouts.app')

@section('content')

<div class="card shadow p-4">
    <h4>Edit User</h4>

    <form method="POST" action="{{ route('users.update', $user->id) }}">
        @csrf

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>First Name</label>
                <input type="text" class="form-control" name="first_name" value="{{ $user->first_name }}" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Last Name</label>
                <input type="text" class="form-control" name="last_name" value="{{ $user->last_name }}" required>
            </div>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" class="form-control" name="email" value="{{ $user->email }}" required>
        </div>

        <!-- RESET PASSWORD CHECKBOX -->
        <div class="form-check form-switch mb-3">
            <input class="form-check-input" type="checkbox" id="resetPasswordSwitch" name="reset_password">
            <label class="form-check-label" for="resetPasswordSwitch">Reset Password</label>
        </div>

        <!-- PASSWORD FIELDS (HIDDEN BY DEFAULT) -->
        <div id="passwordSection" style="display: none;">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>New Password</label>
                    <input type="password" class="form-control" name="password">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Confirm New Password</label>
                    <input type="password" class="form-control" name="password_confirmation">
                </div>
            </div>
        </div>

        <div class="form-check form-switch mb-3">
            <input class="form-check-input" type="checkbox" name="is_active" {{ $user->is_active ? 'checked' : '' }}>
            <label class="form-check-label">Active</label>
        </div>

        <button class="btn btn-success">Update User</button>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>

    </form>
</div>

<script>
    // Show/Hide password fields based on checkbox
    document.getElementById('resetPasswordSwitch').addEventListener('change', function() {
        let section = document.getElementById('passwordSection');
        section.style.display = this.checked ? 'block' : 'none';
    });
</script>

@endsection
