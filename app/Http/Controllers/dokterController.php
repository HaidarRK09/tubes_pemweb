<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Daftar;
use App\Models\Obat;
use App\Models\Poli;
use App\Models\RekamMedis;
use App\Models\Resep;
use App\Models\ResepObat;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;



class dokterController extends Controller
{
    public function index(){

    return view('staff.dokter.index')->with([
        'user' => Auth::user(),
        'title' => 'Dashboard Dokter',
        'daftar' => Daftar::where('status','Diperiksa')->get(),
    ]);

    }

    public function periksa($id_daftar){

        $daftar = Daftar::where('id_daftar',$id_daftar)->get();
        $obat = Obat::all();
        
        return view('staff.dokter.periksa')->with([
            'user' => Auth::user(),
            'daftar' => $daftar,
            'obat' => $obat,
        ]);
    }

    public function simpanPeriksa(Request $request)
    {
        try {
            DB::beginTransaction();
            $validatedData = $request->validate([
                'NIK' => 'required|string|max:16',
                'nama' => 'required|string|max:50',
                'nobpjs' => 'string|max:13',
                'notlp' => 'required|string|max:13',
                'alamat' => 'required|string|max:100',
                'email' => 'required|email|max:255',
                'penyakit' => 'required|string|max:255',
                'sistolik' => 'numeric',
                'diastolik' => 'numeric',
                'jumlah' => 'numeric',
                'obat1' => 'string|max:255',
                'qty1' => 'numeric',
                'obat2' => 'string|max:255',
                'qty2' => 'numeric',
                'statusRujukan' => 'string|max:255',
                'tempatRujukan' => 'string|max:255',
                'tempatRujukanLainnya' => 'nullable|string|max:255',
                'anamnesa' => 'string'
            ]);
            
            // Mendapatkan tanggal sekarang
            $tanggalSekarang = Carbon::now();
        
            // Format id_rmedis: RYYYYMMDDXXX (XXX adalah data ke-1 pada tanggal tersebut)
            $dataKe = DB::table('rekam_mediss')
                ->whereDate('created_at', $tanggalSekarang)
                ->count() + 1;
            $nomorUrut = str_pad($dataKe, 3, '0', STR_PAD_LEFT);
        
            $idRMedis = 'R' . $tanggalSekarang->format('Ymd') . $nomorUrut;

            $rujuk = $request->input('tempatRujukan');
            $tempatRujuk = null;
            $statusRujukan = $request->input('statusRujukan');

            if ($statusRujukan == 'rujuk') {
                if (!is_null($rujuk)) {
                    $poli = Poli::where('nama', $rujuk)->first();
                    if ($poli) {
                        $tempatRujuk = $poli->nama;
                    } else {
                        $tempatRujuk = $request->input('tempatRujukanLainnya');
                    }
                }
            } elseif ($statusRujukan == 'pulang') {
                $tempatRujuk = null;
            }
            
            // Menyimpan data pemeriksaan ke dalam tabel rekam_medis
            $rekamMedis = new RekamMedis([
                'id_rmedis' => $idRMedis,
                'tgl_berobat' => $tanggalSekarang->format('Y-m-d'),
                'penyakit' => $request->input('penyakit'),
                'sistolik' => $request->input('sistolik'),
                'diastolik' => $request->input('diastolik'),
                'anamnesa' => $request->input('anamnesa'),
                'status' => $request->input('statusRujukan'),
                'tempat_rujuk' => $tempatRujuk,
                'NIK' => $request->input('NIK'),
            ]);
            $rekamMedis->save();
        
            $id_daftar = Daftar::where('NIK', $request->input('NIK'))
                ->where('status', 'Diperiksa')
                ->value('id_daftar');
        
            $dataKe = DB::table('reseps')
                ->whereDate('created_at', $tanggalSekarang)
                ->count() + 1;
            $nomorUrut = str_pad($dataKe, 3, '0', STR_PAD_LEFT);
        
            $idResep = 'RS' . $tanggalSekarang->format('Ymd') . $nomorUrut;
            
            
            // Menyimpan data resep
            $resep = new Resep([
                'id_resep' => $idResep,
                'id_daftar' => $id_daftar,
            ]);
            $resep->save();
            
            if ($request->input('jumlah') > 0) {
                for ($i = 1; $i <= $request->input('jumlah'); $i++) {
                    // Get obat and qty from the request based on the current iteration
                    $id_obat = $request->input("obat{$i}");
                    $qty = $request->input("qty{$i}");
            
                    // Check if the new quantity will not result in a negative value
                    $currentQty = Obat::where('id_obat', $id_obat)->value('qty');
                    if ($currentQty < $qty) {
                        throw new \Exception("Stok obat dengan ID $id_obat tidak mencukupi.");
                    }
            
                    // Update the Obat table
                    $updated = Obat::where('id_obat', $id_obat)
                        ->update(['qty' => DB::raw("qty - $qty")]);
            
                    // Check if the update was successful
                    if (!$updated) {
                        throw new \Exception("Obat dengan ID: $id_obat Habis");
                    }
            
                    // Create a new entry in the ResepObat model
                    $resepobat = new ResepObat([
                        'id_resep' => $idResep, // Assuming $idResep is the id_resep from your previous logic
                        'id_obat' => $id_obat,
                        'qty' => $qty,
                        // Add other fields if needed
                    ]);
            
                    // Save the resepobat
                    $resepobat->save();
                    Daftar::where('NIK', $request->input('NIK'))
                            ->where('status', 'Diperiksa')
                            ->update(['status' => 'Obat']);
                }
            } else {
                // Jika jumlah obat 0, langsung update status di tabel Daftar menjadi 'Selesai'
                Daftar::where('NIK', $request->input('NIK'))
                    ->where('status', 'Diperiksa')
                    ->update(['status' => 'Selesai']);
            }
            
        
            DB::commit();
        
            return view('staff.dokter.index')->with([
                'user' => Auth::user(),
                'title' => 'Dashboard Dokter',
                'daftar' => Daftar::all(),
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
        
            return redirect()->route('dokter.periksa', ['id_daftar' => Daftar::where('NIK', $request->input('NIK'))
            ->where('status', 'Diperiksa')
            ->value('id_daftar')])->with('error', $e->getMessage());
        }
    }

    public function indexRadio(){
    
        return view('staff.radiologi.index')->with([
            'user' => Auth::user(),
            'title' => 'Dashboard Dokter',
            'daftar' => Daftar::where('status','Diperiksa')->get(),
        ]);
    
    }

    public function indexLab(){
    
        return view('staff.laboratorium.index')->with([
            'user' => Auth::user(),
            'title' => 'Dashboard Dokter',
            'daftar' => Daftar::where('status','Diperiksa')->get(),
        ]);
    
    }

    public function periksaNonDok($id) {
        // Temukan data daftar berdasarkan ID
        $daftar = Daftar::findOrFail($id);

        // Ubah status menjadi "Selesai"
        $daftar->update(['status' => 'Selesai']);

        return redirect()->back()->with('success', 'Pemeriksaan selesai dan status diperbarui.');
    }

}
