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
use Illuminate\Http\Request;


Route::get('/', function () {
    $totalorders = Order::count();
    $totalmediapartners = Order::where('paket','=','2')->count();
    $averageunits = Order::avg('jumlah_unit');


    $start = new Carbon('2019-09-01 00:00:00');
    $now = Carbon::now();
    $days = $start->diffInDays($now);

    return view('index')
    ->with('totalorders', $totalorders)
    ->with('totalmediapartners', $totalmediapartners)
    ->with('averageunits', $averageunits)
    ->with('days', $days);
})->name('index');

Route::get('/sonya', function (Request $request) {
    $tanggal = $request->input('tanggal');
    $hari = $request->input('hari');
    $unit = $request->input('unit');
    $route = Route::current();
    $cek = Order::whereBetween('tanggal_sewa', [Carbon::parse($tanggal), Carbon::parse($tanggal)->addDays($hari)])->orderBy('tanggal_sewa', 'ASC')->get();
    // dd($cek);
    return view('sonya')
    ->with('cek', $cek)
    ->with('unit', $unit)
    ->with('hari', $hari)
    ->with('tanggal', $tanggal);
})->name('sonya');

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
Route::any('/home', 'HomeController@index')->name('home');
Route::post('/home/new_order', 'HomeController@store')->name('store');
Route::put('/home/order/batalkan/{id}', 'HomeController@batal')->name('userbatal');
Route::put('/home/order/pembayaran/{id}', 'HomeController@pembayaran')->name('userpembayaran');
Route::put('/home/order/pelunasan/{id}', 'HomeController@pelunasan')->name('userpelunasan');
Route::put('/home/order/selesai/{id}', 'HomeController@selesai')->name('userselesai');
Route::get('/home/order/nota/{id}', 'HomeController@nota')->name('notauser');
Route::get('/home/order/archive/', 'HomeController@archive')->name('archive');
Route::group(['middleware' => ['auth','admin']], function() {
    // Route::get('/dashboard', function() {
    //     return view('dashboard');
    // });
    // Route::any('/dashboard', 'Admin\DashboardController@index')->name('dashboard');
    Route::any('/dashboard', 'Admin\DashboardController@index')->name('dashboard');
    //useredit
    Route::put('/dashboard/user/edit/update/{id}', 'Admin\DashboardController@editupdate')->name('editupdate');
    //userdelete
    Route::get('/dashboard/user/delete/{id}/', 'Admin\DashboardController@userdelete')->name('userdelete');
    //-> old
    Route::get('/dashboard/order/delete/{id}/', 'Admin\DashboardController@orderdelete')->name('orderdelete'); //DANGER!
    //verifyorder-old
    Route::put('/dashboard/order/proses/{id}', 'Admin\DashboardController@proses')->name('proses');
    //verifyorder-new
    Route::put('/dashboard/order/proses/new/{id}', 'Admin\DashboardController@konfirmasiorder')->name('konfirmasiorder');
    Route::put('/dashboard/order/proses/dp/{id}', 'Admin\DashboardController@konfirmasidp')->name('konfirmasidp');
    Route::put('/dashboard/order/proses/jaminan/{id}', 'Admin\DashboardController@konfirmasijaminan')->name('konfirmasijaminan');
    Route::put('/dashboard/order/proses/batal/{id}', 'Admin\DashboardController@batal')->name('batal');
    Route::put('/dashboard/order/proses/pembatalan/{id}', 'Admin\DashboardController@konfirmasipembatalan')->name('konfirmasipembatalan');
    Route::put('/dashboard/order/proses/delete/{id}', 'Admin\DashboardController@hapusorder')->name('hapusorder');
    Route::put('/dashboard/order/proses/selesai/{id}', 'Admin\DashboardController@orderselesai')->name('orderselesai');
    Route::get('/dashboard/order/nota/{id}', 'Admin\DashboardController@nota')->name('nota');

    Route::get('/dashboard/order/rollback/dp/{id}', 'Admin\DashboardController@rollbackdp')->name('rollbackdp');
    Route::get('/dashboard/order/rollback/pelunasan/{id}', 'Admin\DashboardController@rollbackpelunasan')->name('rollbackpelunasan');
    //ajax
});
