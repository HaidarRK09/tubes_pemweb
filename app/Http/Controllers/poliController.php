<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Poli;
use Illuminate\Support\Facades\Auth;

class poliController extends Controller
{
    public function index()
    {
        $poli = Poli::all();

        return view('staff.admin.poli.index')->with([
            'user' => Auth::user(),
            'poli' => $poli,
            'title' => 'Poli',
        ]);
    }

    public function create()
    {
        return view('staff.admin.poli.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $validatedData = $request->validate([
            'nama' => 'required|max:25',
        ]);
        

        $poli = new Poli($validatedData);
        $poli->save();

        return redirect()->route('poli')->with('success', 'Poliklinik created successfully');
    }

    public function destroy($id_poli)
    {
        $poli = Poli::findOrFail($id_poli);
        $poli->delete();

        return redirect()->route('poli')->with('success', 'Poliklinik deleted successfully');
    }

    public function update(Request $request, $id_poli)
    {
        $validatedData = $request->validate([
            'nama' => 'required|max:25',
        ]);

        $poli = Poli::findOrFail($id_poli);
        $poli->update($validatedData);

        return redirect()->route('poli')->with('success', 'Poliklinik updated successfully');
    }
}
