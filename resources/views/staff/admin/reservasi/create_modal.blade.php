#pasien create modal

<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="addReservasiModal">Tambah Reservasi</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <!-- Form for adding new staff -->
            <form action="{{ route('reservasi.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nama">NIK Pasien</label>
                    <input type="text" class="form-control" id="nik" name="nik"  required>
                </div>
                <div class="form-group">
                    <label for="poli">Pilih Poli</label>
                    <select class="form-control" id="poli" name="poli" required>
                        @foreach ($poli as $item)
                            <option value="{{ $item->id_poli }}"> {{ $item->nama }} </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </form>
        </div>
    </div>
</div>
