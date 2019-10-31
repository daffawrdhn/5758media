<?php

namespace App\Http\Controllers;

use App\User;
use App\Order;
use Auth;
use File;
use Carbon;
use PDF;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
      $users = User::all();
      $orders = Order::where('nama', '=', Auth::user()->name)->get();
      return view('home')->with('users', $users)->with('orders', $orders);
    }
    public function index_baru()
    {
      $orders = Order::where('idu', '=', Auth::user()->id)->get();
      $orderbaru = Order::where('idu', '=', Auth::user()->id)->where('status', '=', '0')->get();
      $dp = Order::where('idu', '=', Auth::user()->id)->where('status', '=', '1')->get();
      $jaminan = Order::where('idu', '=', Auth::user()->id)->where('status', '=', '3')->get();
      $sedangberjalan = Order::where('idu', '=', Auth::user()->id)->where('status', '=', '5')->get();
      $selesai = Order::where('idu', '=', Auth::user()->id)->where('status', '=', '6')->get();
      $pembatalan = Order::where('idu', '=', Auth::user()->id)->where('status', '=', '98')->get();
      $dibatalkan = Order::where('idu', '=', Auth::user()->id)->where('status', '=', '99')->get();
      $orders_count = Order::where('idu', '=', Auth::user()->id)->count();
      $orderbaru_count = Order::where('idu', '=', Auth::user()->id)->where('status', '=', '0')->count();
      $dp_count = Order::where('idu', '=', Auth::user()->id)->where('status', '=', '1')->count();
      $jaminan_count = Order::where('idu', '=', Auth::user()->id)->where('status', '=', '3')->count();
      $sedangberjalan_count = Order::where('idu', '=', Auth::user()->id)->where('status', '=', '5')->count();
      $selesai_count = Order::where('idu', '=', Auth::user()->id)->where('status', '=', '6')->count();
      $pembatalan_count = Order::where('idu', '=', Auth::user()->id)->where('status', '=', '98')->count();
      $dibatalkan_count = Order::where('idu', '=', Auth::user()->id)->where('status', '=', '99')->count();
      return view('home_baru')
              ->with('orders', $orders)
              ->with('orderbaru', $orderbaru)
              ->with('dp', $dp)
              ->with('jaminan', $jaminan)
              ->with('sedangberjalan', $sedangberjalan)
              ->with('selesai', $selesai)
              ->with('pembatalan', $pembatalan)
              ->with('dibatalkan', $dibatalkan)
              ->with('orders_count', $orders_count)
              ->with('orderbaru_count', $orderbaru_count)
              ->with('dp_count', $dp_count)
              ->with('jaminan_count', $jaminan_count)
              ->with('sedangberjalan_count', $sedangberjalan_count)
              ->with('selesai_count', $selesai_count)
              ->with('pembatalan_count', $pembatalan_count)
              ->with('dibatalkan_count', $dibatalkan_count);
    }
    public function nota(Request $request, $id)
    {
        $orders = Order::find($id);
        $kode = $orders -> kode;
        $pdf = PDF::loadview('pdf',['orders'=>$orders]);
        return $pdf->stream($kode.'.pdf');
    }
    public function archive()
    {
        $archive = Order::where('idu', '=', Auth::user()->id)->get();
        $pdf = PDF::loadview('archive',['archive'=>$archive]);
        return $pdf->stream('archive.pdf');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
          'alamat' => 'required',
          'acara' => 'required',
          'paket' => 'required',
          'tanggal_sewa' => 'required',
          'jumlah_hari' => 'required',
          'jumlah_unit' => 'required',
        ]);
        if ($request -> paket == '1') {
         $harga = '9000';
        }
        if ($request -> paket == '2') {
         $harga = '5000';
        }
        $kode = Str::random(5);
        $hari = $request->input('jumlah_hari');
        $tk = Carbon\Carbon::parse($request->input('tanggal_sewa'))->addDays($hari);
        $total = ((($request->jumlah_hari)*($request->jumlah_unit))*$harga);
        $depeh = (( 50 / 100 ) * $total);
        Order::create([
        'idu' => Auth::user()->id,
    		'nama' => $request->nama,
        'no_hp' => $request->no_hp,
    		'alamat' => $request->alamat,
        'acara' => $request->acara,
        'paket' => $request->paket,
        'harga_unit' => $harga,
        'tanggal_sewa' => $request->tanggal_sewa,
        'jumlah_hari' => $request->jumlah_hari,
        'jumlah_unit' => $request->jumlah_unit,
        'tanggal_kembali' => Carbon\Carbon::parse($request->input('tanggal_sewa'))->addDays($hari),
        'total_pembayaran' => $total,
        'status' => '0',
        'kode' => $kode,
    	]);
      // $tanggalkembali = $orders->tanggal_sewa->addDays($orders->jumlah_hari);
      // $orders -> tanggal_kembali = $tanggalkembali;
    	return redirect()->back()->with('status', 'Order ditambahkan.');
    }
    public function batal(Request $request, $id)
    {
        $orders = Order::find($id);
        $orders -> status = '98';
        $orders -> update();
        return redirect()->back()->with('status','Data updated.');
    }
    public function pembayaran(Request $request, $id)
    {
        $this->validate($request, [
          'dp_upload' => 'required|file|image|mimes:jpeg,png,gif,webp|max:2048',
        ]);
        $orders = Order::find($id);
            // menyimpan data file yang diupload ke variabel $file
    		$file = $orders -> dp_upload = $request->file('dp_upload');
    		$nama_file = Auth::user()->name."_".Carbon::now()."_".$file->getClientOriginalName();
          	        // isi dengan nama folder tempat kemana file diupload
        $test = Carbon::now()->toDateTimeString();
        $orders -> dp_upload = $nama_file;
        // $orders -> dp = $request->input('dp');
        $orders -> status = '2';
        $orders -> tanggal_dp = $test;
        $orders -> update();
        $tujuan_upload = 'dp_upload';
        $file->move($tujuan_upload,$nama_file);
        return redirect()->back()->with('status', 'Pembayaran terkirim');
    }
    public function pelunasan(Request $request, $id)
    {
        $this->validate($request, [
          'jenis_jaminan' => 'required',
          'upload_jaminan' => 'required|file|image|mimes:jpeg,png,gif,webp|max:2048',
        ]);
        $orders = Order::find($id);
            // menyimpan data file yang diupload ke variabel $file
        $file = $orders -> upload_jaminan = $request->file('upload_jaminan');
        $nama_file = Auth::user()->name."_".Carbon::now()."_".$file->getClientOriginalName();
                    // isi dengan nama folder tempat kemana file diupload
        $orders -> jenis_jaminan = $request->input('jenis_jaminan');
        $now = Carbon::now()->toDateTimeString();
        $orders -> upload_jaminan = $nama_file;
        $orders -> status = '4';
        $orders -> tanggal_pelunasan = $now;
        $orders -> update();
        $tujuan_upload = 'upload_jaminan';
        $file->move($tujuan_upload,$nama_file);
        return redirect()->back()->with('status', 'Jaminan & pelunasan terkirim');
    }
    public function selesai(Request $request, $id)
    {
      $orders = Order::find($id);
      $orders -> status = '6';
      $orders -> update();
      return redirect()->back()->with('status','Order selesai.');
    }
}
