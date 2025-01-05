<!-- staff.superAdmin.delete_modal.blade.php -->

<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="deleteStaffModalLabel{{ $data->nip }}">Hapus Staff</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <p>Apakah Anda yakin ingin menghapus staff ini?</p>
            <!-- Form for deleting staff -->
            <form action="{{ route('pegawai.destroy', $data->nip) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Hapus</button>
            </form>
        </div>
    </div>
</div>
