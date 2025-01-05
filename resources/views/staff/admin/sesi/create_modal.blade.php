<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="addSesiModalLabel">Tambah Sesi</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <!-- Form for adding new staff -->
            <form action="{{ route('sesi.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="id_sesi">ID Sesi:</label>
                    <input type="text" class="form-control" id="id_sesi" name="id_sesi"  readonly>
                </div>
                <div class="form-group">
                    <select class="form-control" id="hari" name="hari" required>
                        <option value="Senin" {{ (old('hari', $data->hari ?? '') == 'Senin') ? 'selected' : '' }}>Senin</option>
                        <option value="Selasa" {{ (old('hari', $data->hari ?? '') == 'Selasa') ? 'selected' : '' }}>Selasa</option>
                        <option value="Rabu" {{ (old('hari', $data->hari ?? '') == 'Rabu') ? 'selected' : '' }}>Rabu</option>
                        <option value="Kamis" {{ (old('hari', $data->hari ?? '') == 'Kamis') ? 'selected' : '' }}>Kamis</option>
                        <option value="Jumat" {{ (old('hari', $data->hari ?? '') == 'Jumat') ? 'selected' : '' }}>Jumat</option>
                        <option value="Sabtu" {{ (old('hari', $data->hari ?? '') == 'Sabtu') ? 'selected' : '' }}>Sabtu</option>
                        <option value="Minggu" {{ (old('hari', $data->hari ?? '') == 'Minggu') ? 'selected' : '' }}>Minggu</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="jam_mulai">Jam Mulai:</label>
                    <input type="time" class="form-control" id="jam_mulai" name="jam_mulai" step="600" required>
                </div>
                <div class="form-group">
                    <label for="jam_selesai">Jam Selesai:</label>
                    <input type="time" class="form-control" id="jam_selesai" name="jam_selesai" step="600" required>
                </div>
                <div class="form-group">
                    <label for="status">Status:</label>
                    <select class="form-control" id="status" name="status" required>
                        <option value="Aktif" {{ (old('status', $data->status ?? '') == 'Aktif') ? 'selected' : '' }}>Aktif</option>
                        <option value="Non Aktif" {{ (old('role', $data->status ?? '') == 'Non Aktif') ? 'selected' : '' }}>Non Aktif</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="id_poli">ID Poli:</label>
                    <select class="form-control" id="id_poli" name="id_poli" required>
                        @foreach($poli as $polis)
                            <option value="{{ $polis->id_poli }}">{{ $polis->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="nip">Dokter:</label>
                    <select class="form-control" id="nip" name="nip" required>
                        @foreach($dokter as $dokters)
                            <option value="{{ $dokters->nip }}">{{ $dokters->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </form>
        </div>
    </div>
</div>
