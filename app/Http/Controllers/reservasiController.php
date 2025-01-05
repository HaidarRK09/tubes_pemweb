<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Daftar;
use App\Models\Pasien;
use App\Models\Poli;
use App\Models\Sesi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class reservasiController extends Controller
{
    public function indexReservasi()
    {   

        // $now = Carbon::now()->tz('Asia/Jakarta')->format('Y-m-d');

        return view('staff.admin.reservasi.index')->with([
            'user' => Auth::user(),
            'daftar' => Daftar::all(),
            'poli' => Poli::all(),
            'title' => 'Reservasi',
        ]);
    }

    public function indexHistory()
    {
        return view('staff.admin.reservasi.history')->with([
            'user' => Auth::user(),
            'daftar' => Daftar::all(),
            'poli' => Poli::all(),
            'title' => 'Reservasi',
        ]);
    }

    public function updateDaftar(Request $request, $id_daftar)
    {
            $validatedData = $request->validate([
                'status' => 'required|max:25',
            ]);
            $daftar = Daftar::findOrFail($id_daftar);
            $daftar->update($validatedData);
    
            return redirect()->route('reservasi')->with('success', 'Reservasi updated successfully');
    }

    public function updatePeriksa($id_daftar)
    {
        $reservasi = Daftar::findOrFail($id_daftar);
        $reservasi->status = 'Diperiksa';
        $reservasi->save();

        return redirect()->route('reservasi')->with('success', 'Reservasi updated successfully');
    }

    public function storeDaftar(Request $request)
    {
        $nik = Pasien::where('NIK', $request->nik)->get();

        // Periksa apakah koleksi kosong
        if ($nik->isEmpty()) {
            return redirect()->route('reservasi')->with('error', 'NIK Tidak ditemukan');
        }

        $idpoli = $request->poli;
        $tanggal = Carbon::now();


        // Mendapatkan hari dari tanggal
        $hari = Carbon::parse($tanggal)->locale('id')->dayName;

        // Mendapatkan tahun dua digit
        $tahunDuaDigit = date('ymd');

        // Mencari jumlah sesi yang sudah ada
        $jumlahdaftar = Daftar::where('tgl', $tanggal->format('ymd'))->count();

        // Menghitung nomor sesi dan nomor daftar berikutnya
        $nomorDaftar = $jumlahdaftar + 1;

        // Menggabungkan format BYYMMDDXXX B231211001
        $idDaftar = 'D' . $tahunDuaDigit . sprintf('%03d', $nomorDaftar);

        // Mendapatkan jadwal sesuai dengan poli dan hari
        $jadwal = Sesi::select('id_sesi')
                        ->where('id_poli', $idpoli)
                        ->where('hari', $hari)
                        ->get();

        // dd($jadwal);
        // Validasi jadwal tidak tersedia
        if ($jadwal->isEmpty()) {
            return redirect()->route('reservasi')->with('error', 'Tidak ada jadwal poli tersebut di hari ini.');
        }

        $antrian = Daftar::where('tgl', $tanggal->format('ymd'))
                                ->where('id_sesi',$jadwal[0]->id_sesi)
                                ->count();
        $nomorAntrian = $antrian + 1;
        
        // Membuat daftar
        $daftar = Daftar::create([
        'id_daftar' => $idDaftar,
        'tgl' => $tanggal,
        'id_booking' => null,
        'NIK' => $request->nik,
        'id_sesi' => $jadwal[0]->id_sesi,
        'antrian' => $nomorAntrian,
        'status' => 'Berjalan',
        ]);

        // Memeriksa keberhasilan pembuatan daftar
        if (!$daftar) {
            return redirect()->route('reservasi')->with('error', 'Gagal melakukan reservasi.');
        }

        return redirect()->route('reservasi')->with('success', 'Reservasi updated successfully');
    }

    public function destroyDaftar($id_daftar)
    {
        $daftar = Daftar::findOrFail($id_daftar);
        $daftar->delete();

        return redirect()->route('reservasi')->with('success', 'Staff deleted successfully');
    }

    public function indexBooking()
    {

        return view('staff.admin.booking.index')->with([
            'user' => Auth::user(),
            'daftar' => Daftar::all(),
            'booking' => Booking::all(),
            'poli' => Poli::all(),
            'title' => 'Reservasi',
        ]);
    }

    public function formBook(){
        $poli = Poli::all();

        return view('pasien.booking')->with([
            'user' => Auth::guard('pasiens')->user(),
            'poli' => $poli,
            'title' => 'Reservasi',
        ]);
    }
    public function storeBookAdmin(Request $request)
    {
        try {
            DB::beginTransaction();
    
            $idpoli = $request->poli;
            $tanggal = $request->tanggal;
            $nik = Pasien::select('NIK')
                        ->where('NIK', $request->NIK)
                        ->get();
    
            if ($nik->isEmpty()) {
                throw new \Exception('NIK Tidak Ditemukan.');
            }
    
            // Mendapatkan hari dari tanggal
            $hari = Carbon::parse($tanggal)->locale('id')->dayName;
    
            // Mendapatkan tahun dua digit
            $tahunDuaDigit = date('ymd');
    
            // Mencari jumlah sesi yang sudah ada
            $jumlahbooking = Booking::where('tgl', $tanggal)->count();
            $jumlahdaftar = Daftar::where('tgl', $tanggal)->count();
    
            // Menghitung nomor sesi dan nomor daftar berikutnya
            $nomorSesi = $jumlahbooking + 1;
            $nomorDaftar = $jumlahdaftar + 1;
    
            // Menggabungkan format BYYMMDDXXX B231211001
            $idBook = 'B' . $tahunDuaDigit . sprintf('%03d', $nomorSesi);
            $idDaftar = 'D' . $tahunDuaDigit . sprintf('%03d', $nomorDaftar);
    
            // Mendapatkan jadwal sesuai dengan poli dan hari
            $jadwal = Sesi::select('id_sesi')
                            ->where('id_poli', $idpoli)
                            ->where('hari', $hari)
                            ->get();
    
            // Validasi jadwal tidak tersedia
            if ($jadwal->isEmpty()) {
                throw new \Exception('Jadwal tidak tersedia untuk tanggal tersebut.');
            }
    
            // Membuat booking
            $booking = Booking::create([
                'id_booking' => $idBook,
                'tgl' => Carbon::now()->format('Y-m-d'),
                'NIK' => $request->NIK,
                'id_sesi' => $jadwal[0]->id_sesi,
            ]);
    
            // Memeriksa keberhasilan pembuatan booking
            if (!$booking) {
                throw new \Exception('Gagal melakukan booking.');
            }
    
            $antrian = Daftar::where('tgl', $tanggal)
                                    ->where('id_sesi', $jadwal[0]->id_sesi)
                                    ->count();
            $nomorAntrian = $antrian + 1;
    
            // Membuat daftar
            $daftar = Daftar::create([
                'id_daftar' => $idDaftar,
                'tgl' => $tanggal,
                'id_booking' => $idBook,
                'NIK' => $request->NIK,
                'id_sesi' => $jadwal[0]->id_sesi,
                'antrian' => $nomorAntrian,
                'status' => 'Booking',
            ]);
    
            // Memeriksa keberhasilan pembuatan daftar
            if (!$daftar) {
                throw new \Exception('Gagal melakukan booking.');
            }
    
            DB::commit();
    
            return redirect()->route('booking')->with([
                'user' => Auth::user(),
                'daftar' => Daftar::all(),
                'booking' => Booking::all(),
                'poli' => Poli::all(),
                'title' => 'Reservasi',
            ]);
    
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('booking')->with('error', $e->getMessage());
        }
    }

    public function storeBook(Request $request)
    {
        try {
            DB::beginTransaction();
    
            $idpoli = $request->poli;
            $tanggal = $request->tanggal;
    
            // Mendapatkan hari dari tanggal
            $hari = Carbon::parse($tanggal)->locale('id')->dayName;
    
            // Mendapatkan tahun dua digit
            $tahunDuaDigit = date('ymd');
    
            // Mencari jumlah sesi yang sudah ada
            $jumlahbooking = Booking::where('tgl', $tanggal)->count();
            $jumlahdaftar = Daftar::where('tgl', $tanggal)->count();
    
            // Menghitung nomor sesi dan nomor daftar berikutnya
            $nomorSesi = $jumlahbooking + 1;
            $nomorDaftar = $jumlahdaftar + 1;
    
            // Menggabungkan format BYYMMDDXXX B231211001
            $idBook = 'B' . $tahunDuaDigit . sprintf('%03d', $nomorSesi);
            $idDaftar = 'D' . $tahunDuaDigit . sprintf('%03d', $nomorDaftar);
    
            // Mendapatkan jadwal sesuai dengan poli dan hari
            $jadwal = Sesi::select('id_sesi')
                            ->where('id_poli', $idpoli)
                            ->where('hari', $hari)
                            ->get();
    
            // Validasi jadwal tidak tersedia
            if ($jadwal->isEmpty()) {
                throw new \Exception('Jadwal tidak tersedia untuk tanggal tersebut.');
            }
    
            // Membuat booking
            $booking = Booking::create([
                'id_booking' => $idBook,
                'tgl' => Carbon::now()->format('Y-m-d'),
                'NIK' => $request->NIK,
                'id_sesi' => $jadwal[0]->id_sesi,
            ]);
    
            // Memeriksa keberhasilan pembuatan booking
            if (!$booking) {
                throw new \Exception('Gagal melakukan booking.');
            }
    
            $antrian = Daftar::where('tgl', $tanggal)
                                    ->where('id_sesi', $jadwal[0]->id_sesi)
                                    ->count();
            $nomorAntrian = $antrian + 1;
    
            // Membuat daftar
            $daftar = Daftar::create([
                'id_daftar' => $idDaftar,
                'tgl' => $tanggal,
                'id_booking' => $idBook,
                'NIK' => $request->NIK,
                'id_sesi' => $jadwal[0]->id_sesi,
                'antrian' => $nomorAntrian,
                'status' => 'Booking',
            ]);
    
            // Memeriksa keberhasilan pembuatan daftar
            if (!$daftar) {
                throw new \Exception('Gagal melakukan booking.');
            }
    
            $poli = Poli::all();
    
            DB::commit();
    
            return redirect()->route('dashboard.pasien')->with([
                'user' => Auth::guard('pasiens')->user(),
                'poli' => $poli,
                'title' => 'Reservasi',
                'success' => 'Berhasil Melakukan Booking'
            ]);
    
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('pasien.booking.form')->with('error', $e->getMessage());
        }
    }

}
