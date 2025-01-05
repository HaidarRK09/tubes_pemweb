<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Daftar;
use Carbon\Carbon;

class dashboardController extends Controller
{
    public function index(){
    return view('dashboard')->with([
        'user' => Auth::user(),
        'title' => 'Dashboard',
    ]);
    }

    public function indexPasien(){
        $user = Auth::guard('pasiens')->user();
        // $tanggal = Booking::select('tgl')
        //                         ->where('NIK',$user->NIK)
        //                         ->get();

        $booking = Booking::join('daftars','bookings.id_booking','=','daftars.id_booking')
                                ->where('bookings.NIK',$user->NIK)
                                ->where('daftars.NIK',$user->NIK)
                                ->where('daftars.status','Booking')
                                ->get();
        
        if ($booking->isEmpty()) {
            $tgl = null;
            $hari = null;
            $antrian = null;
            $formattedDate = null;
        } else {
            // Extract the date value from the JSON array
            $bookArray = json_decode($booking, true);
            $tgl = $bookArray[0]['tgl'] ?? null;
        
            if ($tgl === null) {
                $hari = null;
                $antrian = null;
                $formattedDate = null;
            } else {
                // Parse the date using Carbon
                $hari = Carbon::parse($tgl)->locale('id')->dayName;
                $formattedDate = Carbon::parse($tgl)->locale('id')->isoFormat('D MMMM Y');
                $antrian = $bookArray[0]['antrian'] ?? null;
            }
        }
    
        $tanggalSekarang = now()->toDateString(); 
        $antrians = Daftar::whereDate('tgl', $tanggalSekarang)
                                ->where('status','Berjalan')
                                ->select('antrian')
                                ->orderBy('antrian','desc')
                                ->first();

        $antrianarray = json_decode($antrians,true);
        $antrianlive = $antrianarray['antrian'] ?? null;
        

        return view('pasien.landing')->with([
            'user' => $user,
            'tanggal' => $formattedDate,
            'hari' => $hari,
            'antrian' => $antrian,
            'antrianlive' => $antrianlive,
            'title' => 'Dashboard Pasen',
        ]);
    }
}
