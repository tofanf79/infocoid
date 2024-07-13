<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Info.co.id - Tentang</title>
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
                <a href="/tentang" class="nav-item nav-link actived">Tentang Kami</a>
            </div>
            <a href="login" class="btn btn-primary py-2 px-4 ms-3">Beriklan Sekarang !</a>
            </div>
        </div>
    </nav>

    <div class="container-fluid bg-primary py-4 bg-header" style="margin-bottom: 80px;">
        <div class="row py-5">
            <div class="col-12 pt-lg-5 mt-lg-5 text-center">
                <h1 class="display-4 text-white animated zoomIn">Tentang & Visi Misi</h1>
                <a href="/" class="h5 text-white">Beranda</a>
                <i class="far fa-circle text-white px-2"></i>
                <a href="#" class="h5 text-white">Tentang & Visi Misi</a>
            </div>
        </div>
    </div>
</div>
<!-- Navbar & Carousel End -->

    @include('content.alltentang')

    @include('footer.guestfooter')

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
</html>