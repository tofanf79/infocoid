<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Info.co.id - Daftar</title>
    <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="daftar/css/login.css">
</head> 

<body>
    <main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
    <div class="container">
    <div class="card login-card">
        <div class="row no-gutters">
        <div class="col-md-5">
            <img src="daftar/images/login.jpg" alt="login" class="login-card-img">
        </div>
        <div class="col-md-7">
            <div class="card-body">
            <div class="mb-3">
                <img src="masuk/images/logo.png" height="60" width="300" alt="logo" class="logo">
            </div>
            <p class="login-card-description">Buat Sebuah Akun Baru</p>
<!-- Form -->
            <form action="{{ route('register.action') }}" method="POST">
                @csrf
<!-- Nama Lengkap -->
                <div class="form-group">
                    <label for="name" class="sr-only">Name</label>
                    <input type="name" class="form-control" maxlength="30" name="name" id="name" placeholder="Nama" required>
                </div> 
<!-- Tempat Tanggal Lahir -->
                <div class="form-row">
                    <div class="form-group col-md-6">
                    <label for="tempat" class="sr-only">Tempat</label>
                    <input type="text" name="tempat" id="tempat" class="form-control" placeholder="Tempat Lahir" required>
                    </div>  
                    <div class="form-group">
                    <input type='date' name="tgl_lahir" class="form-control" id="tgl_lahir" required/>
                    </div>
                </div>
<!-- Jenis Kelamin -->
                <div class="form-check form-check-inline mb-4 me-4">
                    <label class="form-check-label" for="Perempuan">Gender :</label>
                </div>
                <div class="form-check form-check-inline mb-4 me-4">
                    <input class="form-check-input" type="radio" name="jk" id="Perempuan" value="Perempuan" />
                    <label class="form-check-label" for="Perempuan">Perempuan</label>
                </div>
                <div class="form-check form-check-inline mb-4 me-4">
                    <input class="form-check-input" type="radio" name="jk" id="Laki-Laki" value="Laki-Laki" />
                    <label class="form-check-label" for="Laki-Laki">Laki-Laki</label>
                </div>
                <div
                    @error('jk')
                    <small class="alert alert-danger">{{$message}}</small>
                    @enderror
                </div>
<!-- No Hp -->
                <div class="form-group">
                    <label for="nohp" class="sr-only">nohp</label>
                    <input type="tel" name="nohp" id="nohp" maxlength="15" class="form-control" placeholder="No Telepon" required>
                </div>
<!-- Email -->
                <div class="form-group">
                    <label for="email" class="sr-only">email</label>
                    <input type="text" name="email" id="email" class="form-control" placeholder="Email" required>
                </div>
<!-- Username -->
                <div class="form-group">
                    <label for="username" class="sr-only">username</label>
                    <input type="text" name="username" id="username" class="form-control" placeholder="Nama Pengguna" required>
                    @error('username')
                    <small class="alert alert-danger">{{$message}}</small>
                    @enderror
                </div>
<!-- Password -->
                    <div class="form-group">
                    <label for="password" class="sr-only">password</label>  
                    <input type="password" name="password" id="myInput" class="form-control" placeholder="Kata Sandi" required>
                    @error('password_confirmation')
                    <small class="alert alert-danger">{{$message}}</small>
                    @enderror
                    </div>
<!-- Confirm Password -->
                    <div class="form-group">
                    <label for="password_confirmation" class="sr-only">password</label>  
                    <input type="password" name="password_confirmation" id="myInput2" class="form-control" placeholder="Konfirmasi Kata Sandi"required>
                    <input type="checkbox" onclick="myFunction()"> Tampilkan Kata Sandi
                    </div>
<!-- REGISTER -->
                <input type="hidden" name="foto" value="man.png">
                <button class="btn btn-block login-btn mb-4">Daftar</button>
                </form>
                <p class="login-card-footer-text">Sudah Punya Akun? <a href="{{ route('login') }}" class="text-reset">Masuk Disini</a></p>
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
<script>
function myFunction() {
    var x = document.getElementById("myInput");
    if (x.type === "password") {
    x.type = "text";
    } else {
    x.type = "password";
    }
    var y = document.getElementById("myInput2");
    if (y.type === "password") {
    y.type = "text";
    } else {
    y.type = "password";
    }
    }
</script>
</body>
</html>