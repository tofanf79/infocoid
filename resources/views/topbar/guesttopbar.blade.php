<!-- Navbar & Carousel Start -->
<div class="container-fluid position-relative p-0">
    <nav class="navbar navbar-expand-lg navbar-dark px-5 py-3 py-lg-0">
        <a href="/" class="navbar-brand p-0">
            <img src="{{ asset('masuk/images/logo.png') }}" height="40" width="200" alt="logo" class="logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="fa fa-bars"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto py-0">
                <a href="/" class="nav-item nav-link active">Beranda</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Iklan</a>
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
                <a href="/tentang" class="nav-item nav-link">Tentang Kami</a>
                </div>
                <a href="/login" class="btn btn-primary py-2 px-4 ms-3">Beriklan Sekarang !</a>
            </div>
        </div>
    </nav>

    <div id="header-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="w-100" src="{{ asset('utama/img/carousel-1.jpg') }}" alt="Image">
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <div class="p-3" style="max-width: 900px;">
                        <h5 class="text-white text-uppercase mb-3 animated slideInDown">Beranda</h5>
                        <h1 class="display-1 text-white animated zoomIn">Info.co.id</h1>
                        <h3 class="text-white animated zoomIn">"Semua Ada Disini"</h3>
                        <!-- Topbar Search -->
                    </div>
                    <div class="position-relative w-75 mx-auto animated slideInDown">
                        <form method="GET" action="/iklan">
                            <input class="form-control border-0 rounded-pill w-100 py-3 ps-4 pe-5" type="text" placeholder="Eg: Bisbis & Market" name="search">
                            <button type="submit" class="btn btn-primary rounded-pill py-2 px-4 position-absolute top-0 end-0 me-2" style="margin-top: 7px;">Search</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Navbar & Carousel End -->

