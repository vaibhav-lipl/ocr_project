<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Register</title>

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f5f6fa;
        }
        .register-box {
            max-width: 480px;
            margin: 60px auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 12px rgba(0,0,0,0.1);
        }
        .logo {
            width: 70px;
            height: auto;
            display: block;
            margin: 0 auto 20px auto;
        }
        .title {
            text-align: center;
            font-size: 22px;
            margin-bottom: 20px;
            font-weight: 600;
        }
    </style>
</head>

<body>

<div class="register-box">

    <!-- OPTIONAL LOGO -->
    <img src="{{ asset('assets/images/cnamelogo.png') }}" class="logo" alt="Logo">

    <div class="title">Register</div>

    @if ($errors->any())
        <div class="alert alert-danger">
            Please fix the errors and try again.
        </div>
    @endif

    <form method="POST" action="{{ route('register.post') }}">
        @csrf

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>First Name</label>
                <input name="first_name" class="form-control" value="{{ old('first_name') }}" required>
                @error('first_name') 
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label>Last Name</label>
                <input name="last_name" class="form-control" value="{{ old('last_name') }}" required>
                @error('last_name') 
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input name="email" class="form-control" value="{{ old('email') }}" required>
            @error('email') 
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Password</label>
            <input name="password" type="password" class="form-control" required>
            @error('password') 
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Confirm Password</label>
            <input name="password_confirmation" type="password" class="form-control" required>
        </div>

        <button class="btn btn-success w-100 mb-3">Register</button>

        <!-- LOGIN BUTTON -->
        <a href="{{ route('login') }}" class="btn btn-outline-secondary w-100">Back to Login</a>
    </form>

</div>

</body>
</html>
