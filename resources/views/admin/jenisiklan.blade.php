<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>Info.co.id - Jenis Iklan</title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
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
                      Jenis Iklan
                    </h3>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <a href="./jenisiklan/tambah" class="icon icon-shape bg-gradient-primary shadow-warning text-center rounded-circle">
                    <i class="ni ni-fat-add text-lg opacity-10" aria-hidden="true"></i>
                  </a>
                </div>
              </div>

              <table id="example"  class="table table-striped nowrap" style="width:100%">
                  <thead>
                      <tr>
                          <th>Jenis</th>
                          <th>Aksi</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach($data as $dat)
                      <tr>
                          <td>{{ $dat['jenis'] }}</td>
                          <td>
                            <a href="/admin/jenisiklan/edit/{{ $dat['id'] }}" class="btn btn-warning">Edit</a>
                            <button id="button-hapus" data-id="{{ $dat['id'] }}" class="btn btn-danger">Hapus</button>
                          </td>
                      </tr>
                      @endforeach
                  </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      
      @include('admin.footer')
    </div>
  </main>
  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/argon-dashboard.min.js?v=2.0.4"></script>
  <script>
    new DataTable('#example', {
      responsive: true
    });
    $('#example tbody').on('click', '#button-hapus', function() {
    temp = this;
    swal({
        title: 'Hapus Data ?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
      } ).then(function (result) {
        if(result.value){
          var id = temp.getAttribute("data-id");  
          $.ajax({  
            url:"/admin/jenisiklan/hapus/"+id,  
            method:"get",
            success:function(data){
              if (data['data'] == "Berhasil") {
                swal({
                  title: 'Data Berhasil Dihapus',
                  showDenyButton: false,
                  showCancelButton: false,
                  confirmButtonText: 'Ok',
                }).then((result) => {
                  location.reload(true);
                })
              }else if (data['data'] = "Tidak Dapat Dihapus") {
                swal({
                  title: 'Data Gagal Dihapus',
                  showDenyButton: false,
                  showCancelButton: false,
                  confirmButtonText: 'Ok',
                }).then((result) => {
                  location.reload(true);
                })
              } else {
                swal({
                  title: 'Error',
                  showDenyButton: false,
                  showCancelButton: false,
                  confirmButtonText: 'Ok',
                }).then((result) => {
                  location.reload(true);
                })
              } 
            }  
          }).catch(error => {
                swal({
                  title: 'Data Gagal Dihapus',
                  showDenyButton: false,
                  showCancelButton: false,
                  confirmButtonText: 'Ok',
                }).then((result) => {
                  location.reload(true);
                })
      }); 
        }
      });
    });
  </script>
</body>

</html>