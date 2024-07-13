<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Info.co.id - Masuk</title>
    <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="masuk/css/login.css">
</head>
<body>
    <main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
    <div class="container">
    <div class="card login-card">
        <div class="row no-gutters">
        <div class="col-md-5">
        <img src="masuk/images/login.jpg" alt="login" class="login-card-img">
        </div>
        <div class="col-md-7">
            <div class="card-body">
            <div class="mb-3">
                <img src="masuk/images/logo.png" height="60" width="300" alt="logo" class="logo">
            </div>
            <p class="login-card-description" font-family="Ribeye">Masuk Ke Akun Anda</p>
            @if(session('success'))
            <p class="alert alert-success">{{ session('success') }}</p>
            @endif
            @if($errors->any())
            @foreach($errors->all() as $err)
            <p class="alert alert-danger">{{ $err }}</p>
            @endforeach
            @endif
            <form action="{{ route('login.action') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="username" class="sr-only">Username</label>
                    <input type="text" name="username" id="username" class="form-control" @if(Cookie::has('username')) value="{{Cookie::get('username')}}" @endif placeholder="Nama Pengguna">
                </div>
                <div class="form-group mb-4">
                    <label for="password" class="sr-only">Password</label>
                    <input type="password" name="password" id="password" class="form-control" @if(Cookie::has('password')) value="{{Cookie::get('password')}}" @endif placeholder="Kata Sandi">
                    <input type="checkbox" name="rememberme" id="customecheck" @if(Cookie::has('username')) checked @endif>
                    <label for="customcheck">Ingat Saya</label>
                </div>
                <button class="btn btn-block login-btn mb-4">Masuk</button>
                </form>
                <p class="login-card-footer-text">Tidak punya akun? <a href="{{ route('register') }}" class="text-reset">Daftar Disini</a></p>
                <nav class="login-card-footer-nav">
                </nav>
            </div>
        </div>
        </div>
    </div>
    </div>
</main>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html>
