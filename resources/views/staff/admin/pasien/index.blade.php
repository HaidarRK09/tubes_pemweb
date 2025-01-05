@extends('dashboard')

@section('title', 'Klinik Cikijing | Pasien')
@section('page-title', 'Pasien')
@section('page-subtitle', 'Akun')
@section('breadcrumb', 'Pasien Dashboard')

@section('content')
    <!-- Konten khusus untuk halaman staff -->
    <div class="box">
        <div class="box-body">
            <div class="col-lg-20 grid-margin stretch-card d-flex justify-content-end">
                <div class="text-right">
                    <!-- Button to trigger the modal for adding new staff -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addPasienModal">
                        Tambah Pasien
                    </button>
                </div>
            </div>
            
            <!-- Isi konten pasien di sini -->
            <div class="col-lg-20 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body" style="overflow-y: auto;">
                        <div class="col-md-6">
                            <div class="form-group">
                                <form method="get" action={{route('search-pasien')}}>
                                    <div class="input-group">
                                        <input class="form-control" name="search" placeholder="Search..." value="{{ isset($search) ? $search : ''}}">
                                        <button type="submit" class="btn btn-sm btn-primary">Search</button>
                                    </div>
                                </form>
                            </div>
                        </div>       
                        <h4 class="card-title">
                            Tabel Pasien
                        </h4>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">NIK</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Nomor BPJS</th>
                                    <th scope="col">Nomor Telepon</th>
                                    <th scope="col">E-Mail</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pasien as $index => $data)
                                    <tr>
                                        <td>{{ $data->NIK }}</td>
                                        <td>{{ $data->nama }}</td>
                                        <td>{{ $data->nobpjs }}</td>
                                        <td>{{ $data->notlp }}</td>
                                        <td>{{ $data->email }}</td>
                                        <td>{{ $data->alamat }}</td>
                                        <td>
                                            <a href="{{ route('pasien.history', ['NIK' => $data->NIK]) }}" class="btn btn-info btn-sm">
                                                <i class="fas fa-eye"></i> <!-- Gunakan ikon mata di sini -->
                                            </a>
                                            <!-- Button to trigger the modal for updating staff -->
                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editPasienModal{{ $data->NIK }}">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            
                                            
                                            <!-- Button to trigger the modal for deleting staff -->
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deletePasienModal{{ $data->NIK }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    
                                    <!-- Modal for updating staff -->
                                    <div class="modal fade" id="editPasienModal{{ $data->NIK }}" tabindex="-1" role="dialog" aria-labelledby="editPasienModalLabel{{ $data->NIK }}" aria-hidden="true">
                                        <!-- Include the modal content for updating staff -->
                                        @include('staff.admin.pasien.edit_modal', ['data' => $data])
                                    </div>

                                    <!-- Modal for deleting staff -->
                                    <div class="modal fade" id="deletePasienModal{{ $data->NIK }}" tabindex="-1" role="dialog" aria-labelledby="deletePasienModalLabel{{ $data->NIK }}" aria-hidden="true">
                                        <!-- Include the modal content for deleting staff -->
                                        @include('staff.admin.pasien.delete_modal', ['data' => $data])
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{ $pasien->links() }}
        </div>
    </div>

    <!-- Modal for adding new staff -->
    <div class="modal fade" id="addPasienModal" tabindex="-1" role="dialog" aria-labelledby="addPasienModalLabel" aria-hidden="true">
        <!-- Include the modal content for adding new staff -->
        @include('staff.admin.pasien.create_modal')
    </div>
@endsection


