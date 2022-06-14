<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LaporanExcelController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ManagementUserController;
use App\Http\Controllers\ManagementInventarisController;
use App\Http\Controllers\ManagementObatController;
use App\Http\Controllers\ReturObatController;
use App\Http\Controllers\RequestServiceController;

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




Route::middleware(['auth'])->group(function(){

  Route::get('/', [HomeController::class, 'home'])->name('home');
  Route::post('ubah_password', [HomeController::class, 'ubah_password']);

  Route::middleware(['adminMiddleware'])->group(function(){
    // Management Data user
      Route::get('management_user', [ManagementUserController::class, 'index'])->name('management_user');
      Route::post('management_user/store', [ManagementUserController::class, 'store']);
      Route::patch('management_user/update/{id}', [ManagementUserController::class, 'update']);


    // Management Jenis Obat
      Route::get('management_obat', [ManagementObatController::class, 'index'])->name('management_obat');
      Route::post('management_obat/store', [ManagementObatController::class, 'store']);
      Route::patch('management_obat/update/{id}',[ManagementObatController::class, 'update']);
  });

  Route::middleware(['teknisiMiddleware'])->group(function(){
    // Management Jenis Inventaris
      Route::get('management_inventaris', [ManagementInventarisController::class, 'index'])->name('management_inventaris');
      Route::post('management_inventaris/store', [ManagementInventarisController::class, 'store']);
      Route::patch('management_inventaris/update/{id}',[ManagementInventarisController::class, 'update']);
  });


// TRANSACTIONS

// Service
  Route::resource('service', ServiceController::class);
  Route::get('approve/service/{id}', [ServiceController::class, 'approve']);
  Route::get('approve_manager/service', [ServiceController::class, 'approve_manager']);
  Route::post('reject/service', [ServiceController::class, 'reject']);
  Route::post('get_inventaris/service', [ServiceController::class, 'getInventaris']);
  Route::get('check_data/service', [ServiceController::class, 'check_data_service']);
  Route::get('export/excel_service', [ServiceController::class, 'export_service_excel']);

// Request Service
  Route::get('request_service', [RequestServiceController::class, 'index_request'])->name('request_service');
  Route::post('request_service/onprogress', [RequestServiceController::class, 'onprogress']);
  Route::post('request_service/closed', [RequestServiceController::class, 'closed']);
  Route::post('request_service/selesai', [RequestServiceController::class, 'selesai']);
  Route::get('request_service/check_data', [RequestServiceController::class, 'lonceng_request_service']);

// Retur Obat
  // Route::get('retur_obat', [ReturObatController::class, 'index'])->name('retur_obat');
  // Route::get('retur_obat/create', [ReturObatController::class, 'create']);
  // Route::post('retur_obat/store', [ReturObatController::class, 'store']);
  // Route::get('retur_obat/show/{id}', [ReturObatController::class, 'show']);

  Route::middleware(['managerMiddleware'])->group(function(){
    // Laporan
      Route::get('laporan_service', [LaporanController::class, 'laporan_service']);
      Route::post('laporan_service/search', [LaporanController::class, 'search']);
      Route::get('laporan_service/search_excel', [LaporanController::class, 'search_excel']);
      Route::get('laporan_service/search_pdf', [LaporanController::class, 'search_pdf']);
      Route::get('laporan_service/search_pdf_single/{id}', [LaporanController::class, 'search_pdf_single']);
  });


});

require __DIR__.'/auth.php';
