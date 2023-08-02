<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\KepsekController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RiwayatMemberController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\VisitorController;
use Illuminate\Support\Facades\Route;

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
    return view('home.index');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified', 'member.dashboard'])->name('dashboard');
Route::get('/dashboard/member', [DashboardController::class, 'memberDashboard'])->middleware(['auth', 'verified'])->name('member.dashboard');
Route::resource('pengunjung', VisitorController::class);
Route::get('/generate-kode-member', [MemberController::class, 'generateKodeMember']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('buku', BookController::class);
    Route::resource('kategori', CategoryController::class);
    Route::resource('kelas', KelasController::class);
    Route::resource('member', MemberController::class);
    Route::resource('kepsek', KepsekController::class);
    Route::resource('staff', StaffController::class);
    Route::get('/pinjam', [PeminjamanController::class, 'index'])->name('pinjam.index');
    Route::get('/get-member', [PeminjamanController::class, 'getMember']);
    Route::post('/pinjam', [PeminjamanController::class, 'store'])->name('pinjam.store');
    Route::get('/pengembalian', [PengembalianController::class, 'index'])->name('pengembalian.index');
    Route::get('/get-pengembalian', [PengembalianController::class, 'getMember']);
    Route::get('/pengembalian-proses/{id}', [PengembalianController::class, 'ProsesPengembalian']);
    Route::put('/pengembalian-proses/{id}', [PengembalianController::class, 'store']);
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/detail/{id}', [LaporanController::class, 'show']);
    Route::get('/laporan/cetak', [LaporanController::class, 'cetak_filter'])->name('laporan.cetak');
    Route::get('/setting', [SettingController::class, 'index'])->name('setting.index');
    Route::put('/setting/update', [SettingController::class, 'update'])->name('setting.update');
    Route::put('/setting/updateDenda', [SettingController::class, 'updateDenda'])->name('setting.updateDenda');
    Route::get('laporan-pengunjung', [VisitorController::class, 'laporan'])->name('pengunjung.laporan');
    Route::get('laporan-pengunjung/cetak', [VisitorController::class, 'cetak'])->name('pengunjung.cetak');
    Route::get('riwayat-member', [RiwayatMemberController::class, 'index'])->name('riwayat.index');
    Route::get('/cetakKartu/{memberId}', [MemberController::class, 'cetak'])->name('cetak.kartu.member');
    Route::get('/about', function () {
        return view('about');
    })->name('about');
});

require __DIR__ . '/auth.php';
