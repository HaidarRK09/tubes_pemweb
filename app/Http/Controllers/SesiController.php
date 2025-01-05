<?php

namespace App\Http\Controllers;

use App\Models\Sesi;
use App\Models\Poli;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;



class SesiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $poli = Poli::all();
        $dokter = Staff::all();
        // dd($sesi);
        return view('staff.admin.sesi.index')->with([
            'user' => Auth::user(),
            'sesi' => Sesi::simplePaginate(5),
            'title' => 'sesi',
            'dokter' => $dokter,
            'poli' => $poli,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('staff.sesi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());

        // Mendapatkan tahun dua digit
        $tahunDuaDigit = date('y');

        // Mencari jumlah sesi yang sudah ada
        $jumlahSesi = Sesi::count();

        // Menghitung nomor sesi berikutnya
        $nomorSesi = $jumlahSesi + 1;

        // Menggabungkan format SSYYXX
        $idSesi = 'SS' . $tahunDuaDigit . sprintf('%02d', $nomorSesi);

        $validatedData = $request->validate([
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'status' => 'required',
            'id_poli' => 'required|max:3',
            'nip' => 'required|max:10',
        ]);

        // Menyisipkan ID sesi yang baru dibuat ke dalam data yang divalidasi
        $validatedData['id_sesi'] = $idSesi;

        $sesi = new Sesi($validatedData);
        $sesi->save();   

        return redirect()->route('sesi')->with('success', 'Sesi created successfully');

        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_sesi)
    {
        $sesi = Sesi::findOrFail($id_sesi);

        return view('staff.sesi.edit', compact('staff'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_sesi)
    {
        $validatedData = $request->validate([
            'id_sesi' => 'required|max:6',
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'status' => 'required',
            'id_poli' => 'required|max:3',
            'nip' => 'required|max:10',
        ]);

        $sesi = Sesi::findOrFail($id_sesi);
        $sesi->update($validatedData);
        $sesi->save();   
 
        return redirect()->route('sesi')->with('success', 'Sesi created successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_sesi)
    {
        $sesi = Sesi::findOrFail($id_sesi);
        $sesi->delete();

        return redirect()->route('sesi')->with('success', 'Sesi deleted successfully');
    }
}
