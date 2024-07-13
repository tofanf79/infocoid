<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.pngs') }}">
  <title>Info.co.id - Profil</title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="{{ asset('assets/css/argon-dashboard.css?v=2.0.4') }}/" rel="stylesheet" />
</head>

<body class="g-sidenav-show   bg-gray-100">
  
  @include('admin.topbar')
  
  <main class="main-content position-relative border-radius-lg ">
  <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="false">
      <div class="container-fluid py-1 px-3">
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
          </div>
          <ul class="navbar-nav  justify-content-end">
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line bg-white"></i>
                  <i class="sidenav-toggler-line bg-white"></i>
                  <i class="sidenav-toggler-line bg-white"></i>
                </div>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <h3 class="font-weight-bolder">
                      Profil
                    </h3>
                  </div>
                </div>
              </div>
                @if(session('berhasil'))
                <p class="alert alert-success">{{ session('berhasil') }}</p>
                @endif
                @if($errors->any())
                @foreach($errors->all() as $err)
                <p class="alert alert-danger">{{ $err }}</p>
                @endforeach
                @endif
              <form action="{{ url('/admin/profil_action') }}" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <img class="img-fluid rounded-circle img-thumbnail" src="{{ asset('imgprofil/'.Auth::user()->foto) }}" width="900">
                <div>
                    <label for="foto" >Ganti Foto Profil</label>
                    <input type="file" name="foto" id="foto" class="form-control rounded-pill"> 
                </div>
                <div class="form-group">
                    <label for="Name">Nama Lengkap</label>
                    <input type="text" name="name" id="name" class="form-control rounded-pill" value="{{ Auth::user()->name }}">
                </div>
                <div class="form-group">
                    <label for="jk">Jenis Kelamin</label>
                    <select name="jk" id="jk" class="form-control rounded-pill">
                        <option value="" selected disabled>{{ Auth::user()->jk }}</option>
                        <option value="Laki-Laki">Laki-Laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
                <div class="row form-group">
                    <div class="col-lg">
                        <label for="tempat">Tempat Lahir</label>
                        <input type="text" name="tempat" id="tempat" class="form-control rounded-pill" value="{{ Auth::user()->tempat }}">
                    </div>
                    <div class="col-lg">
                        <label for="tgl_lahir">Tanggal Lahir</label>
                        <input type="date" name="tgl_lahir" id="tgl_lahir" class="form-control rounded-pill" value="{{ Auth::user()->tgl_lahir }}">
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg">
                        <label for="nohp">No Telepon</label>
                        <input type="text" name="nohp" id="nohp" class="form-control rounded-pill" value="{{ Auth::user()->nohp }}">
                    </div>
                    <div class="col-lg">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" class="form-control rounded-pill" value="{{ Auth::user()->email }}">
                    </div>
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-warning">Update</button>
                </div>
              </form>
            </div>
          </div>
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
      
      @include('admin.footer')
    </div>
  </main>
  <!--   Core JS Files   -->
  <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
  <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/chartjs.min.js') }}"></script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ asset('assets/js/argon-dashboard.min.js?v=2.0.4') }}"></script>
</body>

</html>