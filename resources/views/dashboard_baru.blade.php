
@extends('layouts.navbar_admin')

@section('content')
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-9">

              @if (session('status'))
                  <div class="alert alert-success" role="alert">
                      {{ session('status') }}
                  </div>
              @endif


          <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample1">
            <div class="card">


              <div class="card-header bg-white">
                <ul class="nav nav-pills" id="myTab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active rounded" id="semuaorder-tab" data-toggle="tab" href="#semuaorder" role="tab" aria-controls="semuaorder" aria-selected="true">Semua order</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link rounded" id="konfirmasiorder-tab" data-toggle="tab" href="#konfirmasiorder" role="tab" aria-controls="konfirmasiorder" aria-selected="false">Order baru</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link rounded" id="konfirmasidp-tab" data-toggle="tab" href="#konfirmasidp" role="tab" aria-controls="konfirmasidp" aria-selected="false">DP</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link rounded" id="konfirmasijaminan-tab" data-toggle="tab" href="#konfirmasijaminan" role="tab" aria-controls="konfirmasijaminan" aria-selected="false">Jaminan</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link rounded" id="sedangberjalan-tab" data-toggle="tab" href="#sedangberjalan" role="tab" aria-controls="sedangberjalan" aria-selected="false">Sedang berjalan</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link rounded" id="konfirmasipembatalan-tab" data-toggle="tab" href="#konfirmasipembatalan" role="tab" aria-controls="konfirmasipembatalan" aria-selected="false">Konfirmasi pembatalan</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link rounded" id="pesanandibatalkan-tab" data-toggle="tab" href="#pesanandibatalkan" role="tab" aria-controls="pesanandibatalkan" aria-selected="false">Order dibatalkan</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link rounded" id="selesai-tab" data-toggle="tab" href="#selesai" role="tab" aria-controls="selesai" aria-selected="false">Selesai</a>
                  </li>
                </ul>
              </div>


                <div class="card-body">
                  <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="semuaorder" role="tabpanel" aria-labelledby="semuaorder-tab">


                    <div class="card" style="weight: auto;">
                      <div class="card-body pt-2 pb-2 align-self-center">
                        {{ $semuaorder_data->links() }}
                      </div>
                    </div>

                    <br>
                    @foreach ($semuaorder_data as $o)
                      <div class="card shadow-sm">
                        <div class="card-header bg-white">
                          Tanggal sewa : {{ $o -> tanggal_sewa -> toFormattedDateString() }}
                        </div>
                        <div class="card-body pt-2 pb-2 border-bottom">
                          <div class="row">
                            <div class="col-5 border-right">
                              Peminjam
                              <h1 data-toggle="tooltip" data-placement="top" title="Phone : {{ $o -> no_hp }}">{{ $o -> nama }}</h1>
                              {{ $o -> acara }}, {{ $o -> alamat }}
                            </div>
                            <div class="col-4 border-right">
                              Status
                              @if($o->status =='0')
                                      <h3>Menunggu di proses</h3>
                                @elseif($o->status =='1')
                                      <h3>Proses pembayaran</h3>
                                @elseif($o->status =='2')
                                      <h3>Pembayaran di konfirmasi penyewa</h3>
                                @elseif($o->status =='3')
                                      <h3>Proses jaminan</h3>
                                @elseif($o->status =='4')
                                      <h3>Jaminan di konfirmasi penyewa</h3>
                                @elseif($o->status =='5')
                                      <h3>Sewa berjalan</h3>
                                @elseif($o->status =='6')
                                      <h3>Sewa selesai</h3>
                                @elseif($o->status =='98')
                                      <h3>Proses pembatalan order</h3>
                                @elseif($o->status =='99')
                                      <h3>Pesanan dibatalkan</h3>
                                @else
                                      <h3>ERROR</h3>
                              @endif
                            </div>
                            <div class="col-3">
                              Total biaya sewa
                              <h3>Rp {{ $o -> total_pembayaran }}</h3>
                              {{ $o -> jumlah_unit }} Unit, {{ $o -> jumlah_hari }} hari.
                            </div>
                          </div>
                        </div>
                        <div class="card-body pt-2 pb-2">
                          <div class="row">
                            <div class="col-6 border-right">
                              ({{$o -> id}}) Code
                              <h1 class="text-monospace">{{ $o -> kode }}</h1>
                            </div>
                            <div class="col-3">
                              Paket
                              @if( $o -> paket =='1')
                                      <h3>Normal</h3>
                                @elseif( $o -> paket =='2')
                                      <h3>Media Partner</h3>
                                @else
                                      <h3>ERROR</h3>
                              @endif
                              Rp {{$o -> harga_unit}} / Unit / 24Jam
                            </div>
                            <div class="col-3 text-center align-self-center">
                              <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Menu
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                  @if( $o -> status =='0')
                                          <button class="dropdown-item" type="button" data-toggle="modal" data-target="#konfirmasiorder{{$o->id}}">Konfirmasi order</button>
                                          <button class="dropdown-item" type="button" data-toggle="modal" data-target="#batal{{$o->id}}">Batalkan</button>
                                  @elseif( $o -> status =='2')
                                              <button class="dropdown-item" type="button" data-toggle="modal" data-target="#konfirmasidp{{$o->id}}">Konfirmasi DP</button>
                                              <button class="dropdown-item" type="button" data-toggle="modal" data-target="#batal{{$o->id}}">Batalkan</button>
                                  @elseif( $o -> status =='4')
                                                    <button class="dropdown-item" type="button" data-toggle="modal" data-target="#konfirmasijaminan{{$o->id}}">Konfirmasi jaminan</button>
                                                    <button class="dropdown-item" type="button" data-toggle="modal" data-target="#cekdp{{$o->id}}">Lihat DP</button>
                                                    <button class="dropdown-item" type="button" data-toggle="modal" data-target="#batal{{$o->id}}">Batalkan</button>
                                  @elseif( $o -> status =='5')
                                                          <button class="dropdown-item" type="button" data-toggle="modal" data-target="#selesai{{$o->id}}">Selesai</button>
                                                          <button class="dropdown-item" type="button" data-toggle="modal" data-target="#cekdp{{$o->id}}">Lihat DP</button>
                                                          <button class="dropdown-item" type="button" data-toggle="modal" data-target="#cekjaminan{{$o->id}}">Lihat Jaminan</button>
                                                          <button class="dropdown-item" type="button" data-toggle="modal" data-target="#batal{{$o->id}}">Batalkan</button>
                                  @elseif( $o -> status =='6')
                                                                <button class="dropdown-item" type="button" data-toggle="modal" data-target="#hapusorder{{$o->id}}">Hapus order</button>
                                                                <button class="dropdown-item" type="button" data-toggle="modal" data-target="#cekdp{{$o->id}}">Lihat DP</button>
                                                                <button class="dropdown-item" type="button" data-toggle="modal" data-target="#cekjaminan{{$o->id}}">Lihat Jaminan</button>
                                                                <button class="dropdown-item" type="button" data-toggle="modal" data-target="#batal{{$o->id}}">Batalkan</button>
                                  @elseif( $o -> status =='98')
                                                                      <button class="dropdown-item" type="button" data-toggle="modal" data-target="#konfirmasipembatalan{{$o->id}}">Konfirmasi pembatalan</button>
                                  @elseif( $o -> status =='99')
                                                                          <button class="dropdown-item" type="button" data-toggle="modal" data-target="#hapusorder{{$o->id}}">Hapus order</button>
                                  @else
                                                                              <button class="dropdown-item" type="button" data-toggle="modal" data-target="#batal{{$o->id}}">Batalkan</button>
                                  @endif
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="card-footer bg-white">
                          <div class="row">
                            <div class="col-auto text-center border-right">
                              <a href="/dashboard/order/nota/{{$o->id}}" target="_blank" class="badge badge-primary">Lihat detail order</a>
                            </div>
                            <div class="col-auto">
                              Tanggal kembali : {{Carbon\Carbon::parse($o->tanggal_kembali)->toFormattedDateString()}}
                            </div>
                          </div>
                        </div>
                      </div> <br>

                      <!-- Modal Konfirmasi Order -->
                      <div class="modal fade" id="konfirmasiorder{{$o->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Konfirmasi order : ID {{$o->id}}</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <form method="POST" action="/dashboard/order/proses/new/{{ $o -> id }}">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <p>Apakah anda yakin melakukan konfirmasi order?</p>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-primary pull-right">Konfirmasi</button>
                                </div>

                              </form>
                            </div>
                          </div>
                        </div>
                      </div>

                      <!-- Modal Konfirmasi DP -->
                      <div class="modal fade" id="konfirmasidp{{$o->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Konfirmasi DP : ID {{$o->id}}</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <form method="POST" action="/dashboard/order/proses/dp/{{ $o -> id }}">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}

                                <div class="row">
                                  <div class="col text-center align-self-center">
                                    ({{$o -> id}}) Code : {{$o -> kode}}
                                    <p>Apakah anda yakin melakukan konfirmasi dp pada order ini?</p>
                                  </div>
                                  <div class="col">
                                    <img src="{{ url('/dp_upload/'.$o -> dp_upload) }}" class="img-fluid" alt="Responsive image" data-toggle="modal" data-target="#cekdp{{$o->id}}">
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-primary pull-right">Konfirmasi</button>
                                </div>

                              </form>
                            </div>
                          </div>
                        </div>
                      </div>

                      <!-- Modal Konfirmasi Jaminan -->
                      <div class="modal fade" id="konfirmasijaminan{{$o->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Jaminan : ID {{$o->id}}</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <form method="POST" action="/dashboard/order/proses/jaminan/{{ $o -> id }}">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}

                                <div class="row">
                                  <div class="col text-center align-self-center">
                                    ({{$o -> id}}) Code : {{$o -> kode}}
                                    <p>Apakah anda yakin melakukan konfirmasi jaminan dan pelunasan pada order ini?</p>
                                    Pelunasan : Rp {{$o -> pelunasan}}
                                    <p>Jaminan : {{$o -> jenis_jaminan}}</p>
                                  </div>
                                  <div class="col">
                                    <img src="{{ url('/upload_jaminan/'.$o -> upload_jaminan) }}" class="img-fluid" alt="Responsive image" data-toggle="modal" data-target="#cekjaminan{{$o->id}}">
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-primary pull-right">Konfirmasi</button>
                                </div>

                              </form>
                            </div>
                          </div>
                        </div>
                      </div>

                      <!-- Modal Selesai -->
                      <div class="modal fade" id="selesai{{$o->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Konfirmasi order : ID {{$o->id}}</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <form method="POST" action="/dashboard/order/proses/selesai/{{ $o -> id }}">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <p>Apakah anda yakin menyelesaikan order?</p>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-primary pull-right">Selesai</button>
                                </div>

                              </form>
                            </div>
                          </div>
                        </div>
                      </div>

                      <!-- Modal Hapus Order -->
                      <div class="modal fade" id="hapusorder{{$o->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Konfirmasi order : ID {{$o->id}}</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <form method="POST" action="/dashboard/order/proses/delete/{{ $o -> id }}">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <p>Apakah anda yakin menghapus order?</p>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-danger pull-right">Hapus</button>
                                </div>

                              </form>
                            </div>
                          </div>
                        </div>
                      </div>

                      <!-- Modal Konfirmasi Pembatalan -->
                      <div class="modal fade" id="konfirmasipembatalan{{$o->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Pembatalan order : ID {{$o->id}}</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <form method="POST" action="/dashboard/order/proses/pembatalan/{{ $o -> id }}">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <p>Apakah anda yakin melakukan konfirmasi pembatalan pada order ini ?</p>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-primary pull-right">Konfirmasi</button>
                                </div>

                              </form>
                            </div>
                          </div>
                        </div>
                      </div>

                      <!-- Modal Hapus Order -->
                      <div class="modal fade" id="hapusorder{{$o->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Hapus order : ID {{$o->id}}</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <form method="POST" action="/dashboard/order/proses/delete/{{ $o -> id }}">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <p>Apakah anda yakin menghapus order ini ?</p>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-primary pull-right">Konfirmasi</button>
                                </div>

                              </form>
                            </div>
                          </div>
                        </div>
                      </div>

                      <!-- Modal Hapus Order -->
                      <div class="modal fade" id="batal{{$o->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Batal order : ID {{$o->id}}</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <form method="POST" action="/dashboard/order/proses/batal/{{ $o -> id }}">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <p>Apakah anda yakin membatalkan order ini ?</p>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-primary pull-right">Konfirmasi</button>
                                </div>

                              </form>
                            </div>
                          </div>
                        </div>
                      </div>

                      <!-- Modal Cek DP / Zoom DP -->
                      <div class="modal fade" id="cekdp{{$o->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">DP Photo : ID {{$o->id}}</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <img src="{{ url('/dp_upload/'.$o -> dp_upload) }}" class="img-fluid" alt="Responsive image" data-toggle="modal" data-target="#cekdp{{$o->id}}">
                            </div>
                          </div>
                        </div>
                      </div>

                      <!-- Modal Cek Jaminan / Zoom Jaminan -->
                      <div class="modal fade" id="cekjaminan{{$o->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Jaminan Photo : ID {{$o->id}}</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <img src="{{ url('/upload_jaminan/'.$o -> upload_jaminan) }}" class="img-fluid" alt="Responsive image" data-toggle="modal" data-target="#cekjaminan{{$o->id}}">
                            </div>
                          </div>
                        </div>
                      </div>
                    @endforeach

                    </div>
                    <div class="tab-pane fade" id="konfirmasiorder" role="tabpanel" aria-labelledby="konfirmasiorder-tab">
                      @foreach ($konfirmasiorder_data as $o)
                        <div class="card shadow-sm">
                          <div class="card-header bg-white">
                            Tanggal sewa : {{ $o -> tanggal_sewa -> toFormattedDateString() }}
                          </div>
                          <div class="card-body pt-2 pb-2 border-bottom">
                            <div class="row">
                              <div class="col-5 border-right">
                                Peminjam
                                <h1 data-toggle="tooltip" data-placement="top" title="Phone : {{ $o -> no_hp }}">{{ $o -> nama }}</h1>
                                {{ $o -> acara }}, {{ $o -> alamat }}
                              </div>
                              <div class="col-4 border-right">
                                Status
                                @if($o->status =='0')
                                        <h3>Menunggu di proses</h3>
                                  @elseif($o->status =='1')
                                        <h3>Proses pembayaran</h3>
                                  @elseif($o->status =='2')
                                        <h3>Pembayaran di konfirmasi penyewa</h3>
                                  @elseif($o->status =='3')
                                        <h3>Proses jaminan</h3>
                                  @elseif($o->status =='4')
                                        <h3>Jaminan di konfirmasi penyewa</h3>
                                  @elseif($o->status =='5')
                                        <h3>Sewa berjalan</h3>
                                  @elseif($o->status =='6')
                                        <h3>Sewa selesai</h3>
                                  @elseif($o->status =='98')
                                        <h3>Proses pembatalan order</h3>
                                  @elseif($o->status =='99')
                                        <h3>Pesanan dibatalkan</h3>
                                  @else
                                        <h3>ERROR</h3>
                                @endif
                              </div>
                              <div class="col-3">
                                Total biaya sewa
                                <h3>Rp {{ $o -> total_pembayaran }}</h3>
                                {{ $o -> jumlah_unit }} Unit, {{ $o -> jumlah_hari }} hari.
                              </div>
                            </div>
                          </div>
                          <div class="card-body pt-2 pb-2">
                            <div class="row">
                              <div class="col-6 border-right">
                                ({{$o -> id}}) Code
                                <h1 class="text-monospace">{{ $o -> kode }}</h1>
                              </div>
                              <div class="col-3">
                                Paket
                                @if( $o -> paket =='1')
                                        <h3>Normal</h3>
                                  @elseif( $o -> paket =='2')
                                        <h3>Media Partner</h3>
                                  @else
                                        <h3>ERROR</h3>
                                @endif
                                Rp {{$o -> harga_unit}} / Unit / 24Jam
                              </div>
                              <div class="col-3 text-center align-self-center">
                                <div class="dropdown">
                                  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Menu
                                  </button>
                                  <div class="dropdown-menu" aria-labelledby="dropdownMenu2">

                                            <button class="dropdown-item" type="button" data-toggle="modal" data-target="#konfirmasiorder2{{$o->id}}">Konfirmasi order</button>
                                            <button class="dropdown-item" type="button" data-toggle="modal" data-target="#batal2{{$o->id}}">Batalkan</button>

                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="card-footer bg-white">
                            <div class="row">
                              <div class="col-auto text-center border-right">
                                <a href="/dashboard/order/nota/{{$o->id}}" target="_blank" class="badge badge-primary">Lihat detail order</a>
                              </div>
                              <div class="col-auto">
                                Tanggal kembali : {{Carbon\Carbon::parse($o->tanggal_kembali)->toFormattedDateString()}}
                              </div>
                            </div>
                          </div>
                        </div> <br>

                        <!-- Modal Konfirmasi Order -->
                        <div class="modal fade" id="konfirmasiorder2{{$o->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi order : ID {{$o->id}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <form method="POST" action="/dashboard/order/proses/new/{{ $o -> id }}">
                                  {{ csrf_field() }}
                                  {{ method_field('PUT') }}
                                  <p>Apakah anda yakin melakukan konfirmasi order?</p>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary pull-right">Konfirmasi</button>
                                  </div>

                                </form>
                              </div>
                            </div>
                          </div>
                        </div>

                        <!-- Modal batal Order -->
                        <div class="modal fade" id="batal2{{$o->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Batal order : ID {{$o->id}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <form method="POST" action="/dashboard/order/proses/batal/{{ $o -> id }}">
                                  {{ csrf_field() }}
                                  {{ method_field('PUT') }}
                                  <p>Apakah anda yakin membatalkan order ini ?</p>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary pull-right">Konfirmasi</button>
                                  </div>

                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                      @endforeach
                    </div>
                    <div class="tab-pane fade" id="konfirmasidp" role="tabpanel" aria-labelledby="konfirmasidp-tab">
                      @foreach ($konfirmasidp_data as $o)
                        <div class="card shadow-sm">
                          <div class="card-header bg-white">
                            Tanggal sewa : {{ $o -> tanggal_sewa -> toFormattedDateString() }}
                          </div>
                          <div class="card-body pt-2 pb-2 border-bottom">
                            <div class="row">
                              <div class="col-5 border-right">
                                Peminjam
                                <h1 data-toggle="tooltip" data-placement="top" title="Phone : {{ $o -> no_hp }}">{{ $o -> nama }}</h1>
                                {{ $o -> acara }}, {{ $o -> alamat }}
                              </div>
                              <div class="col-4 border-right">
                                Status
                                @if($o->status =='0')
                                        <h3>Menunggu di proses</h3>
                                  @elseif($o->status =='1')
                                        <h3>Proses pembayaran</h3>
                                  @elseif($o->status =='2')
                                        <h3>Pembayaran di konfirmasi penyewa</h3>
                                  @elseif($o->status =='3')
                                        <h3>Proses jaminan</h3>
                                  @elseif($o->status =='4')
                                        <h3>Jaminan di konfirmasi penyewa</h3>
                                  @elseif($o->status =='5')
                                        <h3>Sewa berjalan</h3>
                                  @elseif($o->status =='6')
                                        <h3>Sewa selesai</h3>
                                  @elseif($o->status =='98')
                                        <h3>Proses pembatalan order</h3>
                                  @elseif($o->status =='99')
                                        <h3>Pesanan dibatalkan</h3>
                                  @else
                                        <h3>ERROR</h3>
                                @endif
                              </div>
                              <div class="col-3">
                                Total biaya sewa
                                <h3>Rp {{ $o -> total_pembayaran }}</h3>
                                {{ $o -> jumlah_unit }} Unit, {{ $o -> jumlah_hari }} hari.
                              </div>
                            </div>
                          </div>
                          <div class="card-body pt-2 pb-2">
                            <div class="row">
                              <div class="col-6 border-right">
                                ({{$o -> id}}) Code
                                <h1 class="text-monospace">{{ $o -> kode }}</h1>
                              </div>
                              <div class="col-3">
                                Paket
                                @if( $o -> paket =='1')
                                        <h3>Normal</h3>
                                  @elseif( $o -> paket =='2')
                                        <h3>Media Partner</h3>
                                  @else
                                        <h3>ERROR</h3>
                                @endif
                                Rp {{$o -> harga_unit}} / Unit / 24Jam
                              </div>
                              <div class="col-3 text-center align-self-center">
                                <div class="dropdown">
                                  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Menu
                                  </button>
                                  <div class="dropdown-menu" aria-labelledby="dropdownMenu2">

                                                <button class="dropdown-item" type="button" data-toggle="modal" data-target="#konfirmasidp2{{$o->id}}">Konfirmasi DP</button>
                                                <button class="dropdown-item" type="button" data-toggle="modal" data-target="#batal2{{$o->id}}">Batalkan</button>

                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="card-footer bg-white">
                            <div class="row">
                              <div class="col-auto text-center border-right">
                                <a href="/dashboard/order/nota/{{$o->id}}" target="_blank" class="badge badge-primary">Lihat detail order</a>
                              </div>
                              <div class="col-auto">
                                Tanggal kembali : {{Carbon\Carbon::parse($o->tanggal_kembali)->toFormattedDateString()}}
                              </div>
                            </div>
                          </div>
                        </div> <br>



                        <!-- Modal Konfirmasi DP -->
                        <div class="modal fade" id="konfirmasidp2{{$o->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi DP : ID {{$o->id}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <form method="POST" action="/dashboard/order/proses/dp/{{ $o -> id }}">
                                  {{ csrf_field() }}
                                  {{ method_field('PUT') }}

                                  <div class="row">
                                    <div class="col text-center align-self-center">
                                      ({{$o -> id}}) Code : {{$o -> kode}}
                                      <p>Apakah anda yakin melakukan konfirmasi dp pada order ini?</p>
                                    </div>
                                    <div class="col">
                                      <img src="{{ url('/dp_upload/'.$o -> dp_upload) }}" class="img-fluid" alt="Responsive image" data-toggle="modal" data-target="#cekdp2{{$o->id}}">
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary pull-right">Konfirmasi</button>
                                  </div>

                                </form>
                              </div>
                            </div>
                          </div>
                        </div>

                        <!-- Modal batal Order -->
                        <div class="modal fade" id="batal2{{$o->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Batal order : ID {{$o->id}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <form method="POST" action="/dashboard/order/proses/batal/{{ $o -> id }}">
                                  {{ csrf_field() }}
                                  {{ method_field('PUT') }}
                                  <p>Apakah anda yakin membatalkan order ini ?</p>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary pull-right">Konfirmasi</button>
                                  </div>

                                </form>
                              </div>
                            </div>
                          </div>
                        </div>

                        <!-- Modal Cek DP / Zoom DP -->
                        <div class="modal fade" id="cekdp2{{$o->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">DP Photo : ID {{$o->id}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <img src="{{ url('/dp_upload/'.$o -> dp_upload) }}" class="img-fluid" alt="Responsive image" data-toggle="modal" data-target="#cekdp2{{$o->id}}">
                              </div>
                            </div>
                          </div>
                        </div>
                      @endforeach
                    </div>
                    <div class="tab-pane fade" id="konfirmasijaminan" role="tabpanel" aria-labelledby="konfirmasijaminan-tab">
                      @foreach ($konfirmasijaminan_data as $o)
                        <div class="card shadow-sm">
                          <div class="card-header bg-white">
                            Tanggal sewa : {{ $o -> tanggal_sewa -> toFormattedDateString() }}
                          </div>
                          <div class="card-body pt-2 pb-2 border-bottom">
                            <div class="row">
                              <div class="col-5 border-right">
                                Peminjam
                                <h1 data-toggle="tooltip" data-placement="top" title="Phone : {{ $o -> no_hp }}">{{ $o -> nama }}</h1>
                                {{ $o -> acara }}, {{ $o -> alamat }}
                              </div>
                              <div class="col-4 border-right">
                                Status
                                @if($o->status =='0')
                                        <h3>Menunggu di proses</h3>
                                  @elseif($o->status =='1')
                                        <h3>Proses pembayaran</h3>
                                  @elseif($o->status =='2')
                                        <h3>Pembayaran di konfirmasi penyewa</h3>
                                  @elseif($o->status =='3')
                                        <h3>Proses jaminan</h3>
                                  @elseif($o->status =='4')
                                        <h3>Jaminan di konfirmasi penyewa</h3>
                                  @elseif($o->status =='5')
                                        <h3>Sewa berjalan</h3>
                                  @elseif($o->status =='6')
                                        <h3>Sewa selesai</h3>
                                  @elseif($o->status =='98')
                                        <h3>Proses pembatalan order</h3>
                                  @elseif($o->status =='99')
                                        <h3>Pesanan dibatalkan</h3>
                                  @else
                                        <h3>ERROR</h3>
                                @endif
                              </div>
                              <div class="col-3">
                                Total biaya sewa
                                <h3>Rp {{ $o -> total_pembayaran }}</h3>
                                {{ $o -> jumlah_unit }} Unit, {{ $o -> jumlah_hari }} hari.
                              </div>
                            </div>
                          </div>
                          <div class="card-body pt-2 pb-2">
                            <div class="row">
                              <div class="col-6 border-right">
                                ({{$o -> id}}) Code
                                <h1 class="text-monospace">{{ $o -> kode }}</h1>
                              </div>
                              <div class="col-3">
                                Paket
                                @if( $o -> paket =='1')
                                        <h3>Normal</h3>
                                  @elseif( $o -> paket =='2')
                                        <h3>Media Partner</h3>
                                  @else
                                        <h3>ERROR</h3>
                                @endif
                                Rp {{$o -> harga_unit}} / Unit / 24Jam
                              </div>
                              <div class="col-3 text-center align-self-center">
                                <div class="dropdown">
                                  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Menu
                                  </button>
                                  <div class="dropdown-menu" aria-labelledby="dropdownMenu2">

                                                      <button class="dropdown-item" type="button" data-toggle="modal" data-target="#konfirmasijaminan2{{$o->id}}">Konfirmasi jaminan</button>
                                                      <button class="dropdown-item" type="button" data-toggle="modal" data-target="#cekdp2{{$o->id}}">Lihat DP</button>
                                                      <button class="dropdown-item" type="button" data-toggle="modal" data-target="#batal2{{$o->id}}">Batalkan</button>

                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="card-footer bg-white">
                            <div class="row">
                              <div class="col-auto text-center border-right">
                                <a href="/dashboard/order/nota/{{$o->id}}" target="_blank" class="badge badge-primary">Lihat detail order</a>
                              </div>
                              <div class="col-auto">
                                Tanggal kembali : {{Carbon\Carbon::parse($o->tanggal_kembali)->toFormattedDateString()}}
                              </div>
                            </div>
                          </div>
                        </div> <br>



                        <!-- Modal Konfirmasi Jaminan -->
                        <div class="modal fade" id="konfirmasijaminan2{{$o->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Jaminan : ID {{$o->id}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <form method="POST" action="/dashboard/order/proses/jaminan/{{ $o -> id }}">
                                  {{ csrf_field() }}
                                  {{ method_field('PUT') }}

                                  <div class="row">
                                    <div class="col text-center align-self-center">
                                      ({{$o -> id}}) Code : {{$o -> kode}}
                                      <p>Apakah anda yakin melakukan konfirmasi jaminan dan pelunasan pada order ini?</p>
                                      Pelunasan : Rp {{$o -> pelunasan}}
                                      <p>Jaminan : {{$o -> jenis_jaminan}}</p>
                                    </div>
                                    <div class="col">
                                      <img src="{{ url('/upload_jaminan/'.$o -> upload_jaminan) }}" class="img-fluid" alt="Responsive image" data-toggle="modal" data-target="#cekjaminan2{{$o->id}}">
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary pull-right">Konfirmasi</button>
                                  </div>

                                </form>
                              </div>
                            </div>
                          </div>
                        </div>



                        <!-- Modal batal Order -->
                        <div class="modal fade" id="batal{{$o->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Batal order : ID {{$o->id}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <form method="POST" action="/dashboard/order/proses/batal/{{ $o -> id }}">
                                  {{ csrf_field() }}
                                  {{ method_field('PUT') }}
                                  <p>Apakah anda yakin membatalkan order ini ?</p>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary pull-right">Konfirmasi</button>
                                  </div>

                                </form>
                              </div>
                            </div>
                          </div>
                        </div>

                        <!-- Modal Cek DP / Zoom DP -->
                        <div class="modal fade" id="cekdp2{{$o->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">DP Photo : ID {{$o->id}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <img src="{{ url('/dp_upload/'.$o -> dp_upload) }}" class="img-fluid" alt="Responsive image">
                              </div>
                            </div>
                          </div>
                        </div>

                        <!-- Modal Cek Jaminan / Zoom Jaminan -->
                        <div class="modal fade" id="cekjaminan2{{$o->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Jaminan Photo : ID {{$o->id}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <img src="{{ url('/upload_jaminan/'.$o -> upload_jaminan) }}" class="img-fluid" alt="Responsive image" data-dismiss="modal" aria-label="Close">
                              </div>
                            </div>
                          </div>
                        </div>
                      @endforeach
                    </div>

                    <div class="tab-pane fade" id="konfirmasipembatalan" role="tabpanel" aria-labelledby="konfirmasipembatalan-tab">

                      @foreach ($konfirmasipembatalan_data as $o)
                        <div class="card shadow-sm">
                          <div class="card-header bg-white">
                            Tanggal sewa : {{ $o -> tanggal_sewa -> toFormattedDateString() }}
                          </div>
                          <div class="card-body pt-2 pb-2 border-bottom">
                            <div class="row">
                              <div class="col-5 border-right">
                                Peminjam
                                <h1 data-toggle="tooltip" data-placement="top" title="Phone : {{ $o -> no_hp }}">{{ $o -> nama }}</h1>
                                {{ $o -> acara }}, {{ $o -> alamat }}
                              </div>
                              <div class="col-4 border-right">
                                Status
                                @if($o->status =='0')
                                        <h3>Menunggu di proses</h3>
                                  @elseif($o->status =='1')
                                        <h3>Proses pembayaran</h3>
                                  @elseif($o->status =='2')
                                        <h3>Pembayaran di konfirmasi penyewa</h3>
                                  @elseif($o->status =='3')
                                        <h3>Proses jaminan</h3>
                                  @elseif($o->status =='4')
                                        <h3>Jaminan di konfirmasi penyewa</h3>
                                  @elseif($o->status =='5')
                                        <h3>Sewa berjalan</h3>
                                  @elseif($o->status =='6')
                                        <h3>Sewa selesai</h3>
                                  @elseif($o->status =='98')
                                        <h3>Proses pembatalan order</h3>
                                  @elseif($o->status =='99')
                                        <h3>Pesanan dibatalkan</h3>
                                  @else
                                        <h3>ERROR</h3>
                                @endif
                              </div>
                              <div class="col-3">
                                Total biaya sewa
                                <h3>Rp {{ $o -> total_pembayaran }}</h3>
                                {{ $o -> jumlah_unit }} Unit, {{ $o -> jumlah_hari }} hari.
                              </div>
                            </div>
                          </div>
                          <div class="card-body pt-2 pb-2">
                            <div class="row">
                              <div class="col-6 border-right">
                                ({{$o -> id}}) Code
                                <h1 class="text-monospace">{{ $o -> kode }}</h1>
                              </div>
                              <div class="col-3">
                                Paket
                                @if( $o -> paket =='1')
                                        <h3>Normal</h3>
                                  @elseif( $o -> paket =='2')
                                        <h3>Media Partner</h3>
                                  @else
                                        <h3>ERROR</h3>
                                @endif
                                Rp {{$o -> harga_unit}} / Unit / 24Jam
                              </div>
                              <div class="col-3 text-center align-self-center">
                                <div class="dropdown">
                                  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Menu
                                  </button>
                                  <div class="dropdown-menu" aria-labelledby="dropdownMenu2">

                                                                        <button class="dropdown-item" type="button" data-toggle="modal" data-target="#konfirmasipembatalan2{{$o->id}}">Konfirmasi pembatalan</button>

                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="card-footer bg-white">
                            <div class="row">
                              <div class="col-auto text-center border-right">
                                <a href="/dashboard/order/nota/{{$o->id}}" target="_blank" class="badge badge-primary">Lihat detail order</a>
                              </div>
                              <div class="col-auto">
                                Tanggal kembali : {{Carbon\Carbon::parse($o->tanggal_kembali)->toFormattedDateString()}}
                              </div>
                            </div>
                          </div>
                        </div> <br>

                        <!-- Modal Konfirmasi Pembatalan -->
                        <div class="modal fade" id="konfirmasipembatalan2{{$o->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Pembatalan order : ID {{$o->id}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <form method="POST" action="/dashboard/order/proses/pembatalan/{{ $o -> id }}">
                                  {{ csrf_field() }}
                                  {{ method_field('PUT') }}
                                  <p>Apakah anda yakin melakukan konfirmasi pembatalan pada order ini ?</p>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary pull-right">Konfirmasi</button>
                                  </div>

                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                      @endforeach

                    </div>
                    <div class="tab-pane fade" id="sedangberjalan" role="tabpanel" aria-labelledby="sedangberjalan-tab">
                      @foreach ($sedangberjalan_data as $o)
                        <div class="card shadow-sm">
                          <div class="card-header bg-white">
                            Tanggal sewa : {{ $o -> tanggal_sewa -> toFormattedDateString() }}
                          </div>
                          <div class="card-body pt-2 pb-2 border-bottom">
                            <div class="row">
                              <div class="col-5 border-right">
                                Peminjam
                                <h1 data-toggle="tooltip" data-placement="top" title="Phone : {{ $o -> no_hp }}">{{ $o -> nama }}</h1>
                                {{ $o -> acara }}, {{ $o -> alamat }}
                              </div>
                              <div class="col-4 border-right">
                                Status
                                @if($o->status =='0')
                                        <h3>Menunggu di proses</h3>
                                  @elseif($o->status =='1')
                                        <h3>Proses pembayaran</h3>
                                  @elseif($o->status =='2')
                                        <h3>Pembayaran di konfirmasi penyewa</h3>
                                  @elseif($o->status =='3')
                                        <h3>Proses jaminan</h3>
                                  @elseif($o->status =='4')
                                        <h3>Jaminan di konfirmasi penyewa</h3>
                                  @elseif($o->status =='5')
                                        <h3>Sewa berjalan</h3>
                                  @elseif($o->status =='6')
                                        <h3>Sewa selesai</h3>
                                  @elseif($o->status =='98')
                                        <h3>Proses pembatalan order</h3>
                                  @elseif($o->status =='99')
                                        <h3>Pesanan dibatalkan</h3>
                                  @else
                                        <h3>ERROR</h3>
                                @endif
                              </div>
                              <div class="col-3">
                                Total biaya sewa
                                <h3>Rp {{ $o -> total_pembayaran }}</h3>
                                {{ $o -> jumlah_unit }} Unit, {{ $o -> jumlah_hari }} hari.
                              </div>
                            </div>
                          </div>
                          <div class="card-body pt-2 pb-2">
                            <div class="row">
                              <div class="col-6 border-right">
                                ({{$o -> id}}) Code
                                <h1 class="text-monospace">{{ $o -> kode }}</h1>
                              </div>
                              <div class="col-3">
                                Paket
                                @if( $o -> paket =='1')
                                        <h3>Normal</h3>
                                  @elseif( $o -> paket =='2')
                                        <h3>Media Partner</h3>
                                  @else
                                        <h3>ERROR</h3>
                                @endif
                                Rp {{$o -> harga_unit}} / Unit / 24Jam
                              </div>
                              <div class="col-3 text-center align-self-center">
                                <div class="dropdown">
                                  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Menu
                                  </button>
                                  <div class="dropdown-menu" aria-labelledby="dropdownMenu2">

                                                            <button class="dropdown-item" type="button" data-toggle="modal" data-target="#selesai2{{$o->id}}">Selesai</button>
                                                            <button class="dropdown-item" type="button" data-toggle="modal" data-target="#cekdp2{{$o->id}}">Lihat DP</button>
                                                            <button class="dropdown-item" type="button" data-toggle="modal" data-target="#cekjaminan2{{$o->id}}">Lihat Jaminan</button>

                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="card-footer bg-white">
                            <div class="row">
                              <div class="col-auto text-center border-right">
                                <a href="/dashboard/order/nota/{{$o->id}}" target="_blank" class="badge badge-primary">Lihat detail order</a>
                              </div>
                              <div class="col-auto">
                                Tanggal kembali : {{Carbon\Carbon::parse($o->tanggal_kembali)->toFormattedDateString()}}
                              </div>
                            </div>
                          </div>
                        </div> <br>


                        <!-- Modal Selesai -->
                        <div class="modal fade" id="selesai2{{$o->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi order : ID {{$o->id}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <form method="POST" action="/dashboard/order/proses/selesai/{{ $o -> id }}">
                                  {{ csrf_field() }}
                                  {{ method_field('PUT') }}
                                  <p>Apakah anda yakin menyelesaikan order?</p>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary pull-right">Selesai</button>
                                  </div>

                                </form>
                              </div>
                            </div>
                          </div>
                        </div>

                        <!-- Modal Cek DP / Zoom DP -->
                        <div class="modal fade" id="cekdp2{{$o->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">DP Photo : ID {{$o->id}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <img src="{{ url('/dp_upload/'.$o -> dp_upload) }}" class="img-fluid" alt="Responsive image">
                              </div>
                            </div>
                          </div>
                        </div>

                        <!-- Modal Cek Jaminan / Zoom Jaminan -->
                        <div class="modal fade" id="cekjaminan2{{$o->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Jaminan Photo : ID {{$o->id}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <img src="{{ url('/upload_jaminan/'.$o -> upload_jaminan) }}" class="img-fluid" alt="Responsive image">
                              </div>
                            </div>
                          </div>
                        </div>
                      @endforeach
                    </div>
                    <div class="tab-pane fade" id="pesanandibatalkan" role="tabpanel" aria-labelledby="pesanandibatalkan-tab">
                      @foreach ($pesanandibatalkan_data as $o)
                        <div class="card shadow-sm">
                          <div class="card-header bg-white">
                            Tanggal sewa : {{ $o -> tanggal_sewa -> toFormattedDateString() }}
                          </div>
                          <div class="card-body pt-2 pb-2 border-bottom">
                            <div class="row">
                              <div class="col-5 border-right">
                                Peminjam
                                <h1 data-toggle="tooltip" data-placement="top" title="Phone : {{ $o -> no_hp }}">{{ $o -> nama }}</h1>
                                {{ $o -> acara }}, {{ $o -> alamat }}
                              </div>
                              <div class="col-4 border-right">
                                Status
                                @if($o->status =='0')
                                        <h3>Menunggu di proses</h3>
                                  @elseif($o->status =='1')
                                        <h3>Proses pembayaran</h3>
                                  @elseif($o->status =='2')
                                        <h3>Pembayaran di konfirmasi penyewa</h3>
                                  @elseif($o->status =='3')
                                        <h3>Proses jaminan</h3>
                                  @elseif($o->status =='4')
                                        <h3>Jaminan di konfirmasi penyewa</h3>
                                  @elseif($o->status =='5')
                                        <h3>Sewa berjalan</h3>
                                  @elseif($o->status =='6')
                                        <h3>Sewa selesai</h3>
                                  @elseif($o->status =='98')
                                        <h3>Proses pembatalan order</h3>
                                  @elseif($o->status =='99')
                                        <h3>Pesanan dibatalkan</h3>
                                  @else
                                        <h3>ERROR</h3>
                                @endif
                              </div>
                              <div class="col-3">
                                Total biaya sewa
                                <h3>Rp {{ $o -> total_pembayaran }}</h3>
                                {{ $o -> jumlah_unit }} Unit, {{ $o -> jumlah_hari }} hari.
                              </div>
                            </div>
                          </div>
                          <div class="card-body pt-2 pb-2">
                            <div class="row">
                              <div class="col-6 border-right">
                                ({{$o -> id}}) Code
                                <h1 class="text-monospace">{{ $o -> kode }}</h1>
                              </div>
                              <div class="col-3">
                                Paket
                                @if( $o -> paket =='1')
                                        <h3>Normal</h3>
                                  @elseif( $o -> paket =='2')
                                        <h3>Media Partner</h3>
                                  @else
                                        <h3>ERROR</h3>
                                @endif
                                Rp {{$o -> harga_unit}} / Unit / 24Jam
                              </div>
                              <div class="col-3 text-center align-self-center">
                                <div class="dropdown">
                                  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Menu
                                  </button>
                                  <div class="dropdown-menu" aria-labelledby="dropdownMenu2">

                                                                            <button class="dropdown-item" type="button" data-toggle="modal" data-target="#hapusorder2{{$o->id}}">Hapus order</button>

                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="card-footer bg-white">
                            <div class="row">
                              <div class="col-auto text-center border-right">
                                <a href="/dashboard/order/nota/{{$o->id}}" target="_blank" class="badge badge-primary">Lihat detail order</a>
                              </div>
                              <div class="col-auto">
                                Tanggal kembali : {{Carbon\Carbon::parse($o->tanggal_kembali)->toFormattedDateString()}}
                              </div>
                            </div>
                          </div>
                        </div> <br>

                        <!-- Modal Hapus Order -->
                        <div class="modal fade" id="hapusorder2{{$o->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi order : ID {{$o->id}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <form method="POST" action="/dashboard/order/proses/delete/{{ $o -> id }}">
                                  {{ csrf_field() }}
                                  {{ method_field('PUT') }}
                                  <p>Apakah anda yakin menghapus order?</p>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-danger pull-right">Hapus</button>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                      @endforeach
                    </div>

                    <div class="tab-pane fade" id="selesai" role="tabpanel" aria-labelledby="selesai-tab">
                      @foreach ($selesai_data as $o)
                        <div class="card shadow-sm">
                          <div class="card-header bg-white">
                            Tanggal sewa : {{ $o -> tanggal_sewa -> toFormattedDateString() }}
                          </div>
                          <div class="card-body pt-2 pb-2 border-bottom">
                            <div class="row">
                              <div class="col-5 border-right">
                                Peminjam
                                <h1 data-toggle="tooltip" data-placement="top" title="Phone : {{ $o -> no_hp }}">{{ $o -> nama }}</h1>
                                {{ $o -> acara }}, {{ $o -> alamat }}
                              </div>
                              <div class="col-4 border-right">
                                Status
                                @if($o->status =='0')
                                        <h3>Menunggu di proses</h3>
                                  @elseif($o->status =='1')
                                        <h3>Proses pembayaran</h3>
                                  @elseif($o->status =='2')
                                        <h3>Pembayaran di konfirmasi penyewa</h3>
                                  @elseif($o->status =='3')
                                        <h3>Proses jaminan</h3>
                                  @elseif($o->status =='4')
                                        <h3>Jaminan di konfirmasi penyewa</h3>
                                  @elseif($o->status =='5')
                                        <h3>Sewa berjalan</h3>
                                  @elseif($o->status =='6')
                                        <h3>Sewa selesai</h3>
                                  @elseif($o->status =='98')
                                        <h3>Proses pembatalan order</h3>
                                  @elseif($o->status =='99')
                                        <h3>Pesanan dibatalkan</h3>
                                  @else
                                        <h3>ERROR</h3>
                                @endif
                              </div>
                              <div class="col-3">
                                Total biaya sewa
                                <h3>Rp {{ $o -> total_pembayaran }}</h3>
                                {{ $o -> jumlah_unit }} Unit, {{ $o -> jumlah_hari }} hari.
                              </div>
                            </div>
                          </div>
                          <div class="card-body pt-2 pb-2">
                            <div class="row">
                              <div class="col-6 border-right">
                                ({{$o -> id}}) Code
                                <h1 class="text-monospace">{{ $o -> kode }}</h1>
                              </div>
                              <div class="col-3">
                                Paket
                                @if( $o -> paket =='1')
                                        <h3>Normal</h3>
                                  @elseif( $o -> paket =='2')
                                        <h3>Media Partner</h3>
                                  @else
                                        <h3>ERROR</h3>
                                @endif
                                Rp {{$o -> harga_unit}} / Unit / 24Jam
                              </div>
                              <div class="col-3 text-center align-self-center">
                                <div class="dropdown">
                                  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Menu
                                  </button>
                                  <div class="dropdown-menu" aria-labelledby="dropdownMenu2">

                                                                            <button class="dropdown-item" type="button" data-toggle="modal" data-target="#hapusorder2{{$o->id}}">Hapus order</button>
                                                                            <button class="dropdown-item" type="button" data-toggle="modal" data-target="#cekdp3{{$o->id}}">Lihat DP</button>
                                                                            <button class="dropdown-item" type="button" data-toggle="modal" data-target="#cekjaminan3{{$o->id}}">Lihat Jaminan</button>

                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="card-footer bg-white">
                            <div class="row">
                              <div class="col-auto text-center border-right">
                                <a href="/dashboard/order/nota/{{$o->id}}" target="_blank" class="badge badge-primary">Lihat detail order</a>
                              </div>
                              <div class="col-auto">
                                Tanggal kembali : {{Carbon\Carbon::parse($o->tanggal_kembali)->toFormattedDateString()}}
                              </div>
                            </div>
                          </div>
                        </div> <br>

                        <!-- Modal Hapus Order -->
                        <div class="modal fade" id="hapusorder2{{$o->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi order : ID {{$o->id}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <form method="POST" action="/dashboard/order/proses/delete/{{ $o -> id }}">
                                  {{ csrf_field() }}
                                  {{ method_field('PUT') }}
                                  <p>Apakah anda yakin menghapus order?</p>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-danger pull-right">Hapus</button>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>

                        <!-- Modal Cek DP / Zoom DP -->
                        <div class="modal fade" id="cekdp3{{$o->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">DP Photo : ID {{$o->id}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <img src="{{ url('/dp_upload/'.$o -> dp_upload) }}" class="img-fluid" alt="Responsive image">
                              </div>
                            </div>
                          </div>
                        </div>

                        <!-- Modal Cek Jaminan / Zoom Jaminan -->
                        <div class="modal fade" id="cekjaminan3{{$o->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Jaminan Photo : ID {{$o->id}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <img src="{{ url('/upload_jaminan/'.$o -> upload_jaminan) }}" class="img-fluid" alt="Responsive image">
                              </div>
                            </div>
                          </div>
                        </div>
                      @endforeach
                    </div>

                  </div>
              </div>
            </div>
          </div>


          <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample3">
            <div class="card">


              <div class="card-header bg-white">
                <ul class="nav nav-pills" id="myTab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active rounded" id="user-tab" data-toggle="tab" href="#user" role="tab" aria-controls="user" aria-selected="true">User</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link rounded" id="admin-tab" data-toggle="tab" href="#admin" role="tab" aria-controls="admin" aria-selected="false">Admin</a>
                  </li>
                </ul>
              </div>


                <div class="card-body">
                  <div class="tab-content" id="myTabContent">

                    <div class="tab-pane fade show active" id="user" role="tabpanel" aria-labelledby="user-tab">

                      @foreach ($user_data as $o)
                      <div class="card">
                          <div class="row">
                            <div class="col-1 @if($o->usertype=='admin')bg-danger @elseif($o->usertype=='')bg-primary @else bg-primary @endif">
                            </div>
                            <div class="col-8">
                              <blockquote class="blockquote">
                                <p class="mb-0">{{$o -> name}}</p>
                                <footer class="blockquote-footer">{{$o -> email}} <cite title="Source Title">
                                  ,Role as @if($o->usertype == null)
                                          User
                                    @elseif($o->usertype =='admin')
                                          Admin
                                    @else
                                          ERROR
                                  @endif</cite></footer>
                                  <footer class="blockquote-footer">Phone: {{$o -> phone}} <cite title="Source Title">
                                    <br>Mendaftar pada: {{$o -> created_at}}</cite></footer></blockquote>
                            </div>
                            <div class="col align-self-center">
                              <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton{{$o->id}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Menu
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                  <button type="button" class="dropdown-item" data-toggle="modal" data-target="#edit2{{ $o -> id }}">
                                    Edit
                                  </button>

                                  <button type="button" class="dropdown-item" data-toggle="modal" data-target="#delete2{{ $o -> id }}">
                                    Delete
                                  </button>
                                </div><br>
                              </div>
                            </div>
                          </div>

                      </div> <br>

                      <!-- Modal Edit-->
                      <div class="modal fade" id="edit2{{ $o -> id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">User edit</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <form action="/dashboard/user/edit/update/{{ $o -> id }}" method="POST">

                                {{ csrf_field() }}
                                {{ method_field('PUT') }}

                                <div class="form-group">
                                  <label for="name">Name</label>
                                  <input type="text" name="name" class="form-control" id="name" aria-describedby="name" placeholder="{{ $o -> name}}" value="{{ $o -> name}}">
                                </div>
                                <div class="form-group">
                                  <label for="phone">Phone</label>
                                  <input type="number" name="phone" class="form-control" id="phone" aria-describedby="phone" placeholder="{{ $o -> phone}}" value="{{ $o -> phone}}">
                                </div>
                                <div class="form-group">
                                  <label for="email">Email</label>
                                  <input type="email" name="email" class="form-control" id="email" placeholder="{{ $o -> email}}" value="{{ $o -> email}}">
                                  <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                                </div>
                                <div class="form-group">
                                  <label for="usertype">User Type</label>
                                  <select class="form-control" id="usertype" name="usertype" value="{{ $o -> usertype}}">
                                    <option selected value="{{ $o -> usertype }}">{{ $o -> usertype }}</option>
                                    <option value="admin">Admin</option>
                                    <option value="user">User</option>
                                  </select>
                                </div>
                                <div class="form-group">
                                  <label for="created_at">Date created</label>
                                  <input type="created_at" name="created_at" class="form-control" id="created_at" placeholder="{{ $o -> created_at}}" value="{{ $o -> created_at}}" readonly>
                                </div>
                                  <br>
                                  <div class="modal-footer">
                                    <p><small>Last update: {{ $o -> updated_at }}</small></p>
                                    <button type="button" class="btn btn-secondary pull-right" data-dismiss="modal">Close</button>
                                    <button type="reset" class="btn btn-danger pull-right">Reset</button>
                                    <button type="submit" class="btn btn-primary pull-right">Submit</button>
                                  </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>

                      <!-- Modal Delete-->
                      <div class="modal fade" id="delete2{{ $o -> id }}" tabindex="-1" role="dialog" aria-labelledby="AexampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="AexampleModalLabel">Delete confirmation</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              Are you sure want to delete this user ?
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <a class="btn btn-danger" role="button" href="/dashboard/user/delete/{{ $o -> id }}">Confirm</a>
                            </div>
                          </div>
                        </div>
                      </div>
                      @endforeach
                    </div>

                    <div class="tab-pane fade" id="admin" role="tabpanel" aria-labelledby="admin-tab">
                      @foreach ($admin_data as $o)
                      <div class="card">
                          <div class="row">
                            <div class="col-1 bg-danger">
                            </div>
                            <div class="col-8">
                              <blockquote class="blockquote">
                                <p class="mb-0">{{$o -> name}}</p>
                                <footer class="blockquote-footer">{{$o -> email}} <cite title="Source Title">
                                  ,Role as @if($o->usertype == null)
                                          User
                                    @elseif($o->usertype =='admin')
                                          Admin
                                    @else
                                          ERROR
                                  @endif</cite></footer>
                                  <footer class="blockquote-footer">Phone: {{$o -> phone}} <cite title="Source Title">
                                    <br>Mendaftar pada: {{$o -> created_at}}</cite></footer></blockquote>
                            </div>
                            <div class="col align-self-center">
                              <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton{{$o->id}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Menu
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                  <button type="button" class="dropdown-item" data-toggle="modal" data-target="#edit3{{ $o -> id }}">
                                    Edit
                                  </button>

                                  <button type="button" class="dropdown-item" data-toggle="modal" data-target="#delete3{{ $o -> id }}">
                                    Delete
                                  </button>
                                </div><br>
                              </div>
                            </div>
                          </div>

                      </div> <br>

                      <!-- Modal Edit-->
                      <div class="modal fade" id="edit3{{ $o -> id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">User edit</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <form action="/dashboard/user/edit/update/{{ $o -> id }}" method="POST">

                                {{ csrf_field() }}
                                {{ method_field('PUT') }}

                                <div class="form-group">
                                  <label for="name">Name</label>
                                  <input type="text" name="name" class="form-control" id="name" aria-describedby="name" placeholder="{{ $o -> name}}" value="{{ $o -> name}}">
                                </div>
                                <div class="form-group">
                                  <label for="phone">Phone</label>
                                  <input type="number" name="phone" class="form-control" id="phone" aria-describedby="phone" placeholder="{{ $o -> phone}}" value="{{ $o -> phone}}">
                                </div>
                                <div class="form-group">
                                  <label for="email">Email</label>
                                  <input type="email" name="email" class="form-control" id="email" placeholder="{{ $o -> email}}" value="{{ $o -> email}}">
                                  <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                                </div>
                                <div class="form-group">
                                  <label for="usertype">User Type</label>
                                  <select class="form-control" id="usertype" name="usertype" value="{{ $o -> usertype}}">
                                    <option selected value="{{ $o -> usertype }}">{{ $o -> usertype }}</option>
                                    <option value="admin">Admin</option>
                                    <option value="user">User</option>
                                  </select>
                                </div>
                                <div class="form-group">
                                  <label for="created_at">Date created</label>
                                  <input type="created_at" name="created_at" class="form-control" id="created_at" placeholder="{{ $o -> created_at}}" value="{{ $o -> created_at}}" readonly>
                                </div>
                                  <br>
                                  <div class="modal-footer">
                                    <p><small>Last update: {{ $o -> updated_at }}</small></p>
                                    <button type="button" class="btn btn-secondary pull-right" data-dismiss="modal">Close</button>
                                    <button type="reset" class="btn btn-danger pull-right">Reset</button>
                                    <button type="submit" class="btn btn-primary pull-right">Submit</button>
                                  </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>

                      <!-- Modal Delete-->
                      <div class="modal fade" id="delete3{{ $o -> id }}" tabindex="-1" role="dialog" aria-labelledby="AexampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="AexampleModalLabel">Delete confirmation</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              Are you sure want to delete this user ?
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <a class="btn btn-danger" role="button" href="/dashboard/user/delete/{{ $o -> id }}">Confirm</a>
                            </div>
                          </div>
                        </div>
                      </div>
                      @endforeach
                    </div>

                  </div>
              </div>
            </div>
          </div>


        </div>
        <div class="col-sm-3">

          <div class="accordion" id="accordionExample1">
            <div class="card">
              <div class="card-header" id="headingOne">
                  <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                    Order - <span class="badge badge-primary badge-pill">{{ $semuaorder_count }}</span>
                  </button>
              </div>

              <div id="collapseOne" class="collapse show active" aria-labelledby="headingOne" data-parent="#accordionExample1">
                <div class="card-body">
                  <ul class="list-group list-group-flush">
                    <a class="list-group-item list-group-item d-flex justify-content-between align-items-center" >Semua order <span class="badge badge-primary badge-pill">{{ $semuaorder_count }}</span></a>
                    <a class="list-group-item list-group-item d-flex justify-content-between align-items-center" >Order baru <span class="badge badge-primary badge-pill">{{ $konfirmasiorder_count }}</span></a>
                    <a class="list-group-item list-group-item d-flex justify-content-between align-items-center" >DP <span class="badge badge-light badge-pill">{{ $konfirmasidp_count }}</span></a>
                    <a class="list-group-item list-group-item d-flex justify-content-between align-items-center" >Jaminan <span class="badge badge-light badge-pill">{{$konfirmasijaminan_count}}</span></a>
                    <a class="list-group-item list-group-item d-flex justify-content-between align-items-center" >Sedang berjalan <span class="badge badge-success badge-pill">{{$sedangberjalan_count}}</span></a>
                    <a class="list-group-item list-group-item d-flex justify-content-between align-items-center" >Konfirmasi pembatalan <span class="badge badge-light badge-pill">{{$konfirmasipembatalan_count}}</span></a>
                    <a class="list-group-item list-group-item d-flex justify-content-between align-items-center" >Order dibatalkan <span class="badge badge-danger badge-pill">{{$pesanandibatalkan_count}}</span></a>
                    <a class="list-group-item list-group-item d-flex justify-content-between align-items-center" >Selesai <span class="badge badge-success badge-pill">{{$selesai_count}}</span></a>
                  </ul>
                </div>
              </div>
            </div>

          </div>

          <div class="accordion" id="accordionExample2">
            <br>

            <div class="card">
              <div class="card-header" id="headingTwo">
                  <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Media partner - <span class="badge badge-primary badge-pill">9</span>
                  </button>
              </div>
              <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample2">
                <div class="card-body">
                  <ul ul class="list-group list-group-flush">
                    <a class="list-group-item list-group-item d-flex justify-content-between align-items-center" data-toggle="collapse" data-target="#mediapartnerwaiting">Konfirmasi<span class="badge badge-danger badge-pill">9</span></a>
                    <a class="list-group-item list-group-item d-flex justify-content-between align-items-center" data-toggle="collapse" data-target="#mediapartnerconfirm">Media partner<span class="badge badge-danger badge-pill">9</span></a>
                  </ul>
                </div>
              </div>
            </div>
          </div>

          <div class="accordion" id="accordionExample3">

          <br>

          <div class="card">
              <div class="card-header" id="headingThree">
                  <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    User - <span class="badge badge-primary badge-pill">9</span>
                  </button>
              </div>
              <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample3">
                  <div class="card-body">
                    <ul ul class="list-group list-group-flush">
                        <li class="list-group-item list-group-item d-flex justify-content-between align-items-center" data-toggle="collapse" data-target="#user">User<span class="badge badge-danger badge-pill">9</span></li>
                        <li class="list-group-item list-group-item d-flex justify-content-between align-items-center" data-toggle="collapse" data-target="#admin">Admin<span class="badge badge-danger badge-pill">9</span></li>
                    </ul>
                  </div>
                </div>
              </div>
          </div>

        </div>
      </div>
    </div>
@endsection
