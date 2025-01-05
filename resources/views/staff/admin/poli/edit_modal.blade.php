<!-- staff.superAdmin.edit_modal.blade.php -->

<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="editPoliModalLabel{{ $data->id_poli }}">Edit Poliklinik</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <!-- Form for updating staff -->
            <form action="{{ route('poli.update', $data->id_poli) }}" method="POST">
                @csrf
                @method('PUT')
                <!-- Include the form fields for updating staff -->
                <div class="form-group">
                    <label for="nama">Nama Poliklinik</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama', $data->nama ?? '') }}" required>
                </div>
                
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
