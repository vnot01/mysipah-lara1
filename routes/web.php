<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
// use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Operator\OperatorController;
use App\Http\Controllers\Warehouse\WarehouseController;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [
        AdminController::class,
        'AdminDashboard'
    ])->name('admin.dashboard');
    Route::get('/admin/logout', [
        AdminController::class,
        'AdminLogout'
    ])->name('admin.logout');
    Route::get('/admin/profile', [
        AdminController::class,
        'AdminProfile'
    ])->name('admin.profile');
    Route::post('/admin/profile/store', [
        AdminController::class,
        'AdminProfileStore'
    ])->name('admin.profile.store');
    Route::post('/admin/change/password', [
        AdminController::class,
        'AdminChangePassword'
    ])->name('admin.change.password');
    Route::post('/admin/profile/token', [
        AdminController::class,
        'membuatToken'
    ])->name('admin.profile.membuatToken');
    Route::get('/admin/profile/token/lihat', [
        AdminController::class,
        'index'
    ])->name('admin.profile.token.lihat');
    Route::delete('/admin/profile/token/hapus', [
        AdminController::class,
        'hapusToken'
    ])->name('admin.profile.token.hapus');
});

// Route::middleware(['auth', 'role:warehouse'])->group(function () {
//     Route::get('/warehouse/dashboard', [
//         WarehouseController::class,
//         'WarehouseDashboard'
//     ])->name('warehouse.dashboard');
//     Route::get('/warehouse/logout', [
//         WarehouseController::class,
//         'WarehouseLogout'
//     ])->name('warehouse.logout');
//     Route::get('/warehouse/profile', [
//         WarehouseController::class,
//         'WarehouseProfile'
//     ])->name('warehouse.profile');

//     // Route::get('/admin/dashboard',[AdminController::class,
//     // 'AdminDashboard'])->name('admin.dashboard');    
//     // Route::get('/admin/logout',[AdminController::class,
//     // 'AdminLogout'])->name('admin.logout');
//     // Route::get('/admin/profile',[AdminController::class,
//     // 'AdminProfile'])->name('admin.profile');
//     // Route::post('/admin/profile/store',[AdminController::class,
//     // 'AdminProfileStore'])->name('admin.profile.store');
//     // Route::post('/admin/change/password',[AdminController::class,
//     // 'AdminChangePassword'])->name('admin.change.password');
//     // Route::post('/admin/profile/token',[AdminController::class,
//     // 'membuatToken'])->name('admin.profile.membuatToken');

// });
// Route::middleware(['auth', 'role:operator'])->group(function () {
//     Route::get('/operator/dashboard', [
//         OperatorController::class,
//         'OperatorDashboard'
//     ])->name('operator.dashboard');
//     Route::get('/operator/logout', [
//         OperatorController::class,
//         'OperatorLogout'
//     ])->name('operator.logout');
//     Route::get('/operator/profile', [
//         OperatorController::class,
//         'OperatorProfile'
//     ])->name('operator.profile');
// });

// Route::middleware(['auth', 'role:user'])->group(function () {
//     Route::get('/admin/dashboard', [
//         AdminController::class,
//         'AdminDashboard'
//     ])->name('admin.dashboard');
//     Route::get('/admin/logout', [
//         AdminController::class,
//         'AdminLogout'
//     ])->name('admin.logout');
//     Route::get('/admin/profile', [
//         AdminController::class,
//         'AdminProfile'
//     ])->name('admin.profile');
//     Route::post('/admin/profile/store', [
//         AdminController::class,
//         'AdminProfileStore'
//     ])->name('admin.profile.store');
//     Route::post('/admin/change/password', [
//         AdminController::class,
//         'AdminChangePassword'
//     ])->name('admin.change.password');
//     Route::post('/admin/profile/token', [
//         AdminController::class,
//         'membuatToken'
//     ])->name('admin.profile.membuatToken');
//     Route::get('/admin/profile/token/lihat', [
//         AdminController::class,
//         'index'
//     ])->name('admin.profile.token.lihat');
//     Route::delete('/admin/profile/token/hapus', [
//         AdminController::class,
//         'hapusToken'
//     ])->name('admin.profile.token.hapus');
// });
// Route::get('/admin/dashboard',[AdminController::class,'AdminDashboard'])->name('admin.dashboard');
// Route::get('/warehouse/dashboard',[WarehouseController::class,'WarehouseDashboard'])->name('warehouse.dashboard');
// Route::get('/operator/dashboard',[OperatorController::class,'OperatorDashboard'])->name('operator.dashboard');
// Route::get('/user/dashboard',[UserController::class,'UserDashboard'])->name('user.dashboard');


require __DIR__ . '/auth.php';