<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f5f6fa;
        }
        .login-box {
            max-width: 420px;
            margin: 100px auto;
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

<div class="login-box">

    <!-- OPTIONAL LOGO -->
    <img src="{{ asset('assets/images/cnamelogo.png') }}" class="logo" alt="Logo">

    <div class="title">Admin Login</div>

    @if ($errors->any())
        <div class="alert alert-danger">
            Invalid login details.
        </div>
    @endif

    <form method="POST" action="{{ route('login.post') }}">
        @csrf

        <div class="mb-3">
            <label>Email</label>
            <input name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Password</label>
            <input name="password" type="password" class="form-control" required>
        </div>

        <button class="btn btn-primary w-100 mb-3">Login</button>

        <!-- REGISTER BUTTON -->
        <!-- <a href="{{ route('register') }}" class="btn btn-outline-secondary w-100">Register</a> -->
    </form>
</div>

</body>
</html>
