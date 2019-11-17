<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\User;
use App\Order;
use Carbon\Carbon;
use File;
use PDF;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function tanggal(Request $request)
    {
      $tanggal = $request->input('tanggal');
      $hari = $request->input('hari');
      $unit = $request->input('unit');
      $cek = Order::whereBetween('tanggal_sewa', [Carbon::parse($tanggal), Carbon::parse($tanggal)->addDays($hari)])->get();
      return view('sonya')->with('cek', $cek);
    }
}
