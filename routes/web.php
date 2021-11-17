<?php

use App\Http\Controllers\BidangKeilmuanController;
use App\Http\Controllers\KoleksiController;
use App\Http\Controllers\KontenController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WebviewController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    if(auth()->check()) {
        return redirect(route('dashboard'));
    }else{
        return redirect(route('login'));
    }
});

Route::group(['middleware' => ['auth']], function () { 
    Route::group(['middleware' => ['can:see-dashboard']], function () {
        Route::get('/dashboard', [KontenController::class, 'dashboard'])->name('dashboard');
    });

    Route::group(['middleware' => ['can:manage-koleksi']], function () {
        Route::get('/koleksi', [KoleksiController::class, 'index'])->name('koleksi.index');
        Route::get('/koleksi-create', [KoleksiController::class, 'create'])->name('koleksi.create');
        Route::post('/koleksi-store', [KoleksiController::class, 'store'])->name('koleksi.store');
        Route::get('/koleksi-edit/{id}', [KoleksiController::class, 'edit'])->name('koleksi.edit');
        Route::post('/koleksi-update/{id}', [KoleksiController::class, 'update'])->name('koleksi.update');
        Route::post('/koleksi-destroy/{id}', [KoleksiController::class, 'destroy'])->name('koleksi.destroy');
    });

    Route::get('/news-index', [NewsController::class, 'index'])->name('news.index');
    Route::get('/news-create', [NewsController::class, 'create'])->name('news.create');
    Route::post('/news-store', [NewsController::class, 'store'])->name('news.store');
    Route::get('/news-edit/{id}', [NewsController::class, 'edit'])->name('news.edit');
    Route::post('/news-update/{id}', [NewsController::class, 'update'])->name('news.update');
    Route::post('/news-destroy/{id}', [NewsController::class, 'destroy'])->name('news.destroy');

    Route::group(['middleware' => ['can:manage-konten']], function () {
        Route::get('/konten', [KontenController::class, 'index'])->name('konten.index');
        Route::get('/konten/create', [KontenController::class, 'create'])->name('konten.create');
        Route::get('/konten/edit/{id}', [KontenController::class, 'edit'])->name('konten.edit');
        Route::post('/konten/store', [KontenController::class, 'store'])->name('konten.store');
        Route::post('/konten/update/{id}', [KontenController::class, 'update'])->name('konten.update');
        Route::post('/konten/destroy/{id}', [KontenController::class, 'destroy'])->name('konten.destroy');
        Route::post('/konten/ubah-jam/{id}', [KontenController::class, 'ubahJam'])->name('konten.ubah-jam');
        Route::post('/konten/hapus-jam/{id}', [KontenController::class, 'hapusJam'])->name('konten.hapus-jam');
    });

    Route::group(['middleware' => ['can:manage-role']], function () {
        Route::get('/role', [RoleController::class, 'index'])->name('role.index');
        Route::post('/role-store', [RoleController::class, 'store'])->name('role.store');
        Route::post('/role-destroy/{id}', [RoleController::class, 'destroy'])->name('role.destroy');
        Route::get('/role-permission/{id}', [RoleController::class, 'permissions'])->name('role.permissions');
        Route::post('/role-permission-sync/{id}', [RoleController::class, 'permissionsSync'])->name('role.permissions.sync');
    });

    Route::group(['middleware' => ['can:manage-user']], function () {
        Route::get('/user', [UserController::class, 'index'])->name('user.index');
        Route::get('/user-role/{id}', [UserController::class, 'role'])->name('user.role');
        Route::post('/user-role-sync/{id}', [UserController::class, 'roleSync'])->name('user.role.sync');
        Route::post('/makeuser', [UserController::class, 'store'])->name('user.store');
    });
});

Route::prefix('webview')->group(function () {
    Route::get('/', [WebviewController::class, 'index'])->name('wv.index');
    Route::get('/konten/{id_koleksi}', [WebviewController::class, 'listKonten'])->name('wv.konten');
    Route::get('/detail-info/{id}', [WebviewController::class, 'detailInfo'])->name('wv.info');
    Route::get('/detail-wisata/{id}', [WebviewController::class, 'detailWisata'])->name('wv.wisata');
    Route::get('/rating/{id}', [WebviewController::class, 'rating'])->name('wv.rating');
    Route::post('/rating-post/{id}', [WebviewController::class, 'ratingPost'])->name('wv.rating-post');
});


require __DIR__.'/auth.php';
