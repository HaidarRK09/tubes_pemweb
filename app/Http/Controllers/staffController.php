<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Staff;
use Illuminate\Support\Facades\DB;

class StaffController extends Controller
{
    public function showLoginForm()
    {
        return view('staff.login');
    }

    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Cek kredensial
        $kredensial = $request->only('username', 'password');

        if (Auth::attempt($kredensial)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard.staff');
        } else {
            return back()->with('error', 'Invalid username or password');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('staff.login.form')->with('success', 'Berhasil');
    }

    public function formProfile()
    {
        return view('profile')->with([
            'user' => Auth::user(),
            'title' => 'Profil',
        ]);
    }
    
    public function updateProfile(Request $request)
    {
        try {
            // Validation rules for the update profile form
            $request->validate([
                'username' => 'required|string|max:255',
                'nama' => 'required|string|max:255',
                'notlp' => 'required|string|max:15',
                'email' => 'required|string|email|max:255',
                'alamat' => 'required|string|max:255',
                'password' => 'nullable|string|min:8|confirmed',
            ]);

            // Start the database transaction
            DB::beginTransaction();

            // Retrieve the staff record
            $staff = Staff::find(auth()->id());

            // Check if staff record exists
            if ($staff) {
                // Update staff profile data
                $staff->username = $request->username;
                $staff->nama = $request->nama;
                $staff->notlp = $request->notlp;
                $staff->email = $request->email;
                $staff->alamat = $request->alamat;

                // Update password if provided
                if ($request->filled('password')) {
                    $staff->password = Hash::make($request->password);
                }

                $staff->save();

                // Commit the transaction if everything is successful
                DB::commit();

                return redirect()->back()->with('success', 'Profile updated successfully');
            } else {
                // Rollback the transaction if staff record not found
                DB::rollBack();

                return redirect()->back()->with('error', 'Staff record not found');
            }
        } catch (\Exception $e) {
            // Rollback the transaction on any exception
            DB::rollBack();

            return redirect()->back()->with('error', 'An error occurred. Please try again.');
        }
    }

}
