<?php

use App\Models\Meja;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\WaiterController;

Route::get('/', function () {
    if(Auth::check()){
         $role = Auth::user()->role;
        $routes = [
            'admin' => 'admin',
            'waiter' => 'menu',
            'kasir' => 'transaksi',
            'owner' => 'laporan',
            'petugas' => 'petugas',
        ];
        return redirect($routes[$role]);
    }
     
    return view('welcome');
})->name('dashboard-redirect');
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

route::get('/redirect',[AuthController::class,'login'])->name('auth')->middleware('role:admin,waiter,kasir,owner');

route::middleware('role:admin')->prefix('admin')->group(function(){
    route::get('/',[AuthController::class,'afterLoginAdmin'])->name('admin.index');
    route::get('/meja',[AdminController::class,'tambah'])->name('admin.meja');
    route::post('/meja',[AdminController::class,'storeMeja'])->name('store.meja');
    route::get('/meja/{id}',[AdminController::class,'editMeja'])->name('edit.meja'); 
    route::put('/meja/{id}',[AdminController::class,'updateMeja'])->name('update.meja');
    route::delete('/meja/{id}',[AdminController::class,'hapusMeja'])->name('hapus.meja');

   

    route::get('/user',[AuthController::class,'afterLoginAdmin'])->name('admin.user');
    route::get('/user/tambah',[AdminController::class,'tambah'])->name('user.tambah');
    route::post('/user/tambah',[AdminController::class,'storeUser'])->name('user.store');
    route::get('/user/edit/{id}',[AdminController::class,'edit'])->name('edit.user');
    route::put('/user/edit/{id}',[AdminController::class,'updateUser'])->name('update.user');
    route::delete('/user/delete/{id}',[AdminController::class,'deleteUser'])->name('hapus.user');
});

route::middleware('role:admin,waiter')->group(function(){
    route::get('/menu',[AuthController::class,'afterLoginAdmin'])->name('admin.menu');
    route::get('/menu/tambah',[AdminController::class,'tambah'])->name('menu.tambah');
    route::post('/menu/tambah',[AdminController::class,'storeMenu'])->name('menu.store');
    route::get('/menu/edit/{id}',[AdminController::class,'edit'])->name('edit.menu');
    route::put('/menu/edit/{id}',[AdminController::class,'updateMenu'])->name('update.menu');
    route::delete('/menu/delete/{id}',[AdminController::class,'deleteMenu'])->name('hapus.menu');
 route::get('/order',[WaiterController::class,'index'])->name('waiter.index');
    route::post('/order',[WaiterController::class,'store'])->name('waiter.store');

});
route::middleware('role:kasir,waiter,owner')->group(function(){
   
    route::get('/export',[WaiterController::class,'export'])->name('kasir.export');
    route::get('/laporan',[WaiterController::class,'laporan'])->name('waiter.laporan');
});

route::middleware('role:kasir')->group(function(){
    route::get('/transaksi',[KasirController::class,'index'])->name('kasir.index');
    route::get('/transaksi/{id}',[KasirController::class,'show'])->name('kasir.show');
    route::post('/transaksi/{id}',[KasirController::class,'bayar'])->name('waiter.bayar');
});

