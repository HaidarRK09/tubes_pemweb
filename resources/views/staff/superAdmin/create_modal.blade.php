<!-- staff.superAdmin.create_modal.blade.php -->

<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="addStaffModalLabel">Tambah Staff</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <!-- Form for adding new staff -->
            <form action="{{ route('staff.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nip">NIP</label>
                    <input type="text" class="form-control" id="nip" name="nip"  required>
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username"  required>
                </div>
                <!-- Add other form fields as needed (password, nama, notlp, email, alamat) -->
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" required>
                </div>
                <!-- Add other form fields as needed -->
                <div class="form-group">
                    <label for="notlp">Nomor Telepon</label>
                    <input type="text" class="form-control" id="notlp" name="notlp"  required>
                </div>
                <div class="form-group">
                    <label for="email">E-Mail</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea class="form-control" id="alamat" name="alamat" required></textarea>
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    <select class="form-control" id="role" name="role" required>
                        <option value="admin" {{ (old('role', $data->role ?? '') == 'admin') ? 'selected' : '' }}>Admin</option>
                        <option value="superadmin" {{ (old('role', $data->role ?? '') == 'superadmin') ? 'selected' : '' }}>Super Admin</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </form>
        </div>
    </div>
</div>
