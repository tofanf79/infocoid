<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Info.co.id - Beranda</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link href="{{asset('utama/img/favicon.ico')}}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&family=Rubik:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{asset('utama/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{asset('utama/lib/animate/animate.min.css')}}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{asset('utama/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{asset('utama/css/style.css')}}" rel="stylesheet">
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
                            <a href="/profil" class="dropdown-item">Profil</a>
                            <a href="/tambahiklan" class="dropdown-item">Pesan Iklan</a>
                            <a href="/pembayaran" class="dropdown-item">Pembayaran</a>
                            <a href="/iklansaya" class="dropdown-item active">Info Iklan</a>
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
                <h1 class="display-4 text-white animated zoomIn">Edit Iklan</h1>
                <a href="/iklansaya" class="h5 text-white">Iklan Saya</a>
                <i class="far fa-circle text-white px-2"></i>
                <a href="#" class="h5 text-white">Edit Iklan</a>
            </div>
        </div>
    </div>
</div>
<!-- Navbar & Carousel End -->

<div class="container">
    <div class="testimonial-item bg-light my-4">
        <div class="d-flex  pb-4 px-5">
            <div class="row gy-3 gx-4 justify-content-center mt-4 mb-4" style="width: 104%">
                <!-- Input Iklan -->
                <div class="card shadow">
                    <div class="card-header">
                        <h2 class="text-primary fw-bold ">Edit Data Iklan</h2>
                    </div>
                    <div class="card-body p-5">
                        <form id="uploadForm" method="post" action="{{ route('iklan.edit_action') }}" enctype="multipart/form-data">
                            @csrf
                        <input type="hidden" name="id_iklan" id="id_iklan" class="form-control" required value="{{$data['id_iklan']}}">
                        <div class="my-2 pb-2">
                            <label for="judul"><b>Judul Iklan</label>
                            <input type="judul" name="judul" id="judul" class="form-control" required value="{{$data['judul']}}">
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
                        <button type="submit" class="btn btn-primary rounded-pill float-end" id="btnSubmit">Edit</button>
                        </form>
                        </div>

                    </div>
                </div>
                <!-- Input Iklan -->
            </div>
        </div>
    </div>
</div>


    @include('footer.userfooter')

</body>

<style>
    #imagePreview {
        display: flex;
        flex-wrap: wrap;
        gap: 10px; /* Jarak antara gambar */
    }

    .preview-image {
        max-width: 100%;
        max-height: 200px; /* Atur tinggi gambar */
        object-fit: cover; /* Pastikan gambar diisi ke dalam ukuran yang diberikan */
    }
</style>

<!-- Back to Top -->
<a href="#" class="btn btn-lg btn-primary btn-lg-square rounded back-to-top"><i class="bi bi-arrow-up"></i></a>

<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/compressorjs@1.2.1/dist/compressor.min.js"></script>
<script src="{{asset('utama/lib/wow/wow.min.js')}}"></script>
<script src="{{asset('utama/lib/easing/easing.min.js')}}"></script>
<script src="{{asset('utama/lib/waypoints/waypoints.min.js')}}"></script>
<script src="{{asset('utama/lib/counterup/counterup.min.js')}}"></script>
<script src="{{asset('utama/lib/owlcarousel/owl.carousel.min.js')}}"></script>

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
        url: "/iklansaya/edit_action",
        method: 'POST',
        data: form_data,
        dataType: 'json',
        contentType: false,
        processData: false,
        success: function(response) {
            console.log(response);
            // Lakukan sesuatu setelah berhasil mengirim formulir
            window.location.href = "{{URL::to('iklansaya')}}/{{$data['id_iklan']}}"
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