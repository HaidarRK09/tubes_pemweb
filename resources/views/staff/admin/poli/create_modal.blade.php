#pasien create modal

<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="addPoliModal">Tambah Poli</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <!-- Form for adding new staff -->
            <form action="{{ route('poli.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nama">Nama Poliklinik</label>
                    <input type="text" class="form-control" id="nama" name="nama"  required>
                </div>
            
                <button type="submit" class="btn btn-primary">Tambah</button>
            </form>
        </div>
    </div>
</div>
