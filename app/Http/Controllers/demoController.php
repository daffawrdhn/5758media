<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
use App\Order;
use Carbon\Carbon;
use File;
use PDF;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Redirect,Response;

class demoController extends Controller
{
  function index(Request $request)
  {
    $users = Order::all()->toJson();
    return Response::json($users);
  }
}
