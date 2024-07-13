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
                            <a href="/profil" class="dropdown-item">Profil</a>
                            <a href="/tambahiklan" class="dropdown-item active">Pesan Iklan</a>
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
                <h1 class="display-4 text-white animated zoomIn">Pesan Iklan</h1>
                <a href="/iklansaya" class="h5 text-white">Iklan Saya</a>
                <i class="far fa-circle text-white px-2"></i>
                <a href="#" class="h5 text-white">Pesan Iklan</a>
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
                        <h2 class="text-primary fw-bold ">Tambah Data Iklan</h2>
                    </div>
                    <div class="card-body p-5">
                        <form id="uploadForm" method="post" action="{{ route('store.iklan') }}" enctype="multipart/form-data">
                            @csrf
                        <div class="my-2 pb-2">
                            <label for="judul"><b>Judul Iklan</label>
                            <input type="judul" name="judul" id="judul" maxlength="30" class="form-control" required>
                        </div>
                        <div class="my-2 pb-2">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" class="form-control" rows="7" required></textarea>
                        </div>
                        <div class="row my-2 pb-2">
                            <div class="col-lg">
                                <label for="jam_buka">Jam Buka</label>
                                <input type="time" name="jam_buka" id="jam_buka" class="form-control rounded-pill" required>
                            </div>
                            <div class="col-lg">
                                <label for="jam_tutup">Jam Tutup</label>
                                <input type="time" name="jam_tutup" id="jam_tutup" class="form-control rounded-pill" required>
                            </div>
                        </div>
                        <div class="row my-2 pb-2">
                            <label>Hari Kerja</b></label>
                                <div class="form-check col-lg">
                                    <input class="form-check-input" name="hari_kerja[]" type="checkbox" value="senin" id="flexCheckSenin">
                                    <label class="form-check-label" for="flexCheckSenin">
                                    Senin
                            </label>
                        </div>
                        <div class="form-check col-lg">
                            <input class="form-check-input" name="hari_kerja[]" type="checkbox" value="selasa" id="flexCheckSelasa">
                            <label class="form-check-label" for="flexCheckSelasa">
                            Selasa
                            </label>
                        </div>
                        <div class="form-check col-lg">
                            <input class="form-check-input" name="hari_kerja[]" type="checkbox" value="rabu" id="flexCheckRabu">
                            <label class="form-check-label" for="flexCheckRabu">
                            Rabu
                            </label>
                        </div>
                        <div class="form-check col-lg">
                            <input class="form-check-input" name="hari_kerja[]" type="checkbox" value="kamis" id="flexCheckKamis">
                            <label class="form-check-label" for="flexCheckKamis">
                            Kamis
                            </label>
                        </div>
                        <div class="form-check col-lg">
                            <input class="form-check-input" name="hari_kerja[]" type="checkbox" value="jum'at" id="flexCheckJum'at">
                            <label class="form-check-label" for="flexCheckJum'at">
                            Jum'at
                            </label>
                        </div>
                        <div class="form-check col-lg">
                            <input class="form-check-input" name="hari_kerja[]" type="checkbox" value="sabtu" id="flexCheckSabtu">
                            <label class="form-check-label" for="flexCheckSabtu">
                            Sabtu
                            </label>
                        </div>
                        <div class="form-check col-lg">
                            <input class="form-check-input" name="hari_kerja[]" type="checkbox" value="minggu" id="flexCheckMinggu">
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
                                    <option value="{{ $jenisiklan->id }}">{{ $jenisiklan->jenis }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group pb-2">
                            <label for="provinces"><b>Provinsi</label>
                            <select class="form-control" name="provinsi" id="provinces" required>
                                <option selected>-- Pilih Provinsi --</option>
                                @foreach ($provinces as $province)
                                    <option value="{{ $province->name }}">{{ $province->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group pb-2">
                            <label for="regencies"><b>Kabupaten</b></label>
                            <select name="kabupaten" id="regencies" class="form-control" required>
                                <option selected>-- Pilih Kabupaten --</option>
                            </select>
                        </div>
                        <div class="form-group pb-2">
                            <label for="districts"><b>Kecamatan</b></label>
                            <select name="kecamatan" id="districts" class="form-control" required>
                                <option selected>-- Pilih Kecamatan --</option>
                            </select>
                        </div>
                        <div class="form-group pb-2">
                            <label for="villages"><b>Kelurahan/Desa</b></label>
                            <select name="desa" id="villages" class="form-control" required>
                                <option selected>-- Pilih Desa --</option>
                            </select>
                        </div>
                        <div class="form-group pb-2">
                            <label for="alamat"><b>Alamat</label>
                            <input type="text" name="alamat" id="alamat" class="form-control" placeholder="Nomor Rumah / Blok / Dusun / Nama Jalan" required>
                        </div>

                        <div class="form-group pb-2">
                            <label for="kodepos"><b>Kode pos</label>
                            <input type="text" name="kode_pos" id="kode_pos" class="form-control" required>
                        </div>
                        <div class="form-group pb-2">
                            <label for="nohp"><b>No Telepon</label>
                            <input type="telp" name="nohp" id="nohp" maxlength="15" class="form-control" value="{{ Auth::user()->nohp }}" required>
                        </div>
                        <div class="form-group pb-2">
                            <label for="email"><b>Email</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ Auth::user()->email }}" required>
                        </div>

                        <div class="form-group pb-2">
                            <div class="mb-4">
                                @csrf
                                <input type="file" name="gambar[]" id="gambar" accept="image/*" multiple required onchange="previewImage()">
                            </div>
                            <div id="fileSizeInfo"></div>
                        </div>
                        <div id="imagePreview"></div>
                        <div class="my-4">
                        <button type="submit" class="btn btn-primary rounded-pill float-end" id="btnSubmit">Pesan</button>
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
<script src="utama/lib/wow/wow.min.js"></script>
<script src="utama/lib/easing/easing.min.js"></script>
<script src="utama/lib/waypoints/waypoints.min.js"></script>
<script src="utama/lib/counterup/counterup.min.js"></script>
<script src="utama/lib/owlcarousel/owl.carousel.min.js"></script>

<!-- Button -->
<script>
   $('#btnSubmit').on('click', function(event) {
    event.preventDefault();

    // Validasi input di sini
    if (!$('#provinces').val() || !$('#regencies').val() || !$('#districts').val() || !$('#villages').val() || !$('#gambar').val()) {
        // Tampilkan pesan kesalahan atau lakukan sesuatu sesuai kebutuhan
        alert('Semua field harus diisi!');
        return;
    }

    // Lakukan sesuatu sebelum mengirim formulir jika diperlukan
    var form_data = new FormData();
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
        url: "/store-iklan",
        method: 'POST',
        data: form_data,
        dataType: 'json',
        contentType: false,
        processData: false,
        success: function(response) {
            console.log(response);
            // Lakukan sesuatu setelah berhasil mengirim formulir
            window.location.href = "{{URL::to('pembayaran')}}"
        },
        error: function(error) {
            console.error(error);
        }
    });
});
</script>

<!-- Alamat JS -->
<script src="utama/js/main.js"></script>
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
                const fileSize = formatBytes(imageInput.files[i].size);
                document.getElementById('fileSizeInfo').innerHTML += `File ${i + 1}: ${fileSize}<br>`;
            } else {
                console.error('Error: Element with id "imagePreview" not found.');
            }
        };

        reader.readAsDataURL(imageInput.files[i]);
    }
    
    function formatBytes(bytes, decimals = 2) {
    if (bytes === 0) return '0 Bytes';

    const k = 1024;
    const dm = decimals < 0 ? 0 : decimals;
    const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];

    const i = Math.floor(Math.log(bytes) / Math.log(k));

    return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
}
}
</script>
</html>