<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class superadminController extends Controller
{
    public function index()
    {
        return view('staff.superAdmin.index')->with([
            'user' => Auth::user(),
            'staff' => Staff::whereIn('role', ['superadmin', 'admin'])->get(),
            'title' => 'Akun',
        ]);
    }

    public function indexStaff()
    {

        return view('staff.admin.staff.index')->with([
            'user' => Auth::user(),
            'staff' => Staff::whereNotIn('role', ['superadmin', 'admin'])->get(),
            'title' => 'Akun',
        ]);
    }

    public function create()
    {
        return view('staff.superAdmin.create');
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'nip' => 'required|unique:staffs|max:255',
            'username' => 'required|max:255',
            'password' => 'required|max:255',
            'nama' => 'required|max:255',
            'notlp' => 'required|max:15',
            'email' => 'required|email|unique:staffs|max:255',
            'alamat' => 'required',
            'role' => 'required',
        ]);
        $staff = new Staff($validatedData);
        $staff->save();

        return redirect()->route('staff')->with('success', 'Staff created successfully');
    }

    public function edit($nip)
    {
        $staff = Staff::findOrFail($nip);

        return view('staff.superAdmin.edit', compact('staff'));
    }

    public function update(Request $request, $nip)
    {
        $validatedData = $request->validate([
            'nip' => 'required|max:255',
            'username' => 'required|max:255',
            'password' => 'required|max:255',
            'nama' => 'required|max:255',
            'notlp' => 'required|max:15',
            'email' => 'required|email|max:255',
            'alamat' => 'required',
            'role' => ' required',
        ]);

        $staff = Staff::findOrFail($nip);
        $staff->update($validatedData);

        return redirect()->route('staff')->with('success', 'Staff updated successfully');
    }

    public function destroy($nip)
    {
        $staff = Staff::findOrFail($nip);
        $staff->delete();

        return redirect()->route('staff')->with('success', 'Staff deleted successfully');
    }
}
