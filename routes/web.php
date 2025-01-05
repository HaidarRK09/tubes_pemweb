<?php

use App\Http\Controllers\dashboardController;
use App\Http\Controllers\dokterController;
use App\Http\Controllers\pasienController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\staffController;
use App\Http\Controllers\superadminController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\poliController;
use App\Http\Controllers\reservasiController;
use App\Http\Controllers\SesiController;
use App\Models\Staff;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('landingPage.landing');
});




//Khusus Staff

Route::get('/login/staff', [StaffController::class, 'showLoginForm'])->name('staff.login.form');
Route::post('/login/staff-proses', [StaffController::class, 'login'])->name('staff.login');
Route::post('/logout/staff', [staffController::class, 'logout'])->name('staff.logout');

Route::get('/dashboard', [dashboardController::class, 'index'])->name('dashboard.staff')->middleware('auth');


Route::group(['middleware' => ['auth']], function () {

    //Edit Profil
    Route::get('/staff/profile/index', [staffController::class, 'formProfile'])->name('staff.profile');
    Route::post('/update-profile', [staffController::class, 'updateProfile'])->name('update-profile');

    Route::group(['middleware' => ['cekStaffLogin:superadmin']], function () {

        Route::get('/staff/index', [superadminController::class, 'index'])->name('staff');
        Route::get('/staff/create', [SuperadminController::class, 'create'])->name('staff.create');
        Route::post('/staff/store', [SuperadminController::class, 'store'])->name('staff.store');
        Route::get('/staff/edit/{nip}', [SuperadminController::class, 'edit'])->name('staff.edit');
        Route::put('/staff/update/{nip}', [SuperadminController::class, 'update'])->name('staff.update');
        Route::delete('/staff/destroy/{nip}', [SuperadminController::class, 'destroy'])->name('staff.destroy');
    });

    Route::group(['middleware' => ['cekStaffLogin:admin']], function () {

        //Pasien
        Route::get('pasien/index', [pasienController::class, 'index'])->name('pasien');
        Route::get('pasien/create', [pasienController::class, 'create'])->name('pasien.create');
        Route::post('pasien/store', [pasienController::class, 'store'])->name('pasien.store');
        Route::delete('pasien/destroy/{NIK}', [pasienController::class, 'destroy'])->name('pasien.destroy');
        Route::put('pasien/update/{NIK}', [pasienController::class, 'update'])->name('pasien.update');
        Route::get('pasien/edit/{NIK}', [pasienController::class, 'edit'])->name('pasien.edit');
        Route::get('/search-pasien', [pasienController::class, 'search'])->name('search-pasien');
        Route::get('/pasien/history/{NIK}', [pasienController::class, 'historyPasien'])->name('pasien.history');
        Route::get('/pasien/history-detail/{id}', [pasienController::class, 'detailHistory'])->name('pasien.history.detail');

        //Staff
        Route::get('pegawai/index', [superadminController::class, 'indexStaff'])->name('pegawai');
        Route::get('/pegawai/create', [SuperadminController::class, 'create'])->name('pegawai.create');
        Route::post('/pegawai/store', [SuperadminController::class, 'store'])->name('pegawai.store');
        Route::get('/pegawai/edit/{nip}', [SuperadminController::class, 'edit'])->name('pegawai.edit');
        Route::put('/pegawai/update/{nip}', [SuperadminController::class, 'update'])->name('pegawai.update');
        Route::delete('/pegawai/destroy/{nip}', [SuperadminController::class, 'destroy'])->name('pegawai.destroy');

        // Poli klinik
        Route::get('/poli/index', [poliController::class, 'index'])->name('poli');
        Route::get('/poli/create', [poliController::class, 'create'])->name('poli.create');
        Route::post('/poli/store', [poliController::class, 'store'])->name('poli.store');
        Route::delete('/poli/destroy/{id_poli}', [poliController::class, 'destroy'])->name('poli.destroy');
        Route::put('/poli/update/{id_poli}', [poliController::class, 'update'])->name(('poli.update'));
        Route::get('/poli/edit/{id_poli}', [poliController::class, 'edit'])->name('poli.edit');

        // Sesi
        Route::get('/sesi/index', [SesiController::class, 'index'])->name('sesi');
        Route::get('/sesi/create', [SesiController::class, 'create'])->name('sesi.create');
        Route::post('/sesi/store', [SesiController::class, 'store'])->name('sesi.store');
        Route::delete('/sesi/destroy/{id_sesi}', [SesiController::class, 'destroy'])->name('sesi.destroy');
        Route::put('/sesi/update/{id_sesi}', [SesiController::class, 'update'])->name('sesi.update');
        Route::get('/sesi/edit/{id_sesi}', [SesiController::class, 'edit'])->name('sesi.edit');

        //Reservasi
        Route::get('reservasi/index', [reservasiController::class, 'indexReservasi'])->name('reservasi');
        Route::put('/reservasi/update/{id_daftar}', [reservasiController::class, 'updateDaftar'])->name('reservasi.update');
        Route::post('/reservasi/store', [reservasiController::class, 'storeDaftar'])->name('reservasi.store');
        Route::delete('/reservasi/destroy/{id_daftar}', [reservasiController::class, 'destroyDaftar'])->name('reservasi.destroy');
        Route::put('/reservasi/update-periksa/{id_daftar}', [reservasiController::class, 'updatePeriksa'])->name('reservasi.periksa');
        Route::get('reservasi/history', [reservasiController::class, 'indexHistory'])->name('reservasi.history');

        //Booking
        Route::get('booking/index', [reservasiController::class, 'indexBooking'])->name('booking');
        Route::post('/booking/store', [reservasiController::class, 'storeBookAdmin'])->name('booking.store');
    });

    //Khusus Dokter 
    Route::group(['middleware' => ['cekStaffLogin:admin,dokter gigi,dokter umum']], function () {
        Route::get('dokter/index', [dokterController::class, 'index'])->name('dokter');
        Route::get('/dokter/periksa/{id_daftar}', [dokterController::class, 'periksa'])->name('dokter.periksa');
        Route::post('/dokter/periksa/store', [dokterController::class, 'simpanPeriksa'])->name('dokter.periksa.store');
    });

    //Khusus Apotekerk
    Route::group(['middleware' => ['cekStaffLogin:admin,apoteker']], function () {
        //Dokter
        Route::get('/obat/index', [ObatController::class, 'index'])->name('apoteker');
        Route::get('/obat/create', [ObatController::class, 'index'])->name('obat.create');
        Route::post('/obat/store', [ObatController::class, 'store'])->name('obat.store');
        Route::delete('/obat/destroy/{id_obat}', [ObatController::class, 'destroy'])->name('obat.destroy');
        Route::put('/obat/update/{id_obat}', [ObatController::class, 'update'])->name('obat.update');
        Route::get('/obat/edit/{id_obat}', [ObatController::class, 'edit'])->name('obat.edit');
        Route::get('/obat/obatpasien', [ObatController::class, 'indexOPasien'])->name('apoteker.opasien');
        Route::put('/update-status/{id}', [ObatController::class, 'updateStatus'])->name('update.status');
    });

    //Khusus Radiologi
    Route::group(['middleware' => ['cekStaffLogin:admin,radiologi']], function () {
        Route::get('radiologi/index', [dokterController::class, 'indexRadio'])->name('radiologi');
        Route::post('radiologi/periksa/{id}', [dokterController::class, 'periksaNonDok'])->name('radiologi.periksa');
    });
    //Khusus Lab
    Route::group(['middleware' => ['cekStaffLogin:admin,laboratorium']], function () {
        Route::get('laboratorium/index', [dokterController::class, 'indexLab'])->name('laboratorium');
        Route::post('laboratorium/periksa/{id}', [dokterController::class, 'periksaNonDok'])->name('laboratorium.periksa');
    });
});

// Khusus Pasien

Route::get('login/pasien', [pasienController::class, 'showLogin'])->name('pasien.login.form');
Route::post('/login/pasien-proses', [pasienController::class, 'login'])->name('pasien.login');
Route::post('/logout', [pasienController::class, 'logout'])->name('pasien.logout');
Route::post('/pasien/register', [PasienController::class, 'register'])->name('pasien.register');


Route::middleware(['checkPasien'])->group(function () {

    Route::get('/dashboard-pasien', [dashboardController::class, 'indexPasien'])->name('dashboard.pasien');

    //Booking
    Route::get('/pasien-booking', [reservasiController::class, 'formBook'])->name('pasien.booking.form');
    Route::post('/pasien-booking/store', [reservasiController::class, 'storeBook'])->name('pasien.booking.store');
});
