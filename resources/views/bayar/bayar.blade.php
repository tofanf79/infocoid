
    <!-- Blog Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <!-- Blog list Start -->
                <div class="col-lg-12">
                    <div class="row g-5">
                        <div class="col-md-12 wow slideInUp" data-wow-delay="0.1s">
                            <div class="blog-item bg-light rounded overflow-hidden">
                                @if($data['bayar'] == 'belum')
                                    <div class="p-4">
                                        <h4 class="mb-3">Bayar Iklan</h4>
                                        <h5>{{ $data['judul'] }}</h5><br>
                                        <p>Rp 50.000,-</p>
                                        <button type="button" data-id="{{$data['id']}}" class="btn btn-primary">Bayar</button>
                                    </div>
                                @else
                                    <div class="p-4">
                                        <h4 class="mb-3">Pembayaran Berhasil</h4>
                                        <h5>{{ $data['judul'] }}</h5><br>
                                        <p>Rp 50.000,-</p><br>
                                        <small>Tanggal Bayar : {{ $data['tanggal_bayar'] }}</small>
                                    </div>                                
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Blog list End -->
    
            </div>
        </div>
    </div>
    <!-- Blog End -->
    <script>
    $("button").click(function() {
    temp = this;
    swal({
        title: 'Bayar Iklan ?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
      } ).then(function (result) {
        if(result.value){
          var id = temp.getAttribute("data-id");  
          $.ajax({  
            url:"/bayar/iklan/"+id,  
            method:"get",
            success:function(data){
              if (data['data'] == "Berhasil") {
                swal({
                  title: 'Iklan Berhasil Dibayar',
                  showDenyButton: false,
                  showCancelButton: false,
                  confirmButtonText: 'Ok',
                }).then((result) => {
                   location.reload();
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
          }); 
        }
      });
    });
  </script>
