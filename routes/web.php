<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SetoranController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;
use App\Http\Controllers\PenarikanController;

Route::get('/nasabah/permintaan-penarikan', [PenarikanController::class, 'index'])->name('nasabah.permintaan-penarikan');
Route::post('penarikan', [PenarikanController::class, 'store'])->name('penarikan.store');


// Route untuk AdminController
Route::get('/nasabah/setoran-sampah', [SetoranController::class, 'index'])->name('nasabah.setoran-sampah');
Route::get('/nasabah/riwayat-setoran', [SetoranController::class, 'riwayat'])->name('nasabah.riwayat-setoran');
Route::post('setoran', [SetoranController::class, 'store'])->name('setoran.store');
Route::put('/setoran/{id}', [SetoranController::class, 'update'])->name('setoran.update');
Route::delete('/nasabah/setoran-sampah/{id}', [SetoranController::class, 'destroy'])->name('setoran.destroy');

Route::get('/admin/setoran-sampah', [SetoranController::class, 'admin'])->name('admin.setoran-sampah');
Route::post('/admin/setoran', [SetoranController::class, 'storeAdmin'])->name('adminSetor.store');
Route::get('/admin/riwayat-setoran', [SetoranController::class, 'riwayatAdmin'])->name('admin.riwayat-setoran');
Route::delete('/admin/setoran-sampah/{id}', [SetoranController::class, 'destroyAdmin'])->name('adminSetor.destroy');

Route::get('/admin', [AdminController::class, 'index'])->name('admin.admin');
Route::post('admin', [AdminController::class, 'store'])->name('admin.store');
Route::put('/admin/{id}', [AdminController::class, 'update'])->name('admin.update');
Route::delete('/admin/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');


// Halaman utama
Route::get('/', function () {
    return view('pelita-bangsa');
});

// Login Admin
Route::get('/admin/login', [AuthController::class, 'showAdminLoginForm'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'adminLogin']);

// Login Nasabah
Route::get('/nasabah/login', [AuthController::class, 'showNasabahLoginForm'])->name('nasabah.login');
Route::post('/nasabah/login', [AuthController::class, 'nasabahLogin']);

// Register Admin
Route::get('/admin/register', [AuthController::class, 'showAdminRegisterForm'])->name('admin.register');
Route::post('/admin/register', [AuthController::class, 'adminRegister']);

// Register Nasabah
Route::get('/nasabah/register', [AuthController::class, 'showNasabahRegisterForm'])->name('nasabah.register');
Route::post('/nasabah/register', [AuthController::class, 'nasabahRegister']);

// Lupa Password (Forgot Password)
Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
    ->middleware('guest')
    ->name('password.request');

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
    ->middleware('guest')
    ->name('password.email');

Route::get('/reset-password/{token}', function ($token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->save();

            $user->setRememberToken(Str::random(60));

            event(new PasswordReset($user));
        }
    );

    return $status === Password::PASSWORD_RESET
                ? redirect()->route('login')->with('status', __($status))
                : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');

// ! Halaman Admin
Route::get('/admin/dashboard', function () {
    return view('admin-page.dashboard');
})->name('admin.dashboard');
Route::get('/admin/data-sampah', function () {
    return view('admin-page.data-sampah');
})->name('admin.data-sampah');

// Route::get('/admin', function () {
//     return view('admin-page.index');
// })->name('admin.index');

Route::get('/admin/profile', function () {
    return view('admin-page.profile');
})->name('admin.profile');
Route::get('/admin/riwayat-setoran', function () {
    return view('admin-page.riwayat-setoran');
})->name('admin.riwayat-setoran');
// Route::get('/admin/setoran-sampah', function () {
//     return view('admin-page.setoran-sampah');
// })->name('admin.setoran-sampah');
Route::get('/admin/data-sampah', function () {
    return view('admin-page.data-sampah');
})->name('admin.data-sampah');

Route::get('/admin/nasabah', function () {
    return view('admin-page.nasabah');
})->name('admin.nasabah');

// ! Halaman nasabah
Route::get('/nasabah/dashboard', function () {
    return view('nasabah-page.dashboard');
})->name('nasabah.dashboard');
// Route::get('/nasabah/permintaan-penarikan', function () {
//     return view('nasabah-page.permintaan-penarikan');
// })->name('nasabah.permintaan-penarikan');
Route::get('/nasabah/profile', function () {
    return view('nasabah-page.profile');
})->name('nasabah.profile');
// Route::get('/nasabah/riwayat-setoran', function () {
//     return view('nasabah-page.riwayat-setoran');
// })->name('nasabah.riwayat-setoran');
// Route::get('/nasabah/setoran-sampah', function () {
//     return view('nasabah-page.setoran-sampah');
// })->name('nasabah.setoran-sampah');
