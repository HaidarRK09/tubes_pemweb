<!-- staff.superAdmin.edit_modal.blade.php -->

<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="editReservasiModalLabel{{ $data->id_reservasi }}">Konfirmasi Kedatangan Pasien</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <!-- Form for updating staff -->
            <form action="{{ route('reservasi.update', $data->id_daftar) }}" method="POST">
                @csrf
                @method('PUT')
                <!-- Include the form fields for updating staff -->
                <div class="form-group">
                    <label for="status_pendaftaran">Apakah Pasien Datang ?</label>
                    <select class="form-control" id="status" name="status" required>
                        <option value="Berjalan" @if(old('status_pendaftaran', $data->status ?? '') == 'Berjalan') selected @endif>Datang</option>
                        <option value="Batal" @if(old('status_pendaftaran', $data->status ?? '') == 'Batal') selected @endif>Tidak Datang</option>
                    </select>
                </div>
                
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
