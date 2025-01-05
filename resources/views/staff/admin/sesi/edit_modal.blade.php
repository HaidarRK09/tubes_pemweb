<!-- staff.superAdmin.edit_modal.blade.php -->

<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="editObatModalLabel{{ $data->id_obat }}">Edit Sesi</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <!-- Form for updating staff -->
            <form action="{{ route('sesi.update', $data->id_sesi) }}" method="POST">
            @csrf
            @method('PUT')
            <!-- Include the form fields for updating sesi -->
            <div class="form-group">
                <label for="id_sesi">ID Sesi:</label>
                <input type="text" class="form-control" id="id_sesi" name="id_sesi" value="{{ old('id_sesi', $data->id_sesi ?? '') }}" readonly>
            </div>
            <!-- Add other form fields as needed -->
            <div class="form-group">
                <label for="hari">Hari:</label>
                <input type="text" class="form-control" id="hari" name="hari" value="{{ old('hari', $data->hari ?? '') }}" required>
            </div>
            <div class="form-group">
                <label for="jam_mulai">Jam Mulai:</label>
                <input type="time" class="form-control" id="jam_mulai" name="jam_mulai" value="{{ old('jam_mulai', $data->jam_mulai ?? '') }}" step="600" required>
            </div>
            <div class="form-group">
                <label for="jam_selesai">Jam Selesai:</label>
                <input type="time" class="form-control" id="jam_selesai" name="jam_selesai" value="{{ old('jam_selesai', $data->jam_selesai ?? '') }}" step="600" required>
            </div>
            <div class="form-group">
                <label for="status">Status:</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="Aktif" {{ (old('status', $data->status ?? '') == 'Aktif') ? 'selected' : '' }}>Aktif</option>
                    <option value="Non Aktif" {{ (old('status', $data->status ?? '') == 'Non Aktif') ? 'selected' : '' }}>Non Aktif</option>
                </select>
            </div>
            <div class="form-group">
                <label for="id_poli">ID Poli:</label>
                <select class="form-control" id="id_poli" name="id_poli" required>
                    @foreach($poli as $polis)
                        <option value="{{ $polis->id_poli }}" {{ (old('id_poli', $data->id_poli ?? '') == $polis->id_poli) ? 'selected' : '' }}>
                            {{ $polis->nama }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div class="form-group">
                <label for="nip">Dokter:</label>
                <select class="form-control" id="nip" name="nip" required>
                    @foreach($dokter as $dokters)
                        <option value="{{ $dokters->nip }}" {{ (old('nip', $data->nip ?? '') == $dokters->nip) ? 'selected' : '' }}>
                            {{ $dokters->nama }}
                        </option>
                    @endforeach
                </select>
            </div>
                
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
