@extends('dashboard')

@section('title', 'Klinik Cikijing | Super Admin')
@section('page-title', 'Super Admin')
@section('page-subtitle', 'Akun')
@section('breadcrumb', 'Super Admin Dashboard')

@section('content')
    <!-- Konten khusus untuk halaman staff -->
    <div class="box">
        <div class="box-body">
            <div class="col-lg-20 grid-margin stretch-card d-flex justify-content-end">
                <div class="text-right">
                    <!-- Button to trigger the modal for adding new staff -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addStaffModal">
                        Tambah Admin
                    </button>
                </div>
            </div>
            
            <!-- Isi konten staff di sini -->
            <div class="col-lg-20 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body" style="overflow-y: auto;">
                        <h4 class="card-title">
                            Tabel Admin
                        </h4>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">NIP</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Nomor Telepon</th>
                                    <th scope="col">E-Mail</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($staff as $index => $data)
                                    <tr>
                                        <td>{{ $data->nip }}</td>
                                        <td>{{ $data->username }}</td>
                                        <td>{{ $data->nama }}</td>
                                        <td>{{ $data->notlp }}</td>
                                        <td>{{ $data->email }}</td>
                                        <td>{{ $data->alamat }}</td>
                                        <td>{{ $data->role }}</td>
                                        <td>
                                            <!-- Button to trigger the modal for updating staff -->
                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editStaffModal{{ $data->nip }}">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            
                                            
                                            <!-- Button to trigger the modal for deleting staff -->
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteStaffModal{{ $data->nip }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    
                                    <!-- Modal for updating staff -->
                                    <div class="modal fade" id="editStaffModal{{ $data->nip }}" tabindex="-1" role="dialog" aria-labelledby="editStaffModalLabel{{ $data->nip }}" aria-hidden="true">
                                        <!-- Include the modal content for updating staff -->
                                        @include('staff.superAdmin.edit_modal', ['data' => $data])
                                    </div>

                                    <!-- Modal for deleting staff -->
                                    <div class="modal fade" id="deleteStaffModal{{ $data->nip }}" tabindex="-1" role="dialog" aria-labelledby="deleteStaffModalLabel{{ $data->nip }}" aria-hidden="true">
                                        <!-- Include the modal content for deleting staff -->
                                        @include('staff.superAdmin.delete_modal', ['data' => $data])
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for adding new staff -->
    <div class="modal fade" id="addStaffModal" tabindex="-1" role="dialog" aria-labelledby="addStaffModalLabel" aria-hidden="true">
        <!-- Include the modal content for adding new staff -->
        @include('staff.superAdmin.create_modal')
    </div>
@endsection


