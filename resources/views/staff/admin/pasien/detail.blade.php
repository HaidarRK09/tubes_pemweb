@extends('dashboard')

@section('title', 'Klinik Cikijing | Pasien')
@section('page-title', 'Pasien')
@section('page-subtitle', 'Akun')
@section('breadcrumb', 'Pasien Dashboard')

@section('content')
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">History Pasien</h4>
                    <p class="card-description"> Riwayat pasien berobat</p>
                    <form class="forms-sample">
                        @foreach ( $daftar as $data)
                        <div class="form-group">
                            <label for="NIK">NIK Pasien</label>
                            <input type="text" class="form-control" value="{{$data->NIK}}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="NIK">Nama Pasien</label>
                            <input type="text" class="form-control" value="{{$data->pasien->nama}}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="NIK">Tanggal Berobat</label>
                            <input type="date" class="form-control" value="{{$data->tgl}}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="NIK">Poliklinik yang dikunjungi</label>
                            <input type="text" class="form-control" value="{{$data->sesi->poli->nama}}" readonly>
                        </div>
                        <h4 class="card-title">Hasil Pemeriksaan</h4>
                        <div class="form-group">
                            <label for="NIK">Anamnesa</label>
                            <textarea name="anamnesa" id="anamnesa" cols="30" rows="10" readonly>
                                {{ $data->pasien->rekam_medis->anamnesa }}
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label for="NIK">Tekanan Darah</label>
                            <input type="text" class="form-control" value="{{$data->pasien->rekam_medis->sistolik}} / {{$data->pasien->rekam_medis->diastolik}} "  readonly>
                        </div>
                        <div class="form-group">
                            <label for="NIK">Diagnosa Penyakit</label>
                            <input type="text" class="form-control" value="{{$data->pasien->rekam_medis->penyakit}}"  readonly>
                        </div>
                        <div class="form-group">
                            <label for="NIK">Status Kepulangan</label>
                            <input type="text" class="form-control" value="{{$data->pasien->rekam_medis->status}}"  readonly>
                        </div>
                        <div class="form-group">
                            <label for="NIK">Tempat Rujuk</label>
                            <input type="text" class="form-control" value="{{$data->pasien->rekam_medis->tempat_rujuk ?: 'Pasien Pulang'}}"  readonly>
                        </div>
                        <h4 class="card-title">Pemberian Obat</h4>
                        <div class="form-group">
                            <label for="NIK">Daftar Obat</label>
                        @foreach ($resepobat as $item)
                            <input type="text" class="form-control" value="{{$item->obat->nama}} sebanyak {{$item->qty}}" readonly>
                        @endforeach
                        </div>
                        @endforeach
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection