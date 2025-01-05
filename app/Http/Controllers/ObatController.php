<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\Daftar;
use App\Models\Booking;
use App\Models\Sesi;
use App\Models\Poli;
use App\Models\Pasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class ObatController extends Controller
{
    public function index()
    {
        $obat = Obat::all();

        return view('staff.apoteker.index')->with([
            'user' => Auth::user(),
            'obat' => $obat,
            'title' => 'Obat'
        ]);
    }

    public function indexOPasien(){

        return view('staff.apoteker.obatpasien')->with([
            'user' => Auth::user(),
            'daftar' => Daftar::all(),
            'booking' => Booking::all(),
            'pasien' => Pasien::all(),
            'sesi' => Sesi::all(),
            'poli' => Poli::all(),
            'title' => 'Reservasi',
        ]);
    }

    public function updateStatus($id)
{
    // Logika untuk mengupdate status
    Daftar::find($id)->update(['status' => 'Selesai']);

    return redirect()->back()->with('success', 'Status berhasil diperbarui');
}



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('staff.apoteker.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|max:30',
            'merk' => 'required|max:30',
            'deskripsi' => 'required|max:100',
            'harga' => 'required|max:10',
            'qty' => 'required|max:10',
            'uom' => 'required',
        ]);
    
        // Jika validasi gagal, kembalikan pesan error
        if ($validator->fails()) {
            return redirect()->route('apoteker')->withErrors($validator)->withInput();
        }

        // Mendapatkan tanggal sekarang dalam format DDMMYY
        $tanggalSekarang = now()->format('dmy');
            
        // Mencari ID terakhir dari database
        $idTerakhir = Obat::max('id_obat');
            
        // Mendapatkan nomor terakhir dan menambahkan 1
        $nomor = ($idTerakhir) ? intval(substr($idTerakhir, -2)) + 1 : 1;
            
        // Membuat ID obat baru
        $idObatBaru = 'OB' . $tanggalSekarang . str_pad($nomor, 2, '0', STR_PAD_LEFT);

        // Menyimpan data obat ke database
        $obat = new Obat([
            'id_obat' => $idObatBaru,
            'nama' => $request->input('nama'),
            'merk' => $request->input('merk'),
            'deskripsi' => $request->input('deskripsi'),
            'harga' => $request->input('harga'),
            'qty' => $request->input('qty'),
            'uom' => $request->input('uom'),
        ]);
        
        // dd($obat);
        $obat->save();

        return redirect()->route('apoteker')->with('success', 'Obat created successfully');
    }

    public function destroy($id_obat)
    {
        $obat = Obat::findOrFail($id_obat);
        $obat->delete();

        return redirect()->route('apoteker')->with('success', 'Obat deleted successfully');
    }

    public function update(Request $request, $id_obat)
    {
        $validatedData = $request->validate([
            'nama' => 'required|max:30',
            'merk' => 'required|max:30',
            'deskripsi' => 'required|max:100',
            'harga' => 'required|max:10',
            'qty' => 'required|max:10',
            'uom' => 'required',
        ]);

        $obat = Obat::findOrFail($id_obat);
        $obat->update($validatedData);

        return redirect()->route('apoteker')->with('success', 'Obat updated successfully');
    }
}
