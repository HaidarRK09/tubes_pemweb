@extends('dashboard')

@section('title', 'Klinik Cikijing | Pasien')
@section('page-title', 'Pasien')
@section('page-subtitle', 'Akun')
@section('breadcrumb', 'Pasien Dashboard')

@section('content')
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card" id="table-container">
                    <div class="card" id="booking-table">
                        <div class="card-body" style="overflow-y: auto;">
                            <h4 class="card-title">
                                Tabel Booking
                            </h4>
                            <p class="card-description">
                                "Tabel pasien yang melakukan booking"
                            </p>
                            <div class="col-lg-20 grid-margin stretch-card d-flex justify-content-end">
                                <div class="text-right">
                                    <!-- Button to trigger the modal for adding new staff -->
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addBookingModal">
                                         Booking Jadwal
                                    </button>
                                </div>
                            </div>
                            @if(session('error'))
                                    <div class="alert alert-danger">
                                         {{ session('error') }}
                                    </div>
                            @endif
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">ID Booking</th>
                                        <th scope="col">Tanggal Booking</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Poli</th>
                                        <th scope="col">Hari</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($booking as $data)
                                        <tr>
                                            <td>{{ $data->id_booking }}</td>
                                            <td>{{ $data->tgl }}</td>
                                            <td>{{ $data->pasien->nama }}</td>
                                            <td>{{ $data->sesi->poli->nama }}</td>
                                            <td>{{ $data->sesi->hari }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="addBookingModal" tabindex="-1" role="dialog" aria-labelledby="addBookingModalLabel" aria-hidden="true">
                <!-- Include the modal content for adding new staff -->
                @include('staff.admin.booking.create_modal')
            </div>
@endsection
