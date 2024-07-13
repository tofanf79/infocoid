<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.pngs') }}">
  <title>Info.co.id - Beranda</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                      Edit Iklan
                    </h3>
                  </div>
                </div>
              </div>
              <form id="uploadForm" action="{{ url('/admin/iklan/edit_action') }}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="id_iklan" id="id_iklan" value="{{ $data->id }}">
                <div class="form-group">
                  <label for="">Judul</label>
                  <input type="text" class="form-control" id="judul" name="judul" value="{{ $data->judul }}" required>
                </div>
                
                        <div class="my-2 pb-2">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" class="form-control" rows="7" required>{{$data['deskripsi']}}</textarea>
                        </div>
                        <div class="row my-2 pb-2">
                            <div class="col-lg">
                                <label for="jam_buka">Jam Buka</label>
                                <input type="time" name="jam_buka" id="jam_buka" class="form-control rounded-pill" required value="{{$data['jam_buka']}}">
                            </div>
                            <div class="col-lg">
                                <label for="jam_tutup">Jam Tutup</label>
                                <input type="time" name="jam_tutup" id="jam_tutup" class="form-control rounded-pill" required value="{{$data['jam_tutup']}}">
                            </div>
                        </div>
                        <div class="row my-2 pb-2">
                            <label>Hari Kerja</b></label>
                                <div class="form-check col-lg">
                                    <input class="form-check-input" name="hari_kerja[]" type="checkbox" value="senin" id="flexCheckSenin" 
                                    @if(in_array('senin', $data['hari_kerja']))
                                        checked
                                    @endif>
                                    <label class="form-check-label" for="flexCheckSenin">
                                    Senin
                            </label>
                        </div>
                        <div class="form-check col-lg">
                            <input class="form-check-input" name="hari_kerja[]" type="checkbox" value="selasa" id="flexCheckSelasa" 
                                    @if(in_array('selasa', $data['hari_kerja']))
                                        checked
                                    @endif>
                            <label class="form-check-label" for="flexCheckSelasa">
                            Selasa
                            </label>
                        </div>
                        <div class="form-check col-lg">
                            <input class="form-check-input" name="hari_kerja[]" type="checkbox" value="rabu" id="flexCheckRabu" 
                                    @if(in_array('rabu', $data['hari_kerja']))
                                        checked
                                    @endif>
                            <label class="form-check-label" for="flexCheckRabu">
                            Rabu
                            </label>
                        </div>
                        <div class="form-check col-lg">
                            <input class="form-check-input" name="hari_kerja[]" type="checkbox" value="kamis" id="flexCheckKamis" 
                                    @if(in_array('kamis', $data['hari_kerja']))
                                        checked
                                    @endif>
                            <label class="form-check-label" for="flexCheckKamis">
                            Kamis
                            </label>
                        </div>
                        <div class="form-check col-lg">
                            <input class="form-check-input" name="hari_kerja[]" type="checkbox" value="jum'at" id="flexCheckJum'at" 
                                    @if(in_array('senin', $data['hari_kerja']))
                                        checked
                                    @endif>
                            <label class="form-check-label" for="flexCheckJum'at">
                            Jum'at
                            </label>
                        </div>
                        <div class="form-check col-lg">
                            <input class="form-check-input" name="hari_kerja[]" type="checkbox" value="sabtu" id="flexCheckSabtu" 
                                    @if(in_array('sabtu', $data['hari_kerja']))
                                        checked
                                    @endif>
                            <label class="form-check-label" for="flexCheckSabtu">
                            Sabtu
                            </label>
                        </div>
                        <div class="form-check col-lg">
                            <input class="form-check-input" name="hari_kerja[]" type="checkbox" value="minggu" id="flexCheckMinggu" 
                                    @if(in_array('minggu', $data['hari_kerja']))
                                        checked
                                    @endif>
                            <label class="form-check-label" for="flexCheckMinggu">
                            Minggu
                            </label>
                        </div>
                        </div>
                        
                        <div class="form-group pb-2">
                            <label for="id_jenis"><b>Jenis Iklan</label>
                            <select class="form-control" name="id_jenis" id="id_jenis" required>
                                <option selected>-- Pilih Jenis Iklan --</option>
                                @foreach ($jenisiklans as $jenisiklan)
                                    <option value="{{ $jenisiklan->id }}" 
                                    @if($jenisiklan->id == $data['id_jenis'])
                                        selected
                                    @endif>{{ $jenisiklan->jenis }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group pb-2">
                            <label for="provinces"><b>Provinsi</label>
                            <select class="form-control" name="provinsi" id="provinces" required>
                                <option selected>-- Pilih Provinsi --</option>
                                @foreach ($provinces as $province)
                                    <option value="{{ $province->name }}" 
                                    @if($province->name == $data['provinsi'])
                                        selected
                                    @endif>{{ $province->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group pb-2">
                            <label for="regencies"><b>Kabupaten</b></label>
                            <select name="kabupaten" id="regencies" class="form-control" required>
                                <option value="{{ $data['kabupaten']->id }}" selected>{{ $data['kabupaten']->name }}</option>
                                <option >-- Pilih Kabupaten --</option>
                            </select>
                        </div>
                        <div class="form-group pb-2">
                            <label for="districts"><b>Kecamatan</b></label>
                            <select name="kecamatan" id="districts" class="form-control" required>
                                <option value="{{ $data['kecamatan']->id }}" selected>{{ $data['kecamatan']->name }}</option>
                                <option >-- Pilih Kecamatan --</option>
                            </select>
                        </div>
                        <div class="form-group pb-2">
                            <label for="villages"><b>Kelurahan/Desa</b></label>
                            <select name="desa" id="villages" class="form-control" required>
                                <option value="{{ $data['desa']->name }}" selected>{{ $data['desa']->name }}</option>
                                <option >-- Pilih Desa --</option>
                            </select>
                        </div>
                        <div class="form-group pb-2">
                            <label for="alamat"><b>Alamat</label>
                            <input type="text" name="alamat" id="alamat" class="form-control" placeholder="Nomor Rumah / Blok / Dusun / Nama Jalan" required value="{{ $data->alamat }}">
                        </div>

                        <div class="form-group pb-2">
                            <label for="kodepos"><b>Kode pos</label>
                            <input type="text" name="kode_pos" id="kode_pos" class="form-control" value="{{ $data->kode_pos }}" required>
                        </div>
                        <div class="form-group pb-2">
                            <label for="nohp"><b>No Telepon</label>
                            <input type="telp" name="nohp" id="nohp" class="form-control" value="{{ $data->nohp }}" required>
                        </div>
                        <div class="form-group pb-2">
                            <label for="email"><b>Email</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ $data->email }}" required>
                        </div>
                            <div class="form-group pb-2">
                            <div class="mb-4">
                                @csrf
                                <input type="file" name="gambar[]" id="gambar" accept="image/*" multiple required onchange="previewImage()">
                            </div>
                        </div>
                        <div id="imagePreview"></div>
                        <div class="my-4">
                <div class="form-group">
                  <button type="submit" class="btn btn-warning" id="btnSubmit">Update</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      
      @include('admin.footer')
    </div>
  </main>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
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

<!-- Priview Gambar -->
<script>
    const imageInput = document.getElementById('gambar');
    const preview = document.getElementById('imagePreview');

    document.getElementById('uploadForm').addEventListener('submit', function(event) {
       event.preventDefault();
    });

    function previewImage() {
    // Bersihkan preview sebelum menambahkan gambar baru
    preview.innerHTML = '';

    // Iterasi melalui setiap file dan tampilkan preview
    for (let i = 0; i < imageInput.files.length; i++) {
        let reader = new FileReader();

        reader.onload = function (e) {
            // Periksa apakah elemen preview ada sebelum menambahkan gambar
            if (preview) {
                // Tampilkan preview gambar
                preview.innerHTML += `<img src="${e.target.result}" alt="Preview Image" class="preview-image">`;
            } else {
                console.error('Error: Element with id "imagePreview" not found.');
            }
        };

        reader.readAsDataURL(imageInput.files[i]);
    }
}
</script>
<!-- Button -->
<script>
    function toDataURL(src, callback, outputFormat) {
        var img = new Image();
        img.crossOrigin = 'Anonymous';
        img.onload = function() {
            var canvas = document.createElement('CANVAS');
            var ctx = canvas.getContext('2d');
            var dataURL;
            canvas.height = this.naturalHeight;
            canvas.width = this.naturalWidth;
            ctx.drawImage(this, 0, 0);
            dataURL = canvas.toDataURL(outputFormat);
            callback(dataURL);
        };
        img.src = src;
        if (img.complete || img.complete === undefined) {
            img.src = "data:image/jpg;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==";
            img.src = src;
        }
    }
    const dataTransfer = new DataTransfer();
    
    @foreach ($data['gambar'] as $dat)
        base64 = ''; 
        toDataURL(
            '{{ asset($dat->path) }}',
            function(dataUrl) {
                base64 = dataUrl;
                const myFile = new File(['{{ asset($dat->path) }}'], base64);
                console.log("{{ asset($dat->path) }}");

                dataTransfer.items.add(myFile);
                
                preview.innerHTML += `<img src="`+base64+`" alt="Preview Image" class="preview-image">`;
            }
        );;
        
    @endforeach
    document.getElementById('gambar').files = dataTransfer.files;
    preview.innerHTML = '';


   $('#btnSubmit').on('click', function(event) {
    event.preventDefault();

    // Validasi input di sini
    if (!$('#provinces').val() || !$('#regencies').val() || !$('#districts').val() || !$('#villages').val()) {
        // Tampilkan pesan kesalahan atau lakukan sesuatu sesuai kebutuhan
        alert('Semua field harus diisi!');
        return;
    }

    // Lakukan sesuatu sebelum mengirim formulir jika diperlukan
    var form_data = new FormData();
    form_data.append('id_iklan', $("#id_iklan").val());
    form_data.append('judul', $("#judul").val());
    form_data.append('deskripsi', $("#deskripsi").val());
    form_data.append('jam_buka', $("#jam_buka").val());
    form_data.append('jam_tutup', $("#jam_tutup").val());
    
    $("input[name^='hari_kerja']").each(function () {
        if($(this).is(":checked")){
            console.log($(this).val());
            form_data.append("hari_kerja[]", $(this).val());
        }
    })
    form_data.append('provinsi', $("#provinces").val());
    form_data.append('kabupaten', $("#regencies").val());
    form_data.append('kecamatan', $("#districts").val());
    form_data.append('desa', $("#villages").val());
    form_data.append('alamat', $("#alamat").val());
    form_data.append('id_jenis', $("#id_jenis").val());
    form_data.append('kode_pos', $("#kode_pos").val());
    form_data.append('nohp', $("#nohp").val());
    form_data.append('email', $("#email").val());
    var totalfiles = document.getElementById('gambar').files.length;
    for (var index = 0; index < totalfiles; index++) {
        form_data.append("gambar[]", document.getElementById('gambar').files[index]);
    }
    console.log(form_data);
    $.ajax({
        url: "/admin/iklan/edit_action",
        method: 'POST',
        data: form_data,
        dataType: 'json',
        contentType: false,
        processData: false,
        success: function(response) {
            console.log(response);
            // Lakukan sesuatu setelah berhasil mengirim formulir
            window.location.href = "{{URL::to('admin/iklan')}}/{{$data['id_iklan']}}"
        },
        error: function(error) {
            console.error(error);
        }
    });
});
</script>

<!-- Alamat JS -->
<script src="{{asset('utama/js/main.js')}}"></script>

<script>

// Fungsi untuk memperbarui dropdown
// Variabel global untuk menyimpan data Kabupaten
function updateDropdown(dropdownId, data) {
    let dropdown = $('#' + dropdownId);
    dropdown.empty();

    if (data && data.default) {
        dropdown.append($('<option>', {
            value: '',
            text: data.default,
        }));
    }

    // Simpan data Kabupaten ke variabel global
    if (data && data.options) {
        regencyOptions = data.options;
        $.each(regencyOptions, function(index, option) {
            dropdown.append($('<option>', {
                value: option.value,
                text: option.text,
            }));
        });
    }
}

// ...



$(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#provinces').on('change', function() {
        let provinceName = $('#provinces').val();
        console.log('Selected Province:', provinceName); // Tambahkan log ini
        $.ajax({
            type: 'POST',
            url: "{{ route('getRegency') }}",
            data: {provinceName: provinceName},
            cache: false,
            success: function(data) {
                updateDropdown('regencies', data);
                updateDropdown('districts');
                updateDropdown('villages');
            },
            error: function(err) {
                console.log('Error fetching regency data:', err); // Tambahkan log ini
            },
        });
    });

    $('#regencies').on('change', function() {
        let regencyId = $('#regencies').val();
        console.log('Selected Regency:', regencyId); // Tambahkan log ini
        $.ajax({
            type: 'POST',
            url: "{{ route('getDistrict') }}",
            data: {regencyId: regencyId},
            cache: false,
            success: function(data) {
                updateDropdown('districts', data);
                updateDropdown('villages');
            },
            error: function(err) {
                console.log('Error fetching district data:', err); // Tambahkan log ini
            },
        });
    });

    $('#districts').on('change', function() {
        let districtId = $('#districts').val();
        console.log('Selected District:', districtId); // Tambahkan log ini
        $.ajax({
            type: 'POST',
            url: "{{ route('getVillage') }}",
            data: {districtId: districtId},
            cache: false,
            success: function(data) {
                updateDropdown('villages', data);
            },
            error: function(err) {
                console.log('Error fetching village data:', err); // Tambahkan log ini
            },
        });
    });
});


</script>

</html>