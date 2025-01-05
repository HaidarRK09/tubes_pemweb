<!-- staff.superAdmin.edit_modal.blade.php -->

<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="editObatModalLabel{{ $data->id_obat }}">Edit Obat</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <!-- Form for updating staff -->
            <form action="{{ route('obat.update', $data->id_obat) }}" method="POST">
                @csrf
                @method('PUT')
                <!-- Include the form fields for updating staff -->
                <div class="form-group">
                    <label for="nama">Nama:</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama', $data->nama ?? '') }}" required>
                </div>
                <div class="form-group">
                    <label for="merk">Merk:</label>
                    <input type="text" class="form-control" id="merk" name="merk" value="{{ old('merk', $data->merk ?? '') }}" required>
                </div>
                <div class="form-group">
                    <label for="deskripsi">Deskripsi:</label>
                    <input type="text" class="form-control" id="deskripsi" name="deskripsi" value="{{ old('deskripsi', $data->deskripsi ?? '') }}"  required>
                </div>
                <div class="form-group">
                    <label for="harga">Harga:</label>
                    <input type="number" class="form-control" id="harga" name="harga" value="{{ old('harga', $data->harga ?? '') }}" 
                           oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                           required>
                </div>
                <div class="form-group">
                    <label for="qty">Qty:</label>
                    <input type="number" class="form-control" id="qty" name="qty" value="{{ old('qty', $data->qty ?? '') }}" 
                           oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                           required>
                </div>                
                <div class="form-group">
                    <label for="uom">unit of measure:</label>
                    <select class="form-control" id="uom" name="uom" required>
                        <option value="botol" {{ (old('uom', $data->uom ?? '') == 'botol') ? 'selected' : '' }}>Botol</option>
                        <option value="strip" {{ (old('uom', $data->uom ?? '') == 'strip') ? 'selected' : '' }}>Strip</option>
                        <option value="pieces" {{ (old('uom', $data->uom ?? '') == 'pieces') ? 'selected' : '' }}>Pieces</option>
                        <option value="box" {{ (old('uom', $data->uom ?? '') == 'box') ? 'selected' : '' }}>Box</option>
                        <option value="tablet" {{ (old('uom', $data->uom ?? '') == 'tablet') ? 'selected' : '' }}>Tablet</option>
                    </select>
                </div>
                
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
