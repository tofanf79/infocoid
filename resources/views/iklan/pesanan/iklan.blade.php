
    <!-- Blog Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                @isset($data['search'])
                    <h2 class="mb-3" style="text-align:center">Cari : {{$data['search']}}</h2>
                @else
                    <h2 class="mb-3" style="text-align:center">Semua Iklan</h2>
                @endisset
                <!-- Blog list Start -->
                <div class="col-lg-12">
                    <div class="row g-5">
                      @foreach($data['iklan'] as $dat)
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
                <!-- Blog list End -->
    
            </div>
        </div>
    </div>
    <!-- Blog End -->
