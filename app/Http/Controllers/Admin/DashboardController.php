<?php

namespace App\Http\Controllers\Admin;
use App\User;
use App\Order;
use Carbon\Carbon;
use File;
use PDF;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
class DashboardController extends Controller
{

    public function index()
    {
        //where order
        $semuaorder_data = Order::orderBy('tanggal_sewa', 'ASC')->paginate(10);
        $konfirmasiorder_data = Order::where('status','=','0')->orderBy('tanggal_sewa', 'ASC')->get();
        $konfirmasidp_data = Order::where('status','=','2')->orderBy('tanggal_sewa', 'ASC')->get();
        $konfirmasijaminan_data = Order::where('status','=','4')->orderBy('tanggal_sewa', 'ASC')->get();
        $konfirmasipembatalan_data = Order::where('status','=','98')->orderBy('tanggal_sewa', 'ASC')->get();
        $sedangberjalan_data = Order::where('status','=','5')->orderBy('tanggal_sewa', 'ASC')->get();
        $pesanandibatalkan_data = Order::where('status','=','99')->orderBy('tanggal_sewa', 'ASC')->get();
        $selesai_data = Order::where('status', '=', '6')->orderBy('tanggal_sewa', 'ASC')->get();
        //where user
        $user_data = User::all();
        $admin_data = User::where('usertype','=','admin')->get();
        //count order
        $semuaorder_count = Order::count();
        $konfirmasiorder_count = Order::where('status', '=', '0')->count();
        $konfirmasidp_count = Order::where('status', '=', '2')->count();
        $konfirmasijaminan_count = Order::where('status', '=', '4')->count();
        $konfirmasipembatalan_count = Order::where('status', '=', '98')->count();
        $sedangberjalan_count = Order::where('status', '=', '5')->count();
        $pesanandibatalkan_count = Order::where('status', '=', '99')->count();
        $selesai_count = Order::where('status', '=', '6')->count();
        //count user
        return view('dashboard')
                    //where
                    ->with('semuaorder_data', $semuaorder_data)
                    ->with('konfirmasiorder_data', $konfirmasiorder_data)
                    ->with('konfirmasidp_data', $konfirmasidp_data)
                    ->with('konfirmasijaminan_data', $konfirmasijaminan_data)
                    ->with('konfirmasipembatalan_data', $konfirmasipembatalan_data)
                    ->with('sedangberjalan_data', $sedangberjalan_data)
                    ->with('pesanandibatalkan_data', $pesanandibatalkan_data)
                    ->with('selesai_data', $selesai_data)
                    ->with('user_data', $user_data)
                    ->with('admin_data', $admin_data)
                    //count
                    ->with('semuaorder_count', $semuaorder_count)
                    ->with('konfirmasiorder_count', $konfirmasiorder_count)
                    ->with('konfirmasidp_count', $konfirmasidp_count)
                    ->with('konfirmasijaminan_count', $konfirmasijaminan_count)
                    ->with('konfirmasipembatalan_count', $konfirmasipembatalan_count)
                    ->with('sedangberjalan_count', $sedangberjalan_count)
                    ->with('pesanandibatalkan_count', $pesanandibatalkan_count)
                    ->with('selesai_count', $selesai_count);
    }
    public function nota(Request $request, $id)
    {
        $orders = Order::find($id);
        $kode = $orders -> kode;
        $pdf = PDF::loadview('pdf',['orders'=>$orders]);
        return $pdf->stream($kode.'.pdf');
    }
    //edit user
    public function editupdate(Request $request, $id)
    {
      $this->validate($request, [
        'name' => 'required', 'string', 'max:255', 'unique:users',
        'phone' => 'required', 'number', 'min:10', 'max:12', 'unique:users',
        'email' => 'required', 'string', 'email', 'max:255', 'unique:users',
        'usertype' => 'required',
      ]);
        $users = User::find($id);
        $users -> name = $request->input('name');
        $users -> phone = $request->input('phone');
        $users -> email = $request->input('email');
        $users -> usertype = $request->input('usertype');
        $users -> update();
        return redirect()->back()->with('status','Data updated.');
    }
    public function userdelete($id)
    {
        $users = User::findOrFail($id);
        $users -> delete();
        return redirect()->back()->with('status', 'User Deleted.');
    }
    public function orderdelete($id)
    {
        $orders = Order::findOrFail($id);
                // hapus file
        File::delete('dp_upload/'.$orders->dp_upload);
        File::delete('upload_jaminan/'.$orders->upload_jaminan);
        $orders -> delete();
        return redirect()->back()->with('status', 'Order Deleted.');
    }

    public function rollbackdp($id)
    {
        $orders = Order::findOrFail($id);
                // hapus file
        File::delete('dp_upload/'.$orders->dp_upload);
        $orders -> status = '1';
        $orders -> update();
        return redirect()->back()->with('status', 'DP rollback.');
    }

    public function rollbackpelunasan($id)
    {
        $orders = Order::findOrFail($id);
                // hapus file
        File::delete('upload_jaminan/'.$orders->upload_jaminan);
        $orders -> status = '3';
        $orders -> update();
        return redirect()->back()->with('status', 'Pelunasan Rollback.');
    }

    public function proses(Request $request, $id)
    {
        $orders = Order::find($id);
         if ($orders -> paket == '1') {
          $orders -> harga_unit = '9000';
         }
         if ($orders -> paket == '2') {
          $orders -> harga_unit = '5000';
         }
        // $orders -> harga_unit = $request->input('harga_unit');
        $tanggalkembali = $orders->tanggal_sewa->addDays($orders->jumlah_hari);
        $orders -> tanggal_kembali = $tanggalkembali;
        $total = (($orders -> harga_unit)*($orders -> jumlah_unit)*($orders -> jumlah_hari));
        $orders -> total_pembayaran = $total;
        $orders -> dp = (( 50 / 100) * $total);
        $orders -> pelunasan = (($orders -> total_pembayaran)-($orders -> dp));
        $orders -> status = $request->input('status_baru');
        $orders -> update();
        return redirect()->back()->with('status','Data updated.');
    }
    public function konfirmasiorder(Request $request, $id)
    {
      $orders = Order::find($id);
      $total = (($orders -> harga_unit)*($orders -> jumlah_unit)*($orders -> jumlah_hari));
      $orders -> dp = (( 50 / 100) * $total);
      $orders -> status = '1';
      $orders -> update();
      return redirect()->back()->with('status','Data updated.');
    }
    public function konfirmasidp(Request $request, $id)
    {
      $orders = Order::find($id);
      $orders -> pelunasan = (($orders -> total_pembayaran)-($orders -> dp));
      $orders -> status = '3';
      $orders -> update();
      return redirect()->back()->with('status','DP dikonfirmasi.');
    }
    public function konfirmasijaminan(Request $request, $id)
    {
      $orders = Order::find($id);
      $orders -> status = '5';
      $orders -> update();
      return redirect()->back()->with('status','Jaminan dikonfirmasi.');
    }
    public function batal(Request $request, $id)
    {
        $orders = Order::find($id);
        $orders -> status = '98';
        $orders -> update();
        return redirect()->back()->with('status','Order dibatalkan.');
    }
    public function konfirmasipembatalan(Request $request, $id)
    {
        $orders = Order::find($id);
        $orders -> status = '99';
        $orders -> update();
        return redirect()->back()->with('status','Order dibatalkan.');
    }
    public function hapusorder(Request $request, $id)
    {
      $orders = Order::findOrFail($id);
              // hapus file
      File::delete('dp_upload/'.$orders->dp_upload);
      File::delete('upload_jaminan/'.$orders->upload_jaminan);
      $orders -> delete();
      return redirect()->back()->with('status', 'Order Deleted.');
    }
    public function orderselesai(Request $request, $id)
    {
      $orders = Order::find($id);
      $orders -> status = '6';
      $orders -> update();
      return redirect()->back()->with('status','Order selesai.');
    }
}
