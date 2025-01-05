@extends('dashboard')

@section('title', 'Klinik Cikijing | Dokter')
@section('page-title', 'Dokter')
@section('page-subtitle', 'Periksa Pasien')
@section('breadcrumb', 'Periksa Pasien')

@section('content')
    <div class="row">
        <form action="{{route('dokter.periksa.store')}}" method="POST">
        @csrf 
        <div class="col-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    @if(session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                    @endif
                    <h4 class="card-title">
                        Data Pasien
                    </h4>
                    @foreach ( $daftar as $data )
                        <div class="form-group">
                            <label for="NIK">NIK :</label>
                            <input type="text" class="form-control" id="NIK" name="NIK" value="{{ $data->NIK }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama :</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="{{ $data->pasien->nama }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nobpjs">Nomor BPJS :</label>
                            <input type="text" class="form-control" id="nobpjs" name="nobpjs" value="{{ $data->pasien->nobpjs }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="notlp">Nomor Telepon :</label>
                            <input type="text" class="form-control" id="notlp" name="notlp" value="{{ $data->pasien->notlp }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat :</label>
                            <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $data->pasien->alamat }}" readonly>
                        </div> 
                        <div class="form-group">
                            <label for="email">Email :</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $data->pasien->email }}" readonly>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        Hasil Pemeriksaan
                    </h4>
                        <div class="form-group">
                            <label for="nama">Anamnesa:</label>
                            <textarea name="anamnesa" id="anamnesa" cols="30" rows="10"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="nama">Tekanan Darah:</label>
                            <input type="number" class="form-control" id="sistolik" name="sistolik" placeholder="Sitolik"  required>
                            <input type="number" class="form-control" id="diastolik" name="diastolik" placeholder="Diastolik"  required>
                        </div>
                        <div class="form-group">
                            <label for="nama">Diagnosa Penyakit:</label>
                            <input type="text" class="form-control" id="penyakit" name="penyakit"  required>
                        </div>
                        <div class="form-group">
                            <label for="statusRujukan">Status :</label>
                            <select class="form-control" id="statusRujukan" name="statusRujukan" onchange="toggleRujukanInput(this)">
                                <option value="pulang">Pulang</option>
                                <option value="rujuk">Rujuk</option>
                            </select>
                        </div>
                        
                        <div id="rujukanInput" style="display: none;">
                            <div class="form-group">
                                <label for="tempatRujukan">Tempat Rujukan:</label>
                                <select class="form-control" id="tempatRujukan" name="tempatRujukan" onchange="toggleTempatRujukanLainnya(this)">
                                    <option value="Laboratorium">Laboratorium</option>
                                    <option value="Radiologi">Radiologi</option>
                                    <option value="lainnya">Lainnya</option>
                                </select>
                            </div>
                        
                            <div class="form-group" id="tempatRujukanLainnyaContainer" style="display: none;">
                                <label for="tempatRujukanLainnya">Tempat Rujukan Lainnya:</label>
                                <input type="text" class="form-control" id="tempatRujukanLainnya" name="tempatRujukanLainnya" value="">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="jumlahObat">Jumlah obat yang akan diberikan:</label>
                            <input type="number" class="form-control" id="jumlahObat" name="jumlah" min="0" oninput="generateObat()" placeholder="isi 0 jika tidak perlu">
                            <div id="result"></div>
                        </div>
                        <div id="obatContainer"></div>
                    <button type="submit" class="btn btn-primary">Tambah</button>    
                </div>
            </div>
        </div>
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <script>
        // Gantilah ini dengan data obat yang sesuai dari server atau PHP
        var dataObat = <?php echo json_encode($obat); ?>;

        function generateObat() {
            var jumlahObat = document.getElementById('jumlahObat').value;

            document.getElementById('obatContainer').innerHTML = '';

            for (var i = 1; i <= jumlahObat; i++) {
                var divObat = document.createElement('div');
                var dropdownOptions = '';

                // Buat opsi dropdown dari dataObat
                for (var j = 0; j < dataObat.length; j++) {
                    dropdownOptions += `<option value="${dataObat[j].id_obat}">${dataObat[j].nama}</option>`;
                }

                divObat.innerHTML = `
                    <div class="form-group">
                        <label for="obat${i}">Nama Obat ${i}:</label>
                        <select class="form-control" id="obat${i}" name="obat${i}" required>
                            ${dropdownOptions}
                        </select>
                        <label for="qty${i}">Jumlah ${i}:</label>
                        <input type="text" class="form-control" id="qty${i}" name="qty${i}" required>
                    </div>
                `;

                document.getElementById('obatContainer').appendChild(divObat);
            }
        }

        function toggleRujukanInput(selectElement) {
        var rujukanInput = document.getElementById('rujukanInput');
        var tempatRujukan = document.getElementById('tempatRujukan');
        var tempatRujukanLainnyaContainer = document.getElementById('tempatRujukanLainnyaContainer');

        if (selectElement.value === 'rujuk') {
            rujukanInput.style.display = 'block';
            tempatRujukan.style.display = 'block';
        } else {
            rujukanInput.style.display = 'none';
            tempatRujukanLainnyaContainer.style.display = 'none';
        }
    }

    function toggleTempatRujukanLainnya(selectElement) {
    var tempatRujukanLainnyaContainer = document.getElementById('tempatRujukanLainnyaContainer');
    var tempatRujukanLainnyaInput = document.getElementById('tempatRujukanLainnya');

    if (selectElement.value === 'lainnya') {
        tempatRujukanLainnyaContainer.style.display = 'block';
    } else {
        tempatRujukanLainnyaContainer.style.display = 'none';
        tempatRujukanLainnyaInput.value = null; // Set the value to null when "Lainnya" is not selected
    }
    }
    </script>


@endsection