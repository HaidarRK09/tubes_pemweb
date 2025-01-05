@extends('dashboard')

@section('title', 'Klinik Cikijing | Dokter')
@section('page-title', 'Dokter')
@section('page-subtitle', 'Index')
@section('breadcrumb', 'Dokter Dashboard')

@section('content')

            <div class="row">
                <div class="col-lg-20 grid-margin stretch-card d-flex justify-content-end">
                    <div class="text-right">
                        @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                        @endif
                    </div>
                </div>
                <div class="col-lg-12 grid-margin stretch-card" id="table-container">
                    <div class="card" id="reservasi-table">
                        <div class="card-body" style="overflow-y: auto;">
                            <h4 class="card-title">
                                Tabel Pasien
                            </h4>
                            <p class="card-description">
                                "Tabel pasien yang berobat"
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
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($daftar as $data)
                                    @if($data->status == 'Diperiksa')
                                        @php
                                            $userRole = Auth::user()->role; // Ambil role user
                                            $poliNama = $data->sesi->poli->nama; // Ambil nama poli dari data daftar
                                        @endphp

                                        @if($poliNama == 'Dokter Gigi' || $poliNama == 'Dokter Umum' )
                                        <tr>
                                            <td>{{ $data->id_daftar }}</td>
                                            <td>{{ $data->tgl }}</td>
                                            <td>{{ $data->id_booking }}</td>
                                            <td>{{ $data->pasien->nama }}</td>
                                            <td>{{ $data->sesi->poli->nama }}</td>
                                            <td>{{ $data->antrian }}</td>
                                            <td>{{ $data->status }}</td>
                                            <td>
                                                <a href="{{ route('dokter.periksa', ['id_daftar' => $data->id_daftar]) }}" class="btn btn-primary btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                    Periksa
                                                </a>
                                            </td>
                                     </tr>
                                    @endif
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
@endsection
