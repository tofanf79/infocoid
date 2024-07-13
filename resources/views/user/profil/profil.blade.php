<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Info.co.id - Profil</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="utama/img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&family=Rubik:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="utama/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="utama/lib/animate/animate.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="utama/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="utama/css/style.css" rel="stylesheet">
</head>


<body>
    <!-- Spinner Start -->
 <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
    <div class="spinner"></div>
</div>
<!-- Spinner End -->

     <!-- Navbar & Carousel Start -->
<div class="container-fluid position-relative p-0">
    <nav class="navbar navbar-expand-lg navbar-dark px-5 py-3 py-lg-0">
        <a href="/" class="navbar-brand p-0">
            <img src="{{asset('masuk/images/logo.png')}}" height="40" width="200" alt="logo" class="logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="fa fa-bars"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto py-0">
                <a href="/" class="nav-item nav-link">Beranda</a>
                <div class="nav-item dropdown">
                    <a href="iklan" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Iklan</a>
                    <div class="dropdown-menu m-0">
                    @if(isset($jenis_iklan))
                      @foreach($jenis_iklan as $dat)
                        <a href="{{ route('guest.jenisiklan',$dat['id']) }}" class="dropdown-item">{{ $dat['jenis'] }}</a>
                      @endforeach
                    @else
                      @foreach($data['jenis_iklan'] as $dat)
                        <a href="{{ route('guest.jenisiklan',$dat['id']) }}" class="dropdown-item">{{ $dat['jenis'] }}</a>
                      @endforeach
                    @endif
                    </div>
            </div>
                <a href="/usertentang" class="nav-item nav-link">Tentang Kami</a>
            </div>
                <!-- Nav Item - User Information -->
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle active" data-bs-toggle="dropdown">
                        <img class="rounded-circle me-lg-2" src="{{ asset('imgprofil/'.Auth::user()->foto) }}" style="width: 40px; height: 40px;">
                        <span class="d-none d-lg-inline-flex">{{ Auth::user()->username }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                        @if(Auth::user()->level =='user')
                            <a href="/profil" class="dropdown-item active">Profil</a>
                            <a href="/tambahiklan" class="dropdown-item">Pesan Iklan</a>
                            <a href="/pembayaran" class="dropdown-item">Pembayaran</a>
                            <a href="/iklansaya" class="dropdown-item">Info Iklan</a>
                        @endif
                        <a href="{{ route('logout') }}" class="dropdown-item">Log Out</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="container-fluid bg-primary py-4 bg-header" style="margin-bottom: 80px;">
        <div class="row py-5">
            <div class="col-12 pt-lg-5 mt-lg-5 text-center">
                <h1 class="display-4 text-white animated zoomIn">Profil</h1>
                <a href="/" class="h5 text-white">Beranda</a>
                <i class="far fa-circle text-white px-2"></i>
                <a href="#" class="h5 text-white">Profil</a>
            </div>
        </div>
    </div>
</div>
<!-- Navbar & Carousel End -->

    <!-- Tampilan Profil -->
    <div class="container">
        <div class="testimonial-item bg-light my-4">
            <div class="d-flex  pb-4 px-5">
                <div class="row gy-3 gx-4 justify-content-center mt-2">
                    <div class="card shadow">
                        <div class="card-header">
                            <h2 class="text-primary fw-bold ">Profil Pengguna</h2>
                        </div>
                        <div class="card-body p-5">
                            <div class="row my-2">
                                    @if(session('berhasil'))
                                    <p class="alert alert-success">{{ session('berhasil') }}</p>
                                    @endif
                                    @if($errors->any())
                                    @foreach($errors->all() as $err)
                                    <p class="alert alert-danger">{{ $err }}</p>
                                    @endforeach
                                    @endif
                                <div class="col-lg-4 px-5 text-center" style="border-right: 1px solid #999;">
                                    <label style="font-size: 25pt">{{ Auth::user()->username }}</label>
                                <form action="{{ route('profil.action') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <img class="img-fluid rounded-circle img-thumbnail" src="{{ asset('imgprofil/'.Auth::user()->foto) }}" width="900">
                                    <div>
                                        <label for="foto" >Ganti Foto Profil</label>
                                        <input type="file" name="foto" id="foto" class="form-control rounded-pill"> 
                                    </div>
                                </div>
                                <div class="col-lg-8 px-5">
                                    <div class="my-2">
                                        <label for="Name">Nama Lengkap</label>
                                        <input type="text" name="name" id="name" class="form-control rounded-pill" value="{{ Auth::user()->name }}">
                                    </div>
                                    <div class="my-2">
                                        <label for="jk">Jenis Kelamin</label>
                                        <select name="jk" id="jk" class="form-control rounded-pill">
                                            <option value="" selected disabled>{{ Auth::user()->jk }}</option>
                                            <option value="Laki-Laki">Laki-Laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                    </div>
                                    <div class="row my-2">
                                        <div class="col-lg">
                                            <label for="tempat">Tempat Lahir</label>
                                            <input type="text" name="tempat" id="tempat" class="form-control rounded-pill" value="{{ Auth::user()->tempat }}">
                                        </div>
                                        <div class="col-lg">
                                            <label for="tgl_lahir">Tanggal Lahir</label>
                                            <input type="date" name="tgl_lahir" id="tgl_lahir" class="form-control rounded-pill" value="{{ Auth::user()->tgl_lahir }}">
                                        </div>
                                    </div>
                                    <div class="row my-2">
                                        <div class="col-lg">
                                            <label for="nohp">No Telepon</label>
                                            <input type="text" name="nohp" id="nohp" class="form-control rounded-pill" value="{{ Auth::user()->nohp }}">
                                        </div>
                                        <div class="col-lg">
                                            <label for="email">Email</label>
                                            <input type="text" name="email" id="email" class="form-control rounded-pill" value="{{ Auth::user()->email }}">
                                        </div>
                                    </div>
                                    <div class="my-4">
                                        <input type="submit" value="Perbarui Profil" class="btn btn-primary rounded-pill float-end" id="profil_btn">
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
    <!-- Ganti Kata Sandi -->
    <div class="card shadow">
        <div class="card-header">
            <h2 class="text-primary fw-bold ">Ganti Kata Sandi</h2>
        </div>
        <div class="card-body p-5">
            @if(session('success'))
            <p class="alert alert-success">{{ session('success') }}</p>
            @endif
            @if($errors->any())
            @foreach($errors->all() as $err)
            <p class="alert alert-danger">{{ $err }}</p>
            @endforeach
            @endif
            <form action="{{ route('password.action') }}" method="POST">
                @csrf
            <div class="my-2">
                <label for="Name">Kata Sandi Lama</label>
                <input type="password" name="old_password" id="myInput" class="form-control rounded-pill">
            </div>
            <div class="my-2">
                <label for="Name">Kata Sandi Baru</label>
                <input type="password" name="new_password" id="myInput2" class="form-control rounded-pill">
            </div>
            <div class="my-2">
                <label for="Name">Konfirmasi Kata Sandi Baru</label>
                <input type="password" name="new_password_confirmation" id="myInput3" class="form-control rounded-pill">
            </div>
            <div class="my-2">
                <input type="checkbox" onclick="myFunction2()"> Tampilkan Kata Sandi
            </div>
            <div class="my-4">
                <button class="btn btn-primary rounded-pill float-end">Ganti</button>
            </div>
        </div>
    </div>
    <!-- Ganti Kata Sandi -->
                </div>
            </div>
        </div>
    </div>
    <!-- Tampilan Profil -->

@include('footer.userfooter')

</body>

<!-- Back to Top -->
<a href="#" class="btn btn-lg btn-primary btn-lg-square rounded back-to-top"><i class="bi bi-arrow-up"></i></a>

<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="utama/lib/wow/wow.min.js"></script>
<script src="utama/lib/easing/easing.min.js"></script>
<script src="utama/lib/waypoints/waypoints.min.js"></script>
<script src="utama/lib/counterup/counterup.min.js"></script>
<script src="utama/lib/owlcarousel/owl.carousel.min.js"></script>

<!-- Template Javascript -->
<script src="utama/js/main.js"></script>

<script>
    function myFunction2() {
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
        var y = document.getElementById("myInput3");
        if (y.type === "password") {
        y.type = "text";
        } else {
        y.type = "password";
        }
        }
    </script>
</html>