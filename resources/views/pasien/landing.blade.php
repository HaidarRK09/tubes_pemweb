@extends('pasien.dashboard')

@section('title', 'Klinik Cikijing | Pasien')
@section('page-title', 'Pasien')
@section('page-subtitle', 'Akun')
@section('breadcrumb', 'Pasien Dashboard')

@section('content')
    <div class="row">
        <div class="col-lg-4 d-flex flex-column">
            <div class="row flex-grow">
              <div class="col-12 col-lg-4 col-lg-12 grid-margin stretch-card">
                <div class="card card-rounded">
                  <div class="card-body">
                    <div class="d-sm-flex justify-content-between align-items-start">
                      <div>
                       <h4 class="card-title card-title-dash">Nomor Antrian Sekarang :</h4>
                       <h5 class="card-subtitle card-subtitle-dash">
                        @if ($antrianlive !== null)
                          {{ $antrianlive }}
                        @else
                          Tidak ada antrian sekarang
                        @endif
                       </h5>
                      </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 d-flex flex-column">
          <div class="row flex-grow">
            <div class="col-12 col-lg-4 col-lg-12 grid-margin stretch-card">
              <div class="card card-rounded">
                <div class="card-body">
                  <div class="d-sm-flex justify-content-between align-items-start">
                    <div>
                      <h4 class="card-title">Buat booking :</h4>
                      @if ($hari && $tanggal)
                          <!-- Jika $hari dan $tanggal tidak null -->
                          <button class="btn btn-dark btn-lg btn-block" onclick="tampilkanPopup()">
                              Klik Disini
                          </button>
                  
                          <!-- Pop-up (disembunyikan awalnya) -->
                          <div id="popup" style="display: none;">
                              <p>Anda sudah memiliki jadwal berobat.</p>
                              <!-- Tambahkan tombol atau tindakan lain di sini jika diperlukan -->
                          </div>
                  
                          <!-- Script untuk menampilkan pop-up -->
                          <script>
                              function tampilkanPopup() {
                                  document.getElementById('popup').style.display = 'block';
                              }
                          </script>
                      @else
                          <!-- Jika $hari atau $tanggal null -->
                          <a href="{{ route('pasien.booking.form') }}" class="btn btn-dark btn-lg btn-block">
                              Klik Disini
                          </a>
                      @endif
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>   
    </div>
    <div class="row">
      <div class="col-lg-4 d-flex flex-column">
        <div class="row flex-grow">
          <div class="col-12 col-lg-4 col-lg-12 grid-margin stretch-card">
            <div class="card card-rounded">
              <div class="card-body">
                    <h4 class="card-title">Jadwal Berobat Anda</h4>
                    @if ($hari !== null && $tanggal !== null)
                        <h5>{{ $hari }}, {{ $tanggal }}</h5>
                    @else
                        <h5>Anda belum melakukan booking</h5>
                    @endif
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4 d-flex flex-column">
        <div class="row flex-grow">
          <div class="col-12 col-lg-4 col-lg-12 grid-margin stretch-card">
            <div class="card card-rounded">
              <div class="card-body">
                    <h4 class="card-title">Nomor Antrian Anda :</h4>
                    @if ($antrian !== null)
                        <h5>{{ $antrian }}</h5>
                    @else
                        <h5>Anda belum melakukan booking</h5>
                    @endif
              </div>
            </div>
          </div>
        </div>
    </div>
    </div>
@endsection


