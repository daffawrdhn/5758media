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

Route::post('/snya', 'Controller@tanggal');

Route::get('/a', function () {
    $totalorders = Order::count();
    $totalmediapartners = Order::where('paket','=','2')->count();
    $averageunits = Order::avg('jumlah_unit');

    $start = new Carbon('2012-09-01 00:00:00');
    $now = Carbon::now();
    $days = $start->diffInDays($now);

    return view('a')
    ->with('totalorders', $totalorders)
    ->with('totalmediapartners', $totalmediapartners)
    ->with('averageunits', $averageunits)
    ->with('days', $days);
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

    Route::get('/dashboard/order/rollback/dp/{id}', 'Admin\DashboardController@rollbackdp');
    Route::get('/dashboard/order/rollback/pelunasan/{id}', 'Admin\DashboardController@rollbackpelunasan');
    //ajax
});
