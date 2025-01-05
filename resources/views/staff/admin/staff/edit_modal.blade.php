<!-- staff.superAdmin.edit_modal.blade.php -->

<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="editStaffModalLabel{{ $data->nip }}">Edit Staff</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <!-- Form for updating staff -->
            <form action="{{ route('pegawai.update', $data->nip) }}" method="POST">
                @csrf
                @method('PUT')
                <!-- Include the form fields for updating staff -->
                <div class="form-group">
                    <label for="nip">NIP</label>
                    <input type="text" class="form-control" id="nip" name="nip" value="{{ old('nip', $data->nip ?? '') }}" readonly>
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" value="{{ old('username', $data->username ?? '') }}" required>
                </div>
                <!-- Add other form fields as needed (password, nama, notlp, email, alamat) -->
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama', $data->nama ?? '') }}" required>
                </div>
                <!-- Add other form fields as needed -->
                <div class="form-group">
                    <label for="notlp">Nomor Telepon</label>
                    <input type="text" class="form-control" id="notlp" name="notlp" value="{{ old('notlp', $data->notlp ?? '') }}" required>
                </div>
                <div class="form-group">
                    <label for="email">E-Mail</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $data->email ?? '') }}" required>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea class="form-control" id="alamat" name="alamat" required>{{ old('alamat', $data->alamat ?? '') }}</textarea>
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    <select class="form-control" id="role" name="role" required>
                        <option value="dokter umum" {{ (old('role', $data->role ?? '') == 'dokter umum') ? 'selected' : '' }}>Dokter Umum</option>
                        <option value="dokter gigi" {{ (old('role', $data->role ?? '') == 'dokter gigi') ? 'selected' : '' }}>Dokter Gigi</option>
                        <option value="apoteker" {{ (old('role', $data->role ?? '') == 'apoteker') ? 'selected' : '' }}>Apoteker</option>
                        <option value="radiologi" {{ (old('role', $data->role ?? '') == 'radiologi') ? 'selected' : '' }}>Radiologi</option>
                        <option value="laboratorium" {{ (old('role', $data->role ?? '') == 'laboratorium') ? 'selected' : '' }}>Laboratorium</option>
                    </select>
                </div> 
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
