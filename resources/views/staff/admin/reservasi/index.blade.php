@extends('dashboard')

@section('title', 'Klinik Cikijing | Reservasi')
@section('page-title', 'Pasien Reservasi')
@section('page-subtitle', 'Reservasi')
@section('breadcrumb', 'Index Reservasi')

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
                                Tabel Reservasi Booking
                            </h4>
                            <p class="card-description">
                                "Tabel pasien yang melakukan booking di hari ini"
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
                                    @if($data->status == 'Booking')
                                        <tr>
                                            <td>{{ $data->id_daftar }}</td>
                                            <td>{{ $data->tgl }}</td>
                                            <td>{{ $data->id_booking }}</td>
                                            <td>{{ $data->pasien->nama }}</td>
                                            <td>{{ $data->sesi->poli->nama }}</td>
                                            <td>{{ $data->antrian }}</td>
                                            <td>{{ $data->status }}</td>
                                            <td>
                                                <!-- Button to trigger the modal for updating staff -->
                                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editReservasiModal{{ $data->id_daftar }}">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                
                                                
                                                <!-- Button to trigger the modal for deleting staff -->
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteReservasiModal{{ $data->id_daftar }}">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                     </tr>
                                     <!-- Modal for updating staff -->
                                    <div class="modal fade" id="editReservasiModal{{ $data->id_daftar }}" tabindex="-1" role="dialog" aria-labelledby="editReservasiModalLabel{{$data->id_daftar }}" aria-hidden="true">
                                        <!-- Include the modal content for updating staff -->
                                        @include('staff.admin.reservasi.edit_modal', ['data' => $data])
                                    </div>
                                    
                                    <!-- Modal for deleting staff -->
                                    <div class="modal fade" id="deleteReservasiModal{{ $data->id_daftar }}" tabindex="-1" role="dialog" aria-labelledby="deleteReservasiModalLabel{{ $data->id_daftar }}" aria-hidden="true">
                                        <!-- Include the modal content for deleting staff -->
                                        @include('staff.admin.reservasi.delete_modal', ['data' => $data])
                                    </div>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 grid-margin stretch-card" id="table-container">
                    <div class="card" id="reservasi-table">
                        <div class="card-body" style="overflow-y: auto;">
                            <h4 class="card-title">
                                Tabel Reservasi Berjalan
                            </h4>
                            <p class="card-description">
                                "Tabel pasien yang sedang berobat"
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
                                        @if($data->status == 'Berjalan')
                                        <tr>
                                            <td>{{ $data->id_daftar }}</td>
                                            <td>{{ $data->tgl }}</td>
                                            <td>{{ $data->id_booking }}</td>
                                            <td>{{ $data->pasien->nama }}</td>
                                            <td>{{ $data->sesi->poli->nama }}</td>
                                            <td>{{ $data->antrian }}</td>
                                            <td>{{ $data->status }}</td>
                                            <td>
                                                <form action="{{ route('reservasi.periksa', ['id_daftar' => $data->id_daftar]) }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="_method" value="PUT">
                                                    <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Apakah sudah saatnya pasien diperiksa ?')">Konfirmasi</button>
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
                <div class="col-lg-12 grid-margin stretch-card" id="table-container">
                    <div class="card" id="reservasi-table">
                        <div class="card-body" style="overflow-y: auto;">
                            <h4 class="card-title">
                                Tabel Reservasi Diperiksa
                            </h4>
                            <p class="card-description">
                                "Tabel pasien yang sedang diperiksa"
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
                                        @if($data->status == 'Diperiksa')
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
                <div class="col-lg-12 grid-margin stretch-card" id="table-container">
                    <div class="card" id="reservasi-table">
                        <div class="card-body" style="overflow-y: auto;">
                            <h4 class="card-title">
                                Tabel Reservasi Obatw
                            </h4>
                            <p class="card-description">
                                "Tabel pasien yang sedang menunggu obat"
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
                                        @if($data->status == 'Obat')
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
                <div class="col-lg-20 grid-margin stretch-card d-flex justify-content-end">
                    <div class="text-left">
                        <a href="{{ route('reservasi.history') }}" class="btn btn-primary">
                            Histori Reservasi
                        </a>
                    </div>
                </div>
                
            </div>
<!-- Modal for adding new staff -->
<div class="modal fade" id="addReservasiModal" tabindex="-1" role="dialog" aria-labelledby="addReservasiModalLabel" aria-hidden="true">
    <!-- Include the modal content for adding new staff -->
    @include('staff.admin.reservasi.create_modal')
</div>
@endsection
