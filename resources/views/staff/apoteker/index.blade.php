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
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addObatModal">
                        Tambah Obat
                    </button>
                </div>
            </div>
            
            <!-- Isi konten obat di sini -->
            <div class="col-lg-20 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">
                            Tabel Obat
                        </h4>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">ID obat</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Merk</th>
                                    <th scope="col">Deskripsi</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Jumlah</th>
                                    <th scope="col">Tipe</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($obat as $index => $data)
                                    <tr>
                                        <td>{{ $data->id_obat }}</td>
                                        <td>{{ $data->nama }}</td>
                                        <td>{{ $data->merk }}</td>
                                        <td>{{ $data->deskripsi }}</td>
                                        <td>{{ $data->harga }}</td>
                                        <td>{{ $data->qty }}</td>
                                        <td>{{ $data->uom }}</td>
                                        <td>
                                            <!-- Button to trigger the modal for updating staff -->
                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editObatModal{{ $data->id_obat }}">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            
                                            
                                            <!-- Button to trigger the modal for deleting staff -->
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteObatModal{{ $data->id_obat }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    
                                    <!-- Modal for updating staff -->
                                    <div class="modal fade" id="editObatModal{{ $data->id_obat }}" tabindex="-1" role="dialog" aria-labelledby="editObatModalLabel{{ $data->id_obat }}" aria-hidden="true">
                                        <!-- Include the modal content for updating staff -->
                                        @include('staff.apoteker.edit_modal', ['data' => $data])
                                    </div>

                                    <!-- Modal for deleting staff -->
                                    <div class="modal fade" id="deleteObatModal{{ $data->id_obat }}" tabindex="-1" role="dialog" aria-labelledby="deleteObatModalLabel{{ $data->id_obat }}" aria-hidden="true">
                                        <!-- Include the modal content for deleting staff -->
                                        @include('staff.apoteker.delete_modal', ['data' => $data])
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
    <div class="modal fade" id="addObatModal" tabindex="-1" role="dialog" aria-labelledby="addObatModalLabel" aria-hidden="true">
        <!-- Include the modal content for adding new staff -->
        @include('staff.apoteker.create_modal')
    </div>
@endsection


