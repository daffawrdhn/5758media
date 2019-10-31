<?php
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
use App\Order;
Route::get('/', function () {
    return view('welcome');
});
Route::get('/a', function () {
    return view('a');
});
Route::get('/nota/{kode}', function($kode){
    // $nota = Order::where('kode', $kode)->first();
    // $pdf = PDF::loadview('nota',['nota'=>$nota]);
    // return $pdf->setPaper('a4', 'landscape')->stream($kode.'.pdf');
    $nota = Order::where('kode', $kode)->first();
    $pdf = PDF::loadView('nota',['nota'=>$nota]);
    return $pdf->stream($kode.'.pdf');
});
// Route::get('/nota/{kode}', 'HomeController@cek');
Auth::routes();
// Route::any('/home', 'HomeController@index')->name('home');
Route::any('/home', 'HomeController@index_baru')->name('home');
Route::post('/home/new_order', 'HomeController@store');
Route::put('/home/order/batalkan/{id}', 'HomeController@batal');
Route::put('/home/order/pembayaran/{id}', 'HomeController@pembayaran');
Route::put('/home/order/pelunasan/{id}', 'HomeController@pelunasan');
Route::put('/home/order/selesai/{id}', 'HomeController@selesai');
Route::get('/home/order/nota/{id}', 'HomeController@nota');
Route::get('/home/order/archive/', 'HomeController@archive');
Route::group(['middleware' => ['auth','admin']], function() {
    // Route::get('/dashboard', function() {
    //     return view('dashboard');
    // });
    // Route::any('/dashboard', 'Admin\DashboardController@index')->name('dashboard');
    Route::any('/dashboard', 'Admin\DashboardController@index_baru')->name('dashboard');
    //useredit
    Route::get('/dashboard/user/edit/{id}/', 'Admin\DashboardController@useredit');
    Route::put('/dashboard/user/edit/update/{id}', 'Admin\DashboardController@editupdate');
    //userdelete
    Route::get('/dashboard/user/delete/{id}/', 'Admin\DashboardController@userdelete');
    //-> old
    Route::get('/dashboard/order/delete/{id}/', 'Admin\DashboardController@orderdelete'); //DANGER!
    //verifyorder-old
    Route::put('/dashboard/order/proses/{id}', 'Admin\DashboardController@proses');
    //verifyorder-new
    Route::put('/dashboard/order/proses/new/{id}', 'Admin\DashboardController@konfirmasiorder');
    Route::put('/dashboard/order/proses/dp/{id}', 'Admin\DashboardController@konfirmasidp');
    Route::put('/dashboard/order/proses/jaminan/{id}', 'Admin\DashboardController@konfirmasijaminan');
    Route::put('/dashboard/order/proses/batal/{id}', 'Admin\DashboardController@batal');
    Route::put('/dashboard/order/proses/pembatalan/{id}', 'Admin\DashboardController@konfirmasipembatalan');
    Route::put('/dashboard/order/proses/delete/{id}', 'Admin\DashboardController@hapusorder');
    Route::put('/dashboard/order/proses/selesai/{id}', 'Admin\DashboardController@orderselesai');
    Route::get('/dashboard/order/nota/{id}', 'Admin\DashboardController@nota');
    //ajax
});
