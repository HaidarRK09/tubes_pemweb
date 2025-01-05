<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="editPasienModalLabel{{ $data->NIK }}">Edit Pasien</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <!-- Form for updating staff -->
            <form action="{{ route('pasien.update', $data->NIK) }}" method="POST">
                @csrf
                @method('PUT')
                <!-- Include the form fields for updating staff -->
                <div class="form-group">
                    <label for="NIK">NIK:</label>
                    <input type="text" class="form-control" id="NIK" name="NIK" value="{{ old('NIK', $data->NIK ?? '') }}" readonly>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" name="password"  required>
                </div>
                <!-- Add other form fields as needed (password, nama, notlp, email, alamat) -->
                <div class="form-group">
                    <label for="nama">Nama:</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama', $data->nama ?? '') }}" required>
                </div>
                <div class="form-group">
                    <label for="npbpjs">Nomor BPJS:</label>
                    <input type="text" class="form-control" id="nobpjs" name="nobpjs" value="{{ old('nobpjs', $data->nobpjs ?? '') }}"  required>
                </div>
                <!-- Add other form fields as needed -->
                <div class="form-group">
                    <label for="notlp">Nomor Telepon:</label>
                    <input type="text" class="form-control" id="notlp" name="notlp" value="{{ old('notlp', $data->notlp ?? '') }}"  required>
                </div>
                <div class="form-group">
                    <label for="email">E-Mail:</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $data->email ?? '') }}" required>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat:</label>
                    <input type="alamat" class="form-control" id="alamat" name="alamat" value="{{ old('alamat', $data->alamat ?? '') }}" required>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
