@extends('dashboard')

@section('title', 'Klinik Cikijing | Apoteker')
@section('page-title', 'Apoteker')
@section('page-subtitle', 'Akun')
@section('breadcrumb', 'Apoteker Dashboard')

@section('content')
    <!-- Konten khusus untuk halaman staff -->
    <div class="box">
        <div class="box-body">
            <div class="col-lg-20 grid-margin stretch-card d-flex justify-content-end">
                <div class="text-right">
                    <!-- Button to trigger the modal for adding new staff -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addSesiModal">
                        Tambah Sesi
                    </button>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

            </div>
            
            <!-- Isi konten sesi di sini -->
            <div class="col-lg-20 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body" style="overflow-y: auto;">
                        <h4 class="card-title">
                            Tabel Sesi
                        </h4>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">ID Sesi</th>
                                    <th scope="col">Hari</th>
                                    <th scope="col">Jam Mulai</th>
                                    <th scope="col">Jam Selesai</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Nama Poli</th>
                                    <th scope="col">Nama Dokter</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sesi as $data)
                                    <tr>
                                        <td>{{ $data->id_sesi }}</td>
                                        <td>{{ $data->hari }}</td>
                                        <td>{{ $data->jam_mulai }}</td>
                                        <td>{{ $data->jam_selesai }}</td>
                                        <td>{{ $data->status }}</td>
                                        <td>{{ $data->poli->nama }}</td>
                                        <td>{{ $data->staff->nama }}</td>
                                        <td>
                                            <!-- Button to trigger the modal for updating staff -->
                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editSesiModal{{ $data->id_sesi }}">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            
                                            
                                            <!-- Button to trigger the modal for deleting staff -->
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteSesiModal{{ $data->id_sesi }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    
                                    <!-- Modal for updating staff -->
                                    <div class="modal fade" id="editSesiModal{{ $data->id_sesi }}" tabindex="-1" role="dialog" aria-labelledby="editSesiModalLabel{{ $data->id_sesi }}" aria-hidden="true">
                                        <!-- Include the modal content for updating staff -->
                                        @include('staff.admin.sesi.edit_modal', ['data' => $data])
                                    </div>

                                    <!-- Modal for deleting staff -->
                                    <div class="modal fade" id="deleteSesiModal{{ $data->id_sesi }}" tabindex="-1" role="dialog" aria-labelledby="deleteSesiModalLabel{{ $data->id_sesi }}" aria-hidden="true">
                                        <!-- Include the modal content for deleting staff -->
                                        @include('staff.admin.sesi.delete_modal', ['data' => $data])
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{ $sesi->links()}}
        </div>
    </div>

    <!-- Modal for adding new staff -->
    <div class="modal fade" id="addSesiModal" tabindex="-1" role="dialog" aria-labelledby="addSesiModalLabel" aria-hidden="true">
        <!-- Include the modal content for adding new staff -->
        @include('staff.admin.sesi.create_modal')
    </div>
@endsection


