<?php

namespace App\Http\Controllers;

use App\Models\Daftar;
use Illuminate\Support\Facades\Auth;
use App\Models\Pasien;
use App\Models\Resep;
use App\Models\ResepObat;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Session;

class pasienController extends Controller
{
    public function index()
    {

        return view('staff.admin.pasien.index')->with([
            'user' => Auth::user(),
            'pasien' => Pasien::simplePaginate(10),
            'title' => 'Pasien',
        ]);
    }

    public function showLogin()
    {
        return view('pasien.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'NIK' => 'required',
            'password' => 'required',
        ]);
        // dd('udah masuk sini');
        $kredensial = $request->only('NIK', 'password');


        if (Auth::guard('pasiens')->attempt($kredensial)) {
            // dd('login success');
            $request->session()->regenerate();
            return redirect()->route('dashboard.pasien');
        } else {
            // dd('login gagals');
            return back()->with('error', 'Invalid NIK or password');
        }
    }

    public function logout()
    {
        Auth::guard('pasiens')->logout();
        return redirect()->route('pasien.login.form')->with('success', 'Berhasil');
    }

    public function create()
    {
        return view('staff.admin.pasien.create');
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'NIK' => 'required|max:255',
            'password' => 'required|max:255',
            'nama' => 'required|max:255',
            'nobpjs' => 'required|max:255',
            'notlp' => 'required|max:15',
            'email' => 'required|email|max:255',
            'alamat' => 'required',
        ]);

        $pasien = new Pasien($validatedData);
        $pasien->save();

        return redirect()->route('pasien')->with('success', 'Pasien created successfully');
    }
    public function destroy($NIK)
    {
        $pasien = Pasien::findOrFail($NIK);
        $pasien->delete();

        return redirect()->route('pasien')->with('success', 'Staff deleted successfully');
    }
    public function update(Request $request, $NIK)
    {
        $validatedData = $request->validate([
            'NIK' => 'required|max:255',
            'password' => 'required|max:255',
            'nama' => 'required|max:255',
            'nobpjs' => 'required|max:255',
            'notlp' => 'required|max:15',
            'email' => 'required|email|max:255',
            'alamat' => 'required',
        ]);

        $pasien = Pasien::findOrFail($NIK);
        $pasien->update($validatedData);

        return redirect()->route('pasien')->with('success', 'Pasien updated successfully');
    }

    public function register(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'NIK' => 'required',
            'password' => 'required',
            'nama' => 'required',
            'nobpjs' => 'required',
            'notlp' => 'required',
            'email' => 'required|email',
            'alamat' => 'required',
        ]);

        // Create a new user using the validated data
        $pasien = Pasien::create($validatedData);

        // // Flash a success message to the session
        // Session::flash('success', 'Pendaftaran berhasil! Silakan masuk dengan akun Anda.');

        // Redirect or perform any other action after successful registration
        return redirect()->route('pasien.login.form')->with('success', 'Registration successful!');
    }

    public function search(Request $request)
    {
        $search = $request->search;

        $pasien = Pasien::where(function($query) use ($search){
            $query->where('NIK','like',"%$search%")
                ->orWhere('nama','like',"%$search%")
                ->orWhere('email','like',"%$search%")
                ->orWhere('alamat','like',"%$search%")
                ->orWhere('notlp','like',"%$search%");
        })
        ->simplePaginate(10);

        $user = Auth::user();
        return view('staff.admin.pasien.index',compact('pasien','search','user'));
    }

    public function historyPasien($NIK){
        $pasien = Daftar::where('NIK',$NIK)->whereIn('status', ['Selesai', 'Batal'])->simplePaginate(10);
        $user = Auth::user();

        return view('staff.admin.pasien.history',compact('pasien','user'));
    }

    public function detailHistory($id){
        $daftar = Daftar::where('id_daftar',$id)->get();
        $idresep = Resep::where('id_daftar',$id)->value('id_resep');
        $resepobat = ResepObat::where('id_resep',$idresep)->get();
        $user = Auth::user();

        return view('staff.admin.pasien.detail', compact('daftar','user','resepobat'));
    }
    
}
