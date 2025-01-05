<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="addPasienModalLabel">Tambah Pasien</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <!-- Form for adding new staff -->
            <form action="{{ route('pasien.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="NIK">NIK:</label>
                    <input type="text" class="form-control" id="NIK" name="NIK"  required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" name="password"  required>
                </div>
                <!-- Add other form fields as needed (password, nama, notlp, email, alamat) -->
                <div class="form-group">
                    <label for="nama">Nama:</label>
                    <input type="text" class="form-control" id="nama" name="nama" required>
                </div>
                <div class="form-group">
                    <label for="npbpjs">Nomor BPJS:</label>
                    <input type="text" class="form-control" id="nobpjs" name="nobpjs" required>
                </div>
                <!-- Add other form fields as needed -->
                <div class="form-group">
                    <label for="notlp">Nomor Telepon:</label>
                    <input type="text" class="form-control" id="notlp" name="notlp"  required>
                </div>
                <div class="form-group">
                    <label for="email">E-Mail:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat:</label>
                    <textarea class="form-control" id="alamat" name="alamat" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </form>
        </div>
    </div>
</div>
