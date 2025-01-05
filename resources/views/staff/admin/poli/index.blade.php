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
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addPoliModal">
                        Tambah Poliklinik
                    </button>
                </div>
            </div>
            
            <!-- Isi konten obat di sini -->
            <div class="col-lg-20 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body" style="overflow-y: auto;">
                        <h4 class="card-title">
                            Tabel Poliklinik
                        </h4>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">ID Poliklinik</th>
                                    <th scope="col">Nama Poliklinik</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($poli as $index => $poli)
                                    <tr>
                                        <td>{{ $poli->id_poli }}</td>
                                        <td>{{ $poli->nama }}</td>
                                        <td>
                                            <!-- Button to trigger the modal for updating staff -->
                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editPoliModal{{ $poli->id_poli }}">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            
                                            
                                            <!-- Button to trigger the modal for deleting staff -->
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deletePoliModal{{ $poli->id_poli }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    
                                    <!-- Modal for updating staff -->
                                    <div class="modal fade" id="editPoliModal{{ $poli->id_poli }}" tabindex="-1" role="dialog" aria-labelledby="editPoliModalLabel{{ $poli->id_poli }}" aria-hidden="true">
                                        <!-- Include the modal content for updating staff -->
                                        @include('staff.admin.poli.edit_modal', ['data' => $poli])
                                    </div>

                                    <!-- Modal for deleting staff -->
                                    <div class="modal fade" id="deletePoliModal{{ $poli->id_poli }}" tabindex="-1" role="dialog" aria-labelledby="deletePoliModalLabel{{ $poli->id_poli }}" aria-hidden="true">
                                        <!-- Include the modal content for deleting staff -->
                                        @include('staff.admin.poli.delete_modal', ['data' => $poli])
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
    <div class="modal fade" id="addPoliModal" tabindex="-1" role="dialog" aria-labelledby="addPoliModalLabel" aria-hidden="true">
        <!-- Include the modal content for adding new staff -->
        @include('staff.admin.poli.create_modal')
    </div>
@endsection


