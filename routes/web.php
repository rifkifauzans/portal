<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StakeholderController;
use App\Http\Controllers\DokumenController;
use App\Http\Controllers\MasterDataController;
use App\Http\Controllers\ReportDataController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReferensiController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
    // return view('login');
Route::get('/',[AuthController::class,'index'])->name('login');
// });

Route::prefix('login')->group(function(){
    Route::get('/',[AuthController::class,'index'])->name('login');
    Route::post('/func_login',[AuthController::class,'func_login']);
});

Route::get('/func_logout',[AuthController::class,'func_logout']);


//Route::group(['middleware'=>['auth']},function()]
Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [HomeController::class, 'index']);
    Route::get('/exportstakeholder', [StakeholderController::class, 'exportstakeholder']);
    Route::prefix('user')->group(function(){
        Route::get('/index', [UserController::class, 'index']);
        Route::post('/storeuser', [UserController::class, 'func_storeuser']);
        Route::post('/updateuser', [UserController::class, 'func_updateuser']);
        Route::post('/updatepassword', [UserController::class, 'func_updatepassword']);
        Route::get('/form_user_add', [UserController::class, 'view_form_user']);
        Route::get('/form_user_edit/{id}', [UserController::class, 'view_form_user']);
        Route::get('/deleteuser/{id}', [UserController::class, 'func_deleteuser']);  

        // Users Login sqlsrv_user
        Route::get('/indexUsers', [UserController::class, 'indexUsers']);
        Route::post('/storeUsers', [UserController::class, 'storeUsers'])->name('user.storeUsers');
        Route::put('/updateUsers', [UserController::class, 'updateUsers'])->name('user.updateUsers');
        Route::get('/deleteUsers/{id}', [UserController::class, 'func_deleteUsers'])->name('user.deleteUsers');
    });

    Route::prefix('referensi')->group(function() {
        // Rute untuk Bagian
        Route::get('/bagian', [ReferensiController::class, 'index'])->name('bagian.index');
        Route::post('/bagian/store', [ReferensiController::class, 'store'])->name('bagian.store');
        Route::put('/bagian/update', [ReferensiController::class, 'update'])->name('bagian.update');
        Route::get('/bagian/delete/{id}', [ReferensiController::class, 'destroy'])->name('bagian.destroy');
        Route::get('/bagian/{id}', [ReferensiController::class, 'getBagianById'])->name('bagian.getById');
    
        // Rute untuk Urusan
        Route::get('/urusan', [ReferensiController::class, 'indexUrusan'])->name('urusan.index');
        Route::post('/urusan/store', [ReferensiController::class, 'storeUrusan'])->name('urusan.store');
        Route::put('/urusan/update/{urusanId}', [ReferensiController::class, 'updateUrusan'])->name('urusan.update');
        Route::get('/urusan/delete/{urusanId}', [ReferensiController::class, 'deleteUrusan'])->name('urusan.destroy');
        Route::get('/urusan/{urusanId}', [ReferensiController::class, 'getUrusanById'])->name('urusan.getById');

        // Rute untuk Role
        Route::get('/role', [ReferensiController::class, 'indexRole'])->name('role.index');
        Route::post('/role/store', [ReferensiController::class, 'storeRole'])->name('role.store');
        Route::put('/role/update/{roleid}', [ReferensiController::class, 'updateRole'])->name('role.update');
        Route::get('/role/destroy/{roleid}', [ReferensiController::class, 'destroyRole'])->name('role.destroy');
    });

    Route::prefix('tehrelasi')->group(function(){
        Route::get('/pengajuan', [TehRelasiController::class, 'pengajuan']);
        Route::post('/storepengajuan', [TehRelasiController::class, 'func_storepengajuan']);
        Route::post('/updatepengajuan', [TehRelasiController::class, 'func_updatepengajuan']);
        Route::get('/form_pengajuan_add', [TehRelasiController::class, 'view_form_pengajuan']);
        Route::get('/form_pengajuan_edit/{id}', [TehRelasiController::class, 'view_form_pengajuan']);
        Route::get('/form_pengajuan_detail/{id}', [TehRelasiController::class, 'view_detail_pengajuan']);
        Route::get('/deletepengajuan/{id}', [TehRelasiController::class, 'func_deletepengajuan']);
        Route::get('/get_data_pengajuan/{id}', [TehRelasiController::class, 'get_data_pengajuan'])->name('get_data_sdm01');

    });

});

