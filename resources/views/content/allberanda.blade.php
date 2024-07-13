<!-- Facts Start -->
<div class="container-fluid facts py-5 pt-lg-0">
    <div class="container py-5 pt-lg-0">
        <div class="row gx-0">
            <div class="col-lg-4 wow zoomIn" data-wow-delay="0.1s">
                <div class="bg-primary shadow d-flex align-items-center justify-content-center p-4" style="height: 150px;">
                    <div class="bg-white d-flex align-items-center justify-content-center rounded mb-2" style="width: 60px; height: 60px;">
                        <i class="fa fa-coffee fa-2x text-primary"></i>
                    </div>
                    <div class="ps-4">
                        <h5 class="text-white mb-0">Cafe & Restaurant</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 wow zoomIn" data-wow-delay="0.3s">
                <div class="bg-light shadow d-flex align-items-center justify-content-center p-4" style="height: 150px;">
                    <div class="bg-primary d-flex align-items-center justify-content-center rounded mb-2" style="width: 60px; height: 60px;">
                        <i class="fa fa-plane fa-2x text-white"></i>
                    </div>
                    <div class="ps-4">
                        <h5 class="text-primary mb-0">Tempat Wisata</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 wow zoomIn" data-wow-delay="0.6s">
                <div class="bg-primary shadow d-flex align-items-center justify-content-center p-4" style="height: 150px;">
                    <div class="bg-white d-flex align-items-center justify-content-center rounded mb-2" style="width: 60px; height: 60px;">
                        <i class="fa fa-cogs fa-2x text-primary"></i>
                    </div>
                    <div class="ps-4">
                        <h5 class="text-white mb-0">Jasa & Servis</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Facts Start -->

<!-- Blog Start -->
<div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 900px;">
            <h5 class="fw-bold text-primary text-uppercase">Temukan Tempat Baru</h5>
            <h1 class="mb-0">Temukan Dihalaman Kami Untuk Dapat Membantu Dalam Menemukan Pelaku Usaha Hingga Skala Terkecil</h1>
        </div>
        <div class="row g-5">
            @foreach($iklan as $dat)
            <div class="col-md-4 wow slideInUp" data-wow-delay="0.1s">
                <div class="blog-item bg-light rounded overflow-hidden">
                    <div class="blog-img position-relative overflow-hidden">
                        <img class="img-fluid" src="{{ asset($dat['gambar']) }}" alt="">
                        <div class="position-absolute top-0 start-0 bg-primary text-white rounded-end mt-5 py-2 px-4" href="">{{ $dat['jenis'] }}</div>
                    </div>
                    <div class="p-4">
                        <div class="d-flex mb-3">
                            <small class="me-3"><i class="fas fa-map-marker-alt text-primary me-2"></i>{{$dat['kabupaten']}}</small>
                        @php
                            $jamBukaStr = $dat['jam_buka'];
                            $jamTutupStr = $dat['jam_tutup'];
                            $openTime = new DateTime($jamBukaStr, new DateTimeZone('Asia/Jakarta'));
                            $closeTime = new DateTime($jamTutupStr, new DateTimeZone('Asia/Jakarta'));
                            $currentTime = new DateTime(null, new DateTimeZone('Asia/Jakarta'));
                        @endphp

                        @php
                            $status = "";
                            if ($currentTime >= $openTime && $currentTime <= $closeTime) {
                                $status = "Sedang buka";
                                $statusClass = "text-success";
                            } else {
                                $status = "Sedang tutup";
                                $statusClass = "text-danger";
                            }
                        @endphp
                            <small class="{{ $statusClass }}"><i class="far fa-clock text-primary me-2"></i>{{ $status }}</small>
                        </div>
                        <h4 class="mb-3">{{ $dat['judul'] }}</h4>
                        <p>{{ $dat['deskripsi'] }}</p>
                        <a href="{{ route('guest.iklan.detail',$dat['id']) }}" class="text-uppercase" href="">Detail<i class="bi bi-arrow-right"></i></a>
                        </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Blog Start -->
<div class="text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 900px;">
    <a href="/iklan">>> Lihat Semua<<</a>
</div>