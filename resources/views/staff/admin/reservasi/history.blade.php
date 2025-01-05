@extends('dashboard')

@section('title', 'Klinik Cikijing | Reservasi')
@section('page-title', 'Pasien Reservasi')
@section('page-subtitle', 'Reservasi')
@section('breadcrumb', 'Index Reservasi')

@section('content')
    <div class="row">
        <div class="col-lg-20 grid-margin stretch-card d-flex">
            <div class="text-right">
                <button type="button" class="btn btn-primary" onclick="goBack()">
                    Kembali
                </button>
            </div>
        </div>
        
    </div>
    <div class="col-lg-12 grid-margin stretch-card" id="table-container">
        <div class="card" id="reservasi-table">
            <div class="card-body" style="overflow-y: auto;">
                <h4 class="card-title">
                    Tabel Reservasi Selesai
                </h4>
                <p class="card-description">
                    "Tabel pasien yang selesai berobat"
                </p>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">ID Daftar</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">ID Booking</th>
                            <th scope="col">Nama Pasien</th>
                            <th scope="col">Nama Poli</th>
                            <th scope="col">Nomor Antrian</th>
                            <th scope="col">Status Pendaftaran</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($daftar as $data)
                            @if($data->status == 'Selesai')
                            <tr>
                                <td>{{ $data->id_daftar }}</td>
                                <td>{{ $data->tgl }}</td>
                                <td>{{ $data->id_booking }}</td>
                                <td>{{ $data->pasien->nama }}</td>
                                <td>{{ $data->sesi->poli->nama }}</td>
                                <td>{{ $data->antrian }}</td>
                                <td>{{ $data->status }}</td>
                         </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
    
@endsection