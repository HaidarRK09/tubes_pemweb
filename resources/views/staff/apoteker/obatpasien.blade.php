@extends('dashboard')

@section('title', 'Klinik Cikijing | Obat Pasien')
@section('page-title', 'Obat')
@section('page-subtitle', 'Obat')
@section('breadcrumb', 'Obat Dashboard')

@section('content')
            <div class="row">
                <div class="col-lg-20 grid-margin stretch-card d-flex justify-content-end">
                    <div class="text-right">
                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
        
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-lg-12 grid-margin stretch-card" id="table-container">
                    <div class="card" id="reservasi-table">
                        <div class="card-body" style="overflow-y: auto;">
                            <h4 class="card-title">
                                Tabel Pemberian Obat
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
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($daftar as $data)
                                    @if($data->status == 'Obat')
                                        <tr>
                                            <td>{{ $data->id_daftar }}</td>
                                            <td>{{ $data->tgl }}</td>
                                            <td>{{ $data->id_booking }}</td>
                                            <td>{{ $data->pasien->nama }}</td>
                                            <td>{{ $data->sesi->poli->nama }}</td>
                                            <td>{{ $data->antrian }}</td>
                                            <td>
                                                <form action="{{ route('update.status', ['id' => $data->id_daftar]) }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="_method" value="PUT">
                                                    <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Apakah Anda yakin ingin mengkonfirmasi status menjadi Selesai?')">Konfirmasi</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
@endsection
