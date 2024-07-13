<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>Info.co.id - Iklan Detail</title>
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

  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
  <link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css" rel="stylesheet" />
  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
  <script src="https://unpkg.com/sweetalert2@7.12.10/dist/sweetalert2.all.js"></script>
</head>

<body class="g-sidenav-show   bg-gray-100">
  
  @include('admin.topbar')
  
  <main class="main-content position-relative border-radius-lg ">
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <h3 class="font-weight-bolder">
                      Iklan
                    </h3>
                  </div>
                </div>
              </div>
                <div class="row g-5">
                    @foreach($data['gambar'] as $dat)
                        <div class="col-md-4 position-relative overflow-hidden" style="text-align: center;">
                            <img class="img-fluid" src="{{ asset($dat['path']) }}" alt="">
                        </div>
                    @endforeach
                    @if($data['gambar']->isEmpty())
                        <div class="col-md-4 position-relative overflow-hidden" style="text-align: center;">
                        </div>
                    @endif
                </div>
                <div class="p-4">
                    <div class="d-flex mb-3">
                        <small><i class="far fa-calendar-alt text-primary me-2"></i>{{ $data['hari_kerja'] }}</small>
                    </div>
                    <div class="d-flex mb-3">
                        <small><i class="far fa-clock text-primary me-2"></i>{{ $data['jam_buka'] }} - {{ $data['jam_tutup'] }}</small>
                    </div>
                    <h4 class="mb-3">{{ $data['judul'] }}</h4>
                    <p>{{ $data['deskripsi'] }}</p>
                    <small>Provinsi : {{ $data['provinsi'] }}</small><br>
                    <small>Kabupaten : {{ $data['kabupaten'] }}</small><br>
                    <small>Kecamatan : {{ $data['kecamatan'] }}</small><br>
                    <small>Desa : {{ $data['desa'] }}</small><br>
                    <small>Alamat : {{ $data['alamat'] }}</small><br>
                    <small>Bayar : {{ $data['bayar'] }}</small><br>
                    <small>Tanggal Bayar : {{ $data['tanggal_bayar'] }}</small><br>
                    <small>Kode Pos : {{ $data['kode_pos'] }}</small><br>
                    <small>No HP : {{ $data['nohp'] }}</small><br>
                    <small>Email : {{ $data['email'] }}</small><br>
                    <small>User : {{ $data['user'] }}</small><br>
                    <small>Iklan hanya berlaku untuk 1 tahun</small>
                    <div class="row" style="margin:20px">
                        <img class="img-fluid" src="{{ url($data['link_bayar']) }}" style="max-width:300px">
                    </div>
                </div>
            </div>
          </div>
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