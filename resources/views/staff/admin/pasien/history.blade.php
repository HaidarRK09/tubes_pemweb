@extends('dashboard')

@section('title', 'Klinik Cikijing | Pasien')
@section('page-title', 'Pasien')
@section('page-subtitle', 'Akun')
@section('breadcrumb', 'Pasien Dashboard')

@section('content')

            <div class="row">
                <div class="col-lg-20 grid-margin stretch-card d-flex justify-content-end">
                    <div class="text-right">
                        @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                        @endif
                        <!-- Button to trigger the modal for adding new staff -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addReservasiModal">
                             Tambahkan Reservasi
                        </button>
                    </div>
                </div>
                <div class="col-lg-12 grid-margin stretch-card" id="table-container">
                    <div class="card" id="reservasi-table">
                        <div class="card-body" style="overflow-y: auto;">
                            <h4 class="card-title">
                                Tabel History
                            </h4>
                            <p class="card-description">
                                "Tabel history pasien yang melakukan reservasi"
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
                                        <th scope="col">Hasil Pemeriksaan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ( $pasien as $data )
                                    <tr>
                                        <td>{{ $data->id_daftar }}</td>
                                        <td>{{ $data->tgl }}</td>
                                        <td>{{ $data->id_booking }}</td>
                                        <td>{{ $data->pasien->nama }}</td>
                                        <td>{{ $data->sesi->poli->nama }}</td>
                                        <td>{{ $data->antrian }}</td>
                                        <td>{{ $data->status }}</td>
                                        <td>
                                            <a href="{{ route('pasien.history.detail', ['id' => $data->id_daftar]) }}" class="btn btn-info btn-sm">
                                                <i class="fas fa-eye"></i> <!-- Gunakan ikon mata di sini -->
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
@endsection
