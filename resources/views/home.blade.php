@extends('layouts.navbar_user')

@section('content')

<div class="container-fluid">
  <div class="row">
      <div class="col-sm-3">
        <div class="card">
          <div class="card-header">
            Profile
          </div>
          <div class="card-body">
            Welcome,
            <h3 class="card-title text-monospace">{{ Auth::user()->name }}</h3>
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
              <strong>Holy {{ Auth::user()->name }}!</strong> Some quick example text to build on the card title and make up the bulk of the card's content.
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          </div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">{{ Auth::user()->phone }}</li>
            <li class="list-group-item">{{ Auth::user()->email }}</li>
            <li class="list-group-item">{{ Auth::user()->usertype }}</li>
          </ul>
        </div> <br>

        <div class="card">
          <div class="card-header">
            Menu
          </div>

          <div class="card-body">
            <p>
              <button class="btn" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                New Order <span class="badge badge-primary badge-pill">Beta</span>
              </button>
            </p>

            <p>
              <button class="btn collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                Orders <span class="badge badge-primary badge-pill">{{ $orders_count }}</span>
              </button>
            </p>

            <p>
              <button class="btn collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                Media partner <span class="badge badge-primary badge-pill">Coming soon</span>
              </button>
            </p>

          </div>
        </div>
      </div>
      <div class="col-sm-9">

        <div class="alert alert-primary alert-dismissible fade show" role="alert">
          <h1 class="display-4">Hello, {{ Auth::user()->name }}!</h1>
          <p>Selamat datang di 5758 Media dashboard, kami berusaha memudahkan pelanggan untuk berinteraksi dengan sistem.</p>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        @if (session('status'))
            <div class="alert alert-warning" role="alert">
                {{ session('status') }}
            </div>
        @endif

        @if(count($errors) > 0)
            <div class="alert alert-danger">
              @foreach ($errors->all() as $error)
              {{ $error }} <br/>
              @endforeach
            </div>
        @endif

        <div class="accordion" id="accordionExample">
          <div class="card">
            <div class="card-header" id="headingOne">
              <h2 class="mb-0">
                <button class="btn btn-light" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  New Order <span class="badge badge-primary badge-pill">Beta</span>
                </button>
              </h2>
            </div>

            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
              <div class="card-body"> <br>
                <div class="row justify-content-center">
                  <div class="col-sm-4">
                    <div class="card shadow border">
                      <img src="https://wrdhndty.site/img/header.jpeg" class="card-img-top" alt="...">
                      <div class="card-body">
                        <h5 class="card-title text-center">Normal Freelance</h5>
                        <p class="card-text">Penuhi kebutuhan komunikasi acara pribadi anda dengan handy talkie, tanpa sponsor dengan harga murah terjangkau. kami jamin!</p>
                        <p class="card-text">
                          <a class="btn btn-primary" data-toggle="collapse" href="#nrm" role="button" aria-expanded="false" aria-controls="collapseExample">Read more</a> |
                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".n-modal-lg">Order</button>

                          <div class="modal fade n-modal-lg" tabindex="-1" role="dialog" aria-labelledby="nModal" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">New order: Normal</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">

                                  <form method="POST" action="{{route('store')}}">
                                            {{ csrf_field() }}
                                    <div class="form-row">
                                      <div class="form-group col-sm-md-6">
                                        <label >Nama penyewa</label>
                                        <input type="text" name="nama" class="form-control" placeholder="{{ Auth::user()->name }}">
                                        <small class="form-text text-muted">Nama penyewa haru sama dengan Jaminan.</small>
                                      </div>
                                      <div class="form-group col-sm-md-6">
                                        <label for="no_hp">Nomor telfon</label>
                                        <input type="text" name="no_hp" class="form-control" id="no_hp" placeholder="{{ Auth::user()->phone }}">
                                        <small class="form-text text-muted">Masukkan nomor yang dapat dihubungi.</small>
                                      </div>
                                    </div>
                                    <div class="form-row">
                                    <div class="form-group col-sm-md-6">
                                      <label for="acara">Acara</label>
                                      <input type="text" name="acara" class="form-control" id="acara" placeholder="Nama acara / kegiatan">
                                      <small class="form-text text-muted">Nama acara.</small>
                                    </div>
                                    <div class="form-group col-sm-md-6">
                                      <label for="paket">Paket</label>
                                      <select id="paket" name="paket" class="form-control" readonly>
                                        <option value="1"selected>Normal</option>
                                      </select>
                                    </div>
                                    </div>
                                    <div class="form-group">
                                      <label for="alamat">Alamat / Fakultas dan jurusan </label>
                                      <input type="text" name="alamat" class="form-control" id="alamat" placeholder="Alamat / Fakultas dan jurusan">
                                      <small class="form-text text-muted">Lokasi / alamat acara.</small>
                                    </div>
                                    <div class="form-row">
                                      <div class="form-group col-sm-md-6">
                                        <label for="tanggal_sewa">Tanggal sewa</label>
                                        <input type="date" name="tanggal_sewa" class="form-control" id="tanggal_sewa">
                                      </div>
                                      <div class="form-group col-sm-md-4">
                                        <label for="jumlah_hari">Jumlah hari</label>
                                        <select id="jumlah_hari" name="jumlah_hari" class="form-control">
                                          <option selected>Pilih..</option>
                                              @for ($i = 1; $i < 11; $i++)
                                                  <option value="{{ $i }}">{{ $i }}</option>
                                              @endfor
                                        </select>
                                      </div>
                                      <div class="form-group col-sm-md-2">
                                        <label for="jumlah_unit">Unit</label>
                                        <select id="jumlah_unit" name="jumlah_unit" class="form-control">
                                          <option selected>Pilih..</option>
                                              @for ($i = 1; $i < 31; $i++)
                                                  <option value="{{ $i }}">{{ $i }}</option>
                                              @endfor
                                        </select>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                                        <label class="form-check-label" for="invalidCheck">
                                          Bersedia & Setuju dengan ketentuan dan persyaratan yang berlaku.
                                        </label>
                                      </div>
                                    </div>

                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                      <button type="reset" class="btn btn-danger pull-right">Reset</button>
                                      <button type="submit" class="btn btn-primary pull-right">Submit</button>
                                    </div>

                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                        </p>
                        <div class="collapse" id="nrm">
                          <ul class="list-group list-group-flush">
                            <li class="list-group-item">Tanpa minimum peminjaman</li>
                            <li class="list-group-item">Harga khusus untuk acara edukasi & sosial</li>
                            <li class="list-group-item">Rp 9.000/Unit/24Jam</li>
                          </ul>
                        </div>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                      </div>



                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="card shadow border">
                      <img src="https://wrdhndty.site/img/header.jpeg" class="card-img-top" alt="...">
                      <div class="card-body">
                        <h5 class="card-title text-center">Media Partner</h5>
                        <p class="card-text">"Komunikasi adalah kunci keberhasilan acara" lengkapi acara umum kalian dengan handy talkie. dapatkan harga sponsor disini.</p>
                        <p class="card-text">
                          <a class="btn btn-primary" data-toggle="collapse" href="#mrm" role="button" aria-expanded="false" aria-controls="collapseExampletwo">Read more</a> |
                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".m-modal-lg">Order</button>

                          <div class="modal fade m-modal-lg" tabindex="-1" role="dialog" aria-labelledby="mModal" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">New order: Media Partner</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">

                                  <form method="POST" action="{{route('store')}}">
                                            {{ csrf_field() }}
                                    <div class="form-row">
                                      <div class="form-group col-sm-md-6">
                                        <label >Nama penyewa</label>
                                        <input type="text" name="nama" class="form-control" placeholder="{{ Auth::user()->name }}">
                                        <small class="form-text text-muted">Nama penyewa haru sama dengan Jaminan.</small>
                                      </div>
                                      <div class="form-group col-sm-md-6">
                                        <label for="no_hp">Nomor telfon</label>
                                        <input type="text" name="no_hp" class="form-control" id="no_hp" placeholder="{{ Auth::user()->phone }}">
                                        <small class="form-text text-muted">Masukkan nomor yang dapat dihubungi.</small>
                                      </div>
                                    </div>
                                    <div class="form-row">
                                    <div class="form-group col-sm-md-6">
                                      <label for="acara">Acara</label>
                                      <input type="text" name="acara" class="form-control" id="acara" placeholder="Nama acara / kegiatan">
                                      <small class="form-text text-muted">Nama acara.</small>
                                    </div>
                                    <div class="form-group col-sm-md-6">
                                      <label for="paket">Paket</label>
                                      <select id="paket" name="paket" class="form-control" readonly>
                                        <option value="2"selected>Media Partner</option>
                                      </select>
                                    </div>
                                    </div>
                                    <div class="form-group">
                                      <label for="alamat">Alamat / Fakultas dan jurusan </label>
                                      <input type="text" name="alamat" class="form-control" id="alamat" placeholder="Alamat / Fakultas dan jurusan">
                                      <small class="form-text text-muted">Lokasi / alamat acara.</small>
                                    </div>
                                    <div class="form-row">
                                      <div class="form-group col-sm-md-6">
                                        <label for="tanggal_sewa">Tanggal sewa</label>
                                        <input type="date" name="tanggal_sewa" class="form-control" id="tanggal_sewa">
                                      </div>
                                      <div class="form-group col-sm-md-4">
                                        <label for="jumlah_hari">Jumlah hari</label>
                                        <select id="jumlah_hari" name="jumlah_hari" class="form-control">
                                          <option selected>Pilih..</option>
                                              @for ($i = 1; $i < 11; $i++)
                                                  <option value="{{ $i }}">{{ $i }}</option>
                                              @endfor
                                        </select>
                                      </div>
                                      <div class="form-group col-sm-md-2">
                                        <label for="jumlah_unit">Unit</label>
                                        <select id="jumlah_unit" name="jumlah_unit" class="form-control">
                                          <option selected>Pilih..</option>
                                              @for ($i = 1; $i < 31; $i++)
                                                  <option value="{{ $i }}">{{ $i }}</option>
                                              @endfor
                                        </select>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                                        <label class="form-check-label" for="invalidCheck">
                                          Bersedia & Setuju dengan ketentuan dan persyaratan yang berlaku.
                                        </label>
                                      </div>
                                    </div>

                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                      <button type="reset" class="btn btn-danger pull-right">Reset</button>
                                      <button type="submit" class="btn btn-primary pull-right">Submit</button>
                                    </div>

                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                        </p>
                        <div class="collapse" id="mrm">
                          <ul class="list-group list-group-flush">
                            <li class="list-group-item">Minimum 10 Unit</li>
                            <li class="list-group-item">Melakukan Paid Promote</li>
                            <li class="list-group-item">Tanpa pengajuan</li>
                            <li class="list-group-item">Rp 5.000/Unit/24Jam</li>
                          </ul>
                        </div>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                      </div>
                    </div>
                  </div>
                </div>

                <br>
                <p class="card-text text-muted text-center"> *Maximum 30 units per day. <br> *Order within 10 units or more will included box. </p>

              </div>
            </div>

          </div>
          <div class="card">
            <div class="card-header" id="headingTwo">
              <h2 class="mb-0">
                <button class="btn btn-light collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  Orders
                    <span class="badge badge-primary badge-pill">{{ $orders_count }}</span> /
                    <span class="badge badge-primary badge-pill">{{ $orderbaru_count }}</span> /
                    <span class="badge badge-primary badge-pill">{{ $dp_count }}</span> /
                    <span class="badge badge-primary badge-pill">{{ $jaminan_count }}</span> /
                    <span class="badge badge-primary badge-pill">{{ $sedangberjalan_count }}</span> /
                    <span class="badge badge-primary badge-pill">{{ $selesai_count }}</span> /
                    <span class="badge badge-primary badge-pill">{{ $pembatalan_count }}</span> /
                    <span class="badge badge-primary badge-pill">{{ $dibatalkan_count }}</span>
                </button>

                <a href="{{route('archive')}}" target="_blank" class="badge badge-primary">Archive</a>
              </h2>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
              <div class="card-body">
                <ul class="nav nav-pills border-bottom" id="myTab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="orders-tab" data-toggle="pill" href="#orders" role="tab" aria-controls="orders" aria-selected="true">Orders <span class="badge badge-primary badge-pill">{{ $orders_count }}</span></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="orderbaru-tab" data-toggle="pill" href="#orderbaru" role="tab" aria-controls="orderbaru" aria-selected="true">Order baru <span class="badge badge-primary badge-pill">{{ $orderbaru_count }}</span></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="dp-tab" data-toggle="pill" href="#dp" role="tab" aria-controls="dp" aria-selected="false">DP <span class="badge badge-primary badge-pill">{{ $dp_count }}</span></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="jaminan-tab" data-toggle="pill" href="#jaminan" role="tab" aria-controls="jaminan" aria-selected="false">Jaminan <span class="badge badge-primary badge-pill">{{ $jaminan_count }}</span></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="sedangberjalan-tab" data-toggle="pill" href="#sedangberjalan" role="tab" aria-controls="sedangberjalan" aria-selected="false">Sedang berjalan <span class="badge badge-primary badge-pill">{{ $sedangberjalan_count }}</span></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="selesai-tab" data-toggle="pill" href="#selesai" role="tab" aria-controls="selesai" aria-selected="false">Selesai <span class="badge badge-primary badge-pill">{{ $selesai_count }}</span></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="pembatalan-tab" data-toggle="pill" href="#pembatalan" role="tab" aria-controls="pembatalan" aria-selected="false">Pembatalan <span class="badge badge-primary badge-pill">{{ $pembatalan_count }}</span></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="dibatalkan-tab" data-toggle="pill" href="#dibatalkan" role="tab" aria-controls="dibatalkan" aria-selected="false">Dibatalkan <span class="badge badge-primary badge-pill">{{ $dibatalkan_count }}</span></a>
                  </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                  <br>
                  <div class="tab-pane fade show active" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                    @forelse ($orders as $o)
                    <div class="card shadow-sm">
                      <div class="card-header bg-white">
                        Tanggal sewa : {{ $o -> tanggal_sewa -> toFormattedDateString() }}
                      </div>
                      <div class="card-body pt-2 pb-2 border-bottom">
                        <div class="row">
                          <div class="col-sm-5 border-right">
                            Peminjam
                            <h1 data-toggle="tooltip" data-placement="top" title="Phone : {{ $o -> no_hp }}">{{ $o -> nama }}</h1>
                            {{ $o -> acara }}, {{ $o -> alamat }}
                          </div>
                          <div class="col-sm-4 border-right">
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
                          <div class="col-sm-3">
                            Total biaya sewa
                            <h3>Rp {{ $o -> total_pembayaran }}</h3>
                            {{ $o -> jumlah_unit }} Unit, {{ $o -> jumlah_hari }} hari.
                          </div>
                        </div>
                      </div>
                      <div class="card-body pt-2 pb-2">
                        <div class="row">
                          <div class="col-sm-6 border-right">
                            ({{$o -> id}}) Code
                            <h1 class="text-monospace">{{ $o -> kode }}</h1>
                          </div>
                          <div class="col-sm-3">
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
                          <div class="col-sm-3 text-center align-self-center">
                            <div class="dropdown">
                              <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Menu
                              </button>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                <button class="dropdown-item" type="button" data-toggle="modal" data-target="#batal{{$o->id}}">Batalkan</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="card-footer bg-white">
                        <div class="row">
                          <div class="col-sm-auto text-center border-right">
                            <a href="{{route('notauser',$o->id)}}" target="_blank" class="badge badge-primary">Lihat detail order</a>
                          </div>
                          <div class="col-sm-auto">
                            Tanggal kembali : {{Carbon\Carbon::parse($o->tanggal_kembali)->toFormattedDateString()}}
                          </div>
                        </div>
                      </div>
                    </div> <br>
                    @empty
                    <p>no data</p>
                    @endforelse
                  </div>
                  <div class="tab-pane fade" id="orderbaru" role="tabpanel" aria-labelledby="orderbaru-tab">
                    @forelse($orderbaru as $o)
                    <div class="card shadow-sm">
                      <div class="card-header bg-white">
                        Tanggal sewa : {{ $o -> tanggal_sewa -> toFormattedDateString() }}
                      </div>
                      <div class="card-body pt-2 pb-2 border-bottom">
                        <div class="row">
                          <div class="col-sm-5 border-right">
                            Peminjam
                            <h1 data-toggle="tooltip" data-placement="top" title="Phone : {{ $o -> no_hp }}">{{ $o -> nama }}</h1>
                            {{ $o -> acara }}, {{ $o -> alamat }}
                          </div>
                          <div class="col-sm-4 border-right">
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
                          <div class="col-sm-3">
                            Total biaya sewa
                            <h3>Rp {{ $o -> total_pembayaran }}</h3>
                            {{ $o -> jumlah_unit }} Unit, {{ $o -> jumlah_hari }} hari.
                          </div>
                        </div>
                      </div>
                      <div class="card-body pt-2 pb-2">
                        <div class="row">
                          <div class="col-sm-6 border-right">
                            ({{$o -> id}}) Code
                            <h1 class="text-monospace">{{ $o -> kode }}</h1>
                          </div>
                          <div class="col-sm-3">
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
                          <div class="col-sm-3 text-center align-self-center">
                            <div class="dropdown">
                              <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Menu
                              </button>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                <button class="dropdown-item" type="button" data-toggle="modal" data-target="#batal{{$o->id}}">Batalkan</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="card-footer bg-white">
                        <div class="row">
                          <div class="col-sm-auto text-center border-right">
                            <a href="{{route('notauser',$o->id)}}" target="_blank" class="badge badge-primary">Lihat detail order</a>
                          </div>
                          <div class="col-sm-auto">
                            Tanggal kembali : {{Carbon\Carbon::parse($o->tanggal_kembali)->toFormattedDateString()}}
                          </div>
                        </div>
                      </div>
                    </div> <br>
                    <!-- modal batal  -->
                  <div class="modal fade" id="batal{{ $o -> id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Pembatalan pesanan | ID: {{ $o -> id }}</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form action="{{route('userbatal',$o->id)}}}" method="POST">

                            {{ csrf_field() }}
                            {{ method_field('PUT') }}

                                <p>Apakah anda yakin mengajukan pembatalan pesanan ?</p>
                                <button type="button" class="btn btn-secondary pull-right" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary pull-right">Submit</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                    @empty
                    <p>no data</p>
                    @endforelse
                  </div>
                  <div class="tab-pane fade" id="dp" role="tabpanel" aria-labelledby="dp-tab">
                    @forelse ($dp as $o)
                    <div class="card shadow-sm">
                      <div class="card-header bg-white">
                        Tanggal sewa : {{ $o -> tanggal_sewa -> toFormattedDateString() }}
                      </div>
                      <div class="card-body pt-2 pb-2 border-bottom">
                        <div class="row">
                          <div class="col-sm-5 border-right">
                            Peminjam
                            <h1 data-toggle="tooltip" data-placement="top" title="Phone : {{ $o -> no_hp }}">{{ $o -> nama }}</h1>
                            {{ $o -> acara }}, {{ $o -> alamat }}
                          </div>
                          <div class="col-sm-4 border-right">
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
                          <div class="col-sm-3">
                            Total biaya sewa
                            <h3>Rp {{ $o -> total_pembayaran }}</h3>
                            {{ $o -> jumlah_unit }} Unit, {{ $o -> jumlah_hari }} hari.
                          </div>
                        </div>
                      </div>
                      <div class="card-body pt-2 pb-2">
                        <div class="row">
                          <div class="col-sm-6 border-right">
                            ({{$o -> id}}) Code
                            <h1 class="text-monospace">{{ $o -> kode }}</h1>
                          </div>
                          <div class="col-sm-3">
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
                          <div class="col-sm-3 text-center align-self-center">
                            <div class="dropdown">
                              <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Menu
                              </button>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                <button class="dropdown-item" type="button" data-toggle="modal" data-target="#dp{{$o->id}}">Pembayaran DP</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="card-footer bg-white">
                        <div class="row">
                          <div class="col-sm-auto text-center border-right">
                            <a href="{{route('notauser',$o->id)}}" target="_blank" class="badge badge-primary">Lihat detail order</a>
                          </div>
                          <div class="col-sm-auto">
                            Tanggal kembali : {{Carbon\Carbon::parse($o->tanggal_kembali)->toFormattedDateString()}}
                          </div>
                        </div>
                      </div>
                    </div> <br>

                    <!-- Modal DP -->
                    <div class="modal fade" id="dp{{ $o -> id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Pembatalan pesanan | ID: {{ $o -> id }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form action="{{route('userpembayaran',$o->id)}}" method="POST" enctype="multipart/form-data">

                              {{ csrf_field() }}
                              {{ method_field('PUT') }}

                              <div class="form-group">
                                <b>Bukti DP</b><br/>
                                <input type="file" name="dp_upload">
                              </div>

                              <div class="form-group">
                                <label for="dp">Nominal DP</label>
                                <input type="text" name="dp" class="form-control" id="dp" placeholder="{{ $o -> dp }}" readonly>
                              </div>


                                  <button type="button" class="btn btn-secondary pull-right" data-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-primary pull-right">Submit</button>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                    @empty
                    <p>no data</p>
                    @endforelse
                  </div>
                  <div class="tab-pane fade" id="jaminan" role="tabpanel" aria-labelledby="jaminan-tab">
                    @forelse ($jaminan as $o)
                    <div class="card shadow-sm">
                      <div class="card-header bg-white">
                        Tanggal sewa : {{ $o -> tanggal_sewa -> toFormattedDateString() }}
                      </div>
                      <div class="card-body pt-2 pb-2 border-bottom">
                        <div class="row">
                          <div class="col-sm-5 border-right">
                            Peminjam
                            <h1 data-toggle="tooltip" data-placement="top" title="Phone : {{ $o -> no_hp }}">{{ $o -> nama }}</h1>
                            {{ $o -> acara }}, {{ $o -> alamat }}
                          </div>
                          <div class="col-sm-4 border-right">
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
                          <div class="col-sm-3">
                            Total biaya sewa
                            <h3>Rp {{ $o -> total_pembayaran }}</h3>
                            {{ $o -> jumlah_unit }} Unit, {{ $o -> jumlah_hari }} hari.
                          </div>
                        </div>
                      </div>
                      <div class="card-body pt-2 pb-2">
                        <div class="row">
                          <div class="col-sm-6 border-right">
                            ({{$o -> id}}) Code
                            <h1 class="text-monospace">{{ $o -> kode }}</h1>
                          </div>
                          <div class="col-sm-3">
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
                          <div class="col-sm-3 text-center align-self-center">
                            <div class="dropdown">
                              <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Menu
                              </button>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                <button class="dropdown-item" type="button" data-toggle="modal" data-target="#cekdp{{$o->id}}">Lihat DP</button>
                                <button class="dropdown-item" type="button" data-toggle="modal" data-target="#jaminan{{$o->id}}">Upload jaminan</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="card-footer bg-white">
                        <div class="row">
                          <div class="col-sm-auto text-center border-right">
                            <a href="{{route('notauser',$o->id)}}" target="_blank" class="badge badge-primary">Lihat detail order</a>
                          </div>
                          <div class="col-sm-auto">
                            Tanggal kembali : {{Carbon\Carbon::parse($o->tanggal_kembali)->toFormattedDateString()}}
                          </div>
                        </div>
                      </div>
                    </div> <br>

                    <!-- Modal Pelunasan -->
                    <div class="modal fade" id="jaminan{{ $o -> id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Pembatalan pesanan | ID: {{ $o -> id }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form action="{{route('userpelunasan',$o->id)}}" method="POST" enctype="multipart/form-data">

                              {{ csrf_field() }}
                              {{ method_field('PUT') }}

                              <div class="form-row">
                              <div class="form-group col-sm-md-6">
                                <b>Upload jaminan</b><br/>
                                <input type="file" name="upload_jaminan">
                              </div>

                              <div class="form-group col-sm-md-6">
                                <label for="jenis_jaminan">Jaminan</label>
                                <select class="form-control" name="jenis_jaminan" id="jenis_jaminan">
                                  <option value="KTP">KTP</option>
                                  <option value="KTM">KTM</option>
                                  <option value="SIM">SIM</option>
                                </select>
                              </div>
                              </div>

                              <div class="form-group col-sm-md-12">
                                <b>Pelunasan</b><br/>
                                <input type="text" name="pelunasan" placeholder="{{ $o -> pelunasan }}" readonly>
                              </div>



                                  <button type="button" class="btn btn-secondary pull-right" data-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-primary pull-right">Submit</button>
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
                    @empty
                    <p>no data</p>
                    @endforelse
                  </div>
                  <div class="tab-pane fade" id="sedangberjalan" role="tabpanel" aria-labelledby="sedangberjalan-tab">
                    @forelse ($sedangberjalan as $o)
                    <div class="card shadow-sm">
                      <div class="card-header bg-white">
                        Tanggal sewa : {{ $o -> tanggal_sewa -> toFormattedDateString() }}
                      </div>
                      <div class="card-body pt-2 pb-2 border-bottom">
                        <div class="row">
                          <div class="col-sm-5 border-right">
                            Peminjam
                            <h1 data-toggle="tooltip" data-placement="top" title="Phone : {{ $o -> no_hp }}">{{ $o -> nama }}</h1>
                            {{ $o -> acara }}, {{ $o -> alamat }}
                          </div>
                          <div class="col-sm-4 border-right">
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
                          <div class="col-sm-3">
                            Total biaya sewa
                            <h3>Rp {{ $o -> total_pembayaran }}</h3>
                            {{ $o -> jumlah_unit }} Unit, {{ $o -> jumlah_hari }} hari.
                          </div>
                        </div>
                      </div>
                      <div class="card-body pt-2 pb-2">
                        <div class="row">
                          <div class="col-sm-6 border-right">
                            ({{$o -> id}}) Code
                            <h1 class="text-monospace">{{ $o -> kode }}</h1>
                          </div>
                          <div class="col-sm-3">
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
                          <div class="col-sm-3 text-center align-self-center">
                            <div class="dropdown">
                              <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Menu
                              </button>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                <button class="dropdown-item" type="button" data-toggle="modal" data-target="#cekdp{{$o->id}}">Lihat DP</button>
                                <button class="dropdown-item" type="button" data-toggle="modal" data-target="#cekjaminan{{$o->id}}">Lihat jaminan</button>
                                <button class="dropdown-item" type="button" data-toggle="modal" data-target="#selesai{{$o->id}}">Selesai</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="card-footer bg-white">
                        <div class="row">
                          <div class="col-sm-auto text-center border-right">
                            <a href="{{route('notauser',$o->id)}}" target="_blank" class="badge badge-primary">Lihat detail order</a>
                          </div>
                          <div class="col-sm-auto">
                            Tanggal kembali : {{Carbon\Carbon::parse($o->tanggal_kembali)->toFormattedDateString()}}
                          </div>
                        </div>
                      </div>
                    </div> <br>

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

                    <!-- Modal Selesai -->
                    <div class="modal fade" id="selesai{{$o->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Konfirmasi selesai order : ID {{$o->id}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form method="POST" action="{{route('userselesai',$o->id)}}">
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
                    @empty
                    <p>no data</p>
                    @endforelse
                  </div>
                  <div class="tab-pane fade" id="selesai" role="tabpanel" aria-labelledby="selesai-tab">
                    @forelse ($selesai as $o)
                    <div class="card shadow-sm">
                      <div class="card-header bg-white">
                        Tanggal sewa : {{ $o -> tanggal_sewa -> toFormattedDateString() }}
                      </div>
                      <div class="card-body pt-2 pb-2 border-bottom">
                        <div class="row">
                          <div class="col-sm-5 border-right">
                            Peminjam
                            <h1 data-toggle="tooltip" data-placement="top" title="Phone : {{ $o -> no_hp }}">{{ $o -> nama }}</h1>
                            {{ $o -> acara }}, {{ $o -> alamat }}
                          </div>
                          <div class="col-sm-4 border-right">
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
                          <div class="col-sm-3">
                            Total biaya sewa
                            <h3>Rp {{ $o -> total_pembayaran }}</h3>
                            {{ $o -> jumlah_unit }} Unit, {{ $o -> jumlah_hari }} hari.
                          </div>
                        </div>
                      </div>
                      <div class="card-body pt-2 pb-2">
                        <div class="row">
                          <div class="col-sm-6 border-right">
                            ({{$o -> id}}) Code
                            <h1 class="text-monospace">{{ $o -> kode }}</h1>
                          </div>
                          <div class="col-sm-3">
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
                          <div class="col-sm-3 text-center align-self-center">
                            <div class="dropdown">
                              <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Menu
                              </button>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                <button class="dropdown-item" type="button" data-toggle="modal" data-target="#cekdp{{$o->id}}">Lihat DP</button>
                                <button class="dropdown-item" type="button" data-toggle="modal" data-target="#cekjaminan{{$o->id}}">Lihat jaminan</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="card-footer bg-white">
                        <div class="row">
                          <div class="col-sm-auto text-center border-right">
                            <a href="{{route('notauser',$o->id)}}" target="_blank" class="badge badge-primary">Lihat detail order</a>
                          </div>
                          <div class="col-sm-auto">
                            Tanggal kembali : {{Carbon\Carbon::parse($o->tanggal_kembali)->toFormattedDateString()}}
                          </div>
                        </div>
                      </div>
                    </div> <br>

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
                    @empty
                    <p>no data</p>
                    @endforelse
                  </div>
                  <div class="tab-pane fade" id="pembatalan" role="tabpanel" aria-labelledby="pembatalan-tab">
                    @forelse ($pembatalan as $o)
                    <div class="card shadow-sm">
                      <div class="card-header bg-white">
                        Tanggal sewa : {{ $o -> tanggal_sewa -> toFormattedDateString() }}
                      </div>
                      <div class="card-body pt-2 pb-2 border-bottom">
                        <div class="row">
                          <div class="col-sm-5 border-right">
                            Peminjam
                            <h1 data-toggle="tooltip" data-placement="top" title="Phone : {{ $o -> no_hp }}">{{ $o -> nama }}</h1>
                            {{ $o -> acara }}, {{ $o -> alamat }}
                          </div>
                          <div class="col-sm-4 border-right">
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
                          <div class="col-sm-3">
                            Total biaya sewa
                            <h3>Rp {{ $o -> total_pembayaran }}</h3>
                            {{ $o -> jumlah_unit }} Unit, {{ $o -> jumlah_hari }} hari.
                          </div>
                        </div>
                      </div>
                      <div class="card-body pt-2 pb-2">
                        <div class="row">
                          <div class="col-sm-6 border-right">
                            ({{$o -> id}}) Code
                            <h1 class="text-monospace">{{ $o -> kode }}</h1>
                          </div>
                          <div class="col-sm-3">
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
                          <div class="col-sm-3 text-center align-self-center">
                            <div class="dropdown">
                              <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" disabled>
                                Menu
                              </button>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                <button class="dropdown-item" type="button" data-toggle="modal" data-target="#cekdp{{$o->id}}">Lihat DP</button>
                                <button class="dropdown-item" type="button" data-toggle="modal" data-target="#cekjaminan{{$o->id}}">Lihat jaminan</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="card-footer bg-white">
                        <div class="row">
                          <div class="col-sm-auto text-center border-right">
                            <a href="{{route('notauser',$o->id)}}" target="_blank" class="badge badge-primary">Lihat detail order</a>
                          </div>
                          <div class="col-sm-auto">
                            Tanggal kembali : {{Carbon\Carbon::parse($o->tanggal_kembali)->toFormattedDateString()}}
                          </div>
                        </div>
                      </div>
                    </div> <br>
                    @empty
                    <p>no data</p>
                    @endforelse
                  </div>
                  <div class="tab-pane fade" id="dibatalkan" role="tabpanel" aria-labelledby="dibatalkan-tab">
                    @forelse ($dibatalkan as $o)
                    <div class="card shadow-sm">
                      <div class="card-header bg-white">
                        Tanggal sewa : {{ $o -> tanggal_sewa -> toFormattedDateString() }}
                      </div>
                      <div class="card-body pt-2 pb-2 border-bottom">
                        <div class="row">
                          <div class="col-sm-5 border-right">
                            Peminjam
                            <h1 data-toggle="tooltip" data-placement="top" title="Phone : {{ $o -> no_hp }}">{{ $o -> nama }}</h1>
                            {{ $o -> acara }}, {{ $o -> alamat }}
                          </div>
                          <div class="col-sm-4 border-right">
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
                          <div class="col-sm-3">
                            Total biaya sewa
                            <h3>Rp {{ $o -> total_pembayaran }}</h3>
                            {{ $o -> jumlah_unit }} Unit, {{ $o -> jumlah_hari }} hari.
                          </div>
                        </div>
                      </div>
                      <div class="card-body pt-2 pb-2">
                        <div class="row">
                          <div class="col-sm-6 border-right">
                            ({{$o -> id}}) Code
                            <h1 class="text-monospace">{{ $o -> kode }}</h1>
                          </div>
                          <div class="col-sm-3">
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
                          <div class="col-sm-3 text-center align-self-center">
                            <div class="dropdown">
                              <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" disabled>
                                Menu
                              </button>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                <button class="dropdown-item" type="button" data-toggle="modal" data-target="#cekdp{{$o->id}}">Lihat DP</button>
                                <button class="dropdown-item" type="button" data-toggle="modal" data-target="#cekjaminan{{$o->id}}">Lihat jaminan</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="card-footer bg-white">
                        <div class="row">
                          <div class="col-sm-auto text-center border-right">
                            <a href="{{route('notauser',$o->id)}}" target="_blank" class="badge badge-primary">Lihat detail order</a>
                          </div>
                          <div class="col-sm-auto">
                            Tanggal kembali : {{Carbon\Carbon::parse($o->tanggal_kembali)->toFormattedDateString()}}
                          </div>
                        </div>
                      </div>
                    </div> <br>
                    @empty
                    <p>no data</p>
                    @endforelse
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header" id="headingThree">
              <h2 class="mb-0">
                <button class="btn btn-light collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                  Media Partner <span class="badge badge-primary badge-pill">Coming soon</span>
                </button>
              </h2>
            </div>
            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
              <div class="card-body">
                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
</div>

<script type="text/javascript">
    $('.date').datepicker({
       format: 'Y-m-d'
     });
</script>


</script>

@endsection
