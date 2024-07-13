
    <!-- Blog Start -->
<div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-8">
                <!-- Blog Detail Start -->
                <div class="blog-item bg-light rounded overflow-hidden">
                <div class="mb-5">
                    @foreach($data['gambar'] as $dat)
                                        <div class="img-fluid w-100 rounded">
                                            <img class="img-fluid" src="
                                            @if(isset($dat['path_dwt']))
                                              {{ asset($dat['path_dwt']) }}
                                            @else 
                                              {{ asset($dat['path']) }}
                                            @endif
                                            " alt="">
                                        </div>
                                    @endforeach
                    <div class="pt-4">
                        <h1 class="mb-4">{{ $data['judul'] }}</h1>
                    </div>
                    <div class="pt-4">
                       <pre class="custom-pre">{{ $data['deskripsi'] }}</pre>
                    </div>
                </div>
                </div>
                <!-- Blog Detail End -->
            </div>

            <!-- Sidebar Start -->
            <div class="col-lg-4">
                <!-- Detail Post Start -->
                <div class="mb-5 wow slideInUp" data-wow-delay="0.1s">
                    <div class="section-title section-title-sm position-relative pb-3 mb-4">
                        <h3 class="mb-0">Detail</h3>
                    </div>
                    <div class="blog-item bg-light rounded overflow-hidden">
                    <div class="d-flex rounded overflow-hidden mb-3" style="text-align: center;>
                        <div class="d-flex mb-3">
                        </div>
                        <div class="d-flex mb-3 p-1">
                            <small><i class="bi bi-exclamation-octagon-fill text-primary me-2"></i>{{ $data['jenis'] }}</small><br>
                        </div>
                        <div class="d-flex mb-3 p-1">
                            <small><i class="far fa-calendar-alt text-primary me-2"></i>{{ $data['hari_kerja'] }}</small><br>
                        </div>
                        <div class="d-flex mb-3 p-1">
                            <small><i class="far fa-clock text-primary me-2"></i>{{ $data['jam_buka'] }} - {{ $data['jam_tutup'] }}</small><br>
                        </div>
                        <div class="d-flex mb-3 p-1">
                            <small><i class="bi bi-map text-primary me-2"></i>{{ $data['alamat'] }}, DESA {{ $data['desa'] }}, KECAMATAN {{ $data['kecamatan'] }}, {{ $data['kabupaten'] }}, PROVINSI {{ $data['provinsi'] }} {{ $data['kode_pos'] }}</small><br>
                        </div>
                        <div class="d-flex mb-3 p-1">
                          <small><i class="bi bi-telephone text-primary me-2"></i>{{ $data['nohp'] }}</small><br>
                      </div>
                      <div class="d-flex mb-3 p-1">
                          <small><i class="bi bi-envelope text-primary me-2"></i>{{ $data['email'] }}</small><br>
                      </div>
                      <div class="d-flex justify-content-center mb-3 p-1">
                          <small>Bayar : {{ $data['bayar'] }}</small><br>
                      </div>

                                 @if($data['bayar'] == 'Belum')
                                <div class="row justify-content-center" style="margin:20px" >
                                <img class="img-fluid" src="{{ url($data['link_bayar']) }}" style="max-width:300px">
                                </div>
                                @endif
                    </div>
                    </div>
                </div>
                <!-- Detail Post End -->
            </div>
            <!-- Sidebar End -->
        </div>
    </div>
</div>
<!-- Blog End -->

<style>
        .custom-pre {
            white-space: pre-wrap;
        }
</style>