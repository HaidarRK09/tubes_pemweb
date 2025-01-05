@extends('pasien.dashboard')

@section('title', 'Klinik Cikijing | Booking')
@section('page-title', 'Pasien')
@section('page-subtitle', 'Booking')
@section('breadcrumb', 'Pasien Dashboard')

@section('content')
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    Data Diri
                </h4>
                <p class="card-description">
                    Periksa Kembali Data Diri Anda
                </p>
                <form action="{{route('pasien.booking.store')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="NIK">NIK :</label>
                        <input type="text" class="form-control" id="NIK" name="NIK" value="{{ $user->NIK }}" required>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama :</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="{{ $user->nama }}" required>
                    </div>
                    <div class="form-group">
                        <label for="nobpjs">Nomor BPJS :</label>
                        <input type="text" class="form-control" id="nobpjs" name="nobpjs" value="{{ $user->nobpjs }}" required>
                    </div>
                    <div class="form-group">
                        <label for="notlp">Nomor Telepon :</label>
                        <input type="text" class="form-control" id="notlp" name="notlp" value="{{ $user->notlp }}" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email :</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                    </div>
                    <h4 class="card-Title">
                        Pilih Jadwal
                    </h4>
                    <p class="card-description">
                        Pilih Poli dan Jadwal yang Sesuai
                    </p>
                    <button type="button" class="btn btn-outline-primary btn-fw" onclick="toggleJadwal()">
                        Tampilkan Jadwal
                    </button>
                    <div class="form-group">
                        <label for="poli">Pilih Poli</label>
                        <select class="form-control" id="poli" name="poli" required>
                            @foreach ($poli as $item)
                                <option value="{{ $item->id_poli }}"> {{ $item->nama }} </option>
                            @endforeach
                        </select>
                    </div>
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <div class="form-group">
                        <label for="tanggal">Pilih Tanggal</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                    </div>
                    <div class="button">
                        <a href="{{ route('dashboard.pasien') }}" class="btn btn-danger" style="margin-right: 20px;">Kembali</a>
                        <button type="submit" class="btn btn-primary">Pilih Jadwal</button>
                    </div> 
                </form>
            </div>
        </div>
    </div>
    <div id="jadwalDiv" style="display: none;">
    <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    Dokter Umum
                </h4>
                <div class="dokterumum">
                    <div class="dokterumum-body">
                        <p class="card-text">
                            Senin - Sabtu
                        </p>
                        <p class="card-text">
                            08.00 - 15.00
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    Dokter Gigi
                </h4>
                <div class="dokterumum">
                    <div class="dokterumum-body">
                        <p class="card-text">
                            Selasa Kamis Sabtu
                        </p>
                        <p class="card-text">
                            16.00 - Selesai
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    Radiologi
                </h4>
                <div class="dokterumum">
                    <div class="dokterumum-body">
                        <p class="card-text">
                            Senin - Sabtu
                        </p>
                        <p class="card-text">
                            07.00 - 20.00
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>

<script>
    function toggleJadwal() {
        var jadwalDiv = document.getElementById('jadwalDiv');
        if (jadwalDiv.style.display === 'none') {
            jadwalDiv.style.display = 'block';
        } else {
            jadwalDiv.style.display = 'none';
        }
    }
</script>
@endsection