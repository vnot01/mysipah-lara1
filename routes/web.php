<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
// use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\ManufactureController;
use App\Http\Controllers\Nasabah\NasabahController;
use App\Http\Controllers\Operator\OperatorController;
use App\Http\Controllers\ProcessingController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SourceController;
use App\Http\Controllers\TypeController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/', [
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

    Route::get('/main/incomingwaste', [
        ProcessingController::class,
        'incomingWasteIndex'
    ])->name('main.incoming_waste');
    Route::post('/main/incomingwaste/delete/{id}',[
        ProcessingController::class,
        'DestroyIncomingWaste'])
        ->name('delete.incoming_waste');
    Route::post('/incomingwaste/add',[
        ProcessingController::class,
        'StoreNewIncomingWaste'])
        ->name('incomingwaste.add');
    Route::get('/incomingwaste/scan',[NasabahController::class, 'getTempCard']
        )->middleware(['auth', 'verified'])->name('scan.kartu');

    Route::get('/main/processing', [
        ProcessingController::class,
        'incomingWasteIndex'
        ])->name('main.processing');
    Route::post('/main/processing/delete/{id}',[
            ProcessingController::class,
        'DestroyIncomingWaste'])
        ->name('delete.processing');
    Route::post('/processing/add',[
        ProcessingController::class,
        'StoreNewIncomingWaste'])
        ->name('processing.add');
    Route::get('/processing/scan',[NasabahController::class, 'getTempCard']
            )->middleware(['auth', 'verified'])->name('scan.kartu');

    Route::get('/main/queue', [
        ProcessingController::class,
        'incomingWasteIndex'
        ])->name('main.queue');
    Route::post('/main/queue/delete/{id}',[
            ProcessingController::class,
        'DestroyIncomingWaste'])
        ->name('delete.queue');
    Route::post('/queue/add',[
        ProcessingController::class,
        'StoreNewIncomingWaste'])
        ->name('queue.add');
    Route::get('/queue/scan',[NasabahController::class, 'getTempCard']
            )->middleware(['auth', 'verified'])->name('scan.kartu');

    Route::get('/main/warehouse', [
        ProcessingController::class,
        'incomingWasteIndex'
        ])->name('main.warehouse');
    Route::post('/main/queue/delete/{id}',[
            ProcessingController::class,
        'DestroyIncomingWaste'])
        ->name('delete.warehouse');
    Route::post('/warehouse/add',[
        ProcessingController::class,
        'StoreNewIncomingWaste'])
        ->name('warehouse.add');
    Route::get('/warehouse/scan',[NasabahController::class, 'getTempCard']
            )->middleware(['auth', 'verified'])->name('scan.kartu');
    // Route::get('/all/sources','AllSources')->name('all.sources');

    // Route::get('/all/sources', [
    //     SourceController::class, 'AllSources'
    // ])->name('all.sources');
    // // Route::get('/add/sources','AddSources')->name('add.sources');
    // Route::post('/all/sources/add', [
    //     SourceController::class, 'StoreSources'
    // ])->name('store.sources');
    // Route::get('/all/sources/edit/{id}', [
    //     SourceController::class, 'EditSources'
    // ])->name('edit.sources');
    // Route::put('/all/sources/edit', [
    //     SourceController::class, 'UpdateSources'
    // ])->name('update.sources');
    // Route::post('/all/sources/delete/{id}', [
    //     SourceController::class, 'DestroySources'
    // ])->name('delete.sources');
    // Route::get('/new/sources', [
    //     SourceController::class, 'NewSources'
    // ])->name('new.sources');

    Route::controller(SourceController::class)->group(function(){
        Route::get('/all/sources','AllSources')
            ->name('all.sources');
        Route::post('/all/sources/add','StoreSources')
            ->name('store.sources');
        Route::get('/all/sources/edit/{id}','EditSources')
            ->name('edit.sources');
        Route::put('/all/sources/edit','UpdateSources')
            ->name('update.sources');
        Route::post('/all/sources/delete/{id}','DestroySources')
            ->name('delete.sources');
        Route::get('/new/sources','NewSources')
            ->name('new.sources');
        // Route::get('/main/mastersources', [
        //     AdminController::class,
        //     'masterSourcesIndex'
        // ])->name('main.master_sources');
        // Route::get('/main/mastersources', [
        //     SourceController::class,
        //     'NewSources'
        // ])->name('main.mastersources.create');
        // Route::get('/main/mastersources/edit', [
        //     AdminController::class,
        //     'masterSourcesEdit'
        // ])->name('main.master_sources.edit');
        // Route::get('/main/mastersources', [
        //     AdminController::class,
        //     'masterSourcesShow'
        // ])->name('main.master_sources.show');
        // Route::delete('/main/mastersources', [
        //     AdminController::class,
        //     'masterSourcesDestroy'
        // ])->name('main.master_sources.destroy');
    });

    Route::controller(TypeController::class)->group(function(){
        Route::get('/all/types','AllTypes')
            ->name('all.types');
        Route::post('/all/types/add','StoreTypes')
            ->name('store.types');
        Route::get('/all/types/edit/{id}','EditTypes')
            ->name('edit.types');
        Route::put('/all/types/edit','UpdateTypes')
            ->name('update.types');
        Route::post('/all/types/delete/{id}','DestroyTypes')
            ->name('delete.types');
        Route::get('/new/types','NewTypes')
            ->name('new.types');
    });

    Route::controller(ManufactureController::class)->group(function(){
        Route::get('/all/manufactures','AllManufactures')
            ->name('all.manufactures');
        Route::post('/all/manufactures/add','StoreManufactures')
            ->name('store.manufactures');
        Route::post('/all/manufactures/add','Store2Manufactures')
            ->name('store.manufacturess');
        Route::get('/all/manufactures/edit/{id}','EditManufactures')
            ->name('edit.manufactures');
        Route::put('/all/manufactures/edit','UpdateManufactures')
            ->name('update.manufactures');
        Route::post('/all/manufactures/delete/{id}','DestroyManufactures')
            ->name('delete.manufactures');
        Route::get('/new/manufactures','NewManufactures')
            ->name('new.manufactures');
    });

    Route::controller(ProductController::class)->group(function(){
        Route::get('/all/products','AllProducts')
            ->name('all.products');
        Route::post('/all/products/add','StoreProducts')
            ->name('store.products');
        Route::get('/all/products/edit/{id}','EditProducts')
            ->name('edit.products');
        Route::put('/all/products/edit','UpdateProducts')
            ->name('update.products');
        Route::post('/all/products/delete/{id}','DestroyProducts')
            ->name('delete.products');
        Route::get('/new/products','NewProducts')
            ->name('new.products');
    });


    Route::get('/nasabah',[NasabahController::class, 'NasabahDashboard'],function () {
        return view('nasabah.index');
    })->middleware(['auth', 'verified'])->name('nasabah.index');
    Route::get('/nasabah/scan',[NasabahController::class, 'getTempCard']
    )->middleware(['auth', 'verified'])->name('scan.kartu');
    Route::get('/nasabah/nokartu',[NasabahController::class, 'getNoKartu'])
        ->middleware(['auth', 'verified'])->name('nokartu');
    Route::post('/nasabah/add',[NasabahController::class, 'StoreNewNasabah'])
        ->name('nasabah.add');
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

Route::middleware(['auth', 'role:operator'])->group(function () {
    Route::get('/operator/dashboard', [
        OperatorController::class,
        'OperatorDashboard'
    ])->name('operator.dashboard');
    Route::get('/operator/logout', [
        OperatorController::class,
        'OperatorLogout'
    ])->name('operator.logout');
    Route::get('/operator/profile', [
        OperatorController::class,
        'OperatorProfile'
    ])->name('operator.profile');
});

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