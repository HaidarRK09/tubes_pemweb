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
                                            $poliNama = $data->sesi->poli->nama; // Ambil nama poli dari data daftar
                                        @endphp

                                        @if($poliNama == 'Radiologi')
                                        <tr>
                                            <td>{{ $data->id_daftar }}</td>
                                            <td>{{ $data->tgl }}</td>
                                            <td>{{ $data->id_booking }}</td>
                                            <td>{{ $data->pasien->nama }}</td>
                                            <td>{{ $data->sesi->poli->nama }}</td>
                                            <td>{{ $data->antrian }}</td>
                                            <td>{{ $data->status }}</td>
                                            <td>
                                                <form id="form-periksa-selesai-{{ $data->id_daftar }}" action="{{ route('radiologi.periksa', ['id' => $data->id_daftar]) }}" method="post">
                                                    @csrf
                                                    <button type="submit" class="btn btn-primary btn-sm" onclick="return confirm('Apakah pasien selesai diperiksa?')">Selesai</button>
                                                </form>
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
