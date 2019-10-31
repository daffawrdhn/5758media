@extends('layouts.navbar_user')

@section('content')

<div class="container">
    <div class="row justify-content-center">

      <div class="jumbotron">
        <h1 class="display-4">Hello, {{ Auth::user()->name }}!</h1>
        <p class="lead">Selamat datang di 5758 Media dashboard, kami berusaha memudahkan pelanggan untuk berinteraksi dengan sistem.</p>
        <hr class="my-4">
        <p>untuk melihat profile pengguna silahkan button profile, dan button new order untuk memulai memesan.</p>
        <!-- Button trigger modal -->

        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
          My profile
        </button>
        |
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newOrder">
          New order
        </button>

      </div>

    </div>
</div>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-11">
        <div class="card">
            <div class="card-header">Dashboard</div>

            <div class="card-body h-100">

                <ul class="nav nav-tabs" id="myTab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Home</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">My Orders</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">My Sponsorship</a>
                  </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                    <br>
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

                    You are logged in!
                  </div>
                  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="table-responsive">
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Kode</th>

                            <!-- <th scope="col">Nama</th> -->
                            <th scope="col">Acara</th>
                            <th scope="col">Paket</th>

                            <th scope="col">Alamat</th>
                            <th scope="col">Nomor hp</th>
                            <!-- <th scope="col">Jaminan</th>
                            <th scope="col">No jaminan</th>

                            <th scope="col">Harga unit</th> -->
                            <th scope="col">Jumlah unit</th>
                            <th scope="col">Jumlah hari</th>
                            <th scope="col">Tanggal sewa</th>
                            <!-- <th scope="col">Tanggal kembali</th> -->

                            <!-- <th scope="col">Total pembayaran</th>
                            <th scope="col">DP</th>
                            <th scope="col">Tanggal dp</th>
                            <th scope="col">Pelunasan</th>
                            <th scope="col">Tanggal pelunasan</th> -->

                            <th scope="col">Status</th>
                            <th scope="col">Keterangan</th>
                            <th scope="col"></th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($orders as $o)
                          <tr>
                            <td>{{ $o -> id }}</td>
                            <td>{{ $o -> kode }}</td>
                            <!-- <td>{{ $o -> nama }}</td> -->
                            <td>{{ $o -> acara }}</td>
                            <td>
                              @if($o-> paket =='1')
                                      <p>Normal</p>
                                @elseif($o->paket =='2')
                                      <p>Media partner</p>
                                @else
                                      <p>paket eror</p>
                                @endif
                            </td>

                            <td>{{ $o -> alamat }}</td>
                            <td>{{ $o -> no_hp }}</td>
                            <!-- <td>{{ $o -> jenis_jaminan }}</td>
                            <td>{{ $o -> upload_jaminan }}</td>

                            <td>{{ $o -> harga_unit }}</td> -->
                            <td>{{ $o -> jumlah_unit }}</td>
                            <td>{{ $o -> jumlah_hari }}</td>
                            <td>{{ $o -> tanggal_sewa }}</td>
                            <!-- <td>{{ $o -> tanggal_kembali }}</td> -->

                            <!-- <td>{{ $o -> total_pembayaran }}</td>
                            <td>{{ $o -> dp }}</td>
                            <td>{{ $o -> tanggal_dp }}</td>
                            <td>{{ $o -> pelunasan }}</td>
                            <td>{{ $o -> tanggal_pelunasan }}</td> -->

                            <td>
                              @if($o->status =='0')
                                      <p>Menunggu di proses</p>

                                @elseif($o->status =='1')
                                      <p>Konfirmasi Pembayaran</p>

                                @elseif($o->status =='2')
                                      <p>Pembayaran diproses</p>

                                @elseif($o->status =='3')
                                      <p>Konfirmasi pelunasan & jaminan</p>

                                @elseif($o->status =='4')
                                      <p>Pelunasan & jaminan diproses</p>

                                @elseif($o->status =='5')
                                      <p>Sewa berjalan</p>

                                @elseif($o->status =='6')
                                      <p>Sewa selesai</p>


                                @elseif($o->status =='98')
                                      <p>Pesanan dibatalkan</p>
                                @elseif($o->status =='99')
                                      <p>Pesanan dibatalkan</p>
                                @else
                                      <p>eror</p>
                                @endif
                            </td>
                            <td>{{ $o -> keterangan }}</td>
                            <td>
                              <div class="dropdown">
                                <!-- <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Option
                                </button> -->

                                @if($o->status =='99' or $o->status =='98' or $o->status =='2' or $o->status =='4')
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" disabled>
                                          Option
                                        </button>
                                  @else
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          Option
                                        </button>
                                  @endif


                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                  @if($o->status =='0')
                                    <button type="button" class="dropdown-item" data-toggle="modal" data-target="#pembatalan{{ $o -> id }}">
                                      Ajukan pembatalan
                                    </button>
                                  @elseif($o->status =='1')
                                    <button type="button" class="dropdown-item" data-toggle="modal" data-target="#pembayaran{{ $o -> id }}">
                                      Konfirmasi pembayaran
                                    </button>
                                    <button type="button" class="dropdown-item" data-toggle="modal" data-target="#pembatalan{{ $o -> id }}">
                                      Ajukan pembatalan
                                    </button>
                                  @elseif ($o->status =='3')
                                    <button type="button" class="dropdown-item" data-toggle="modal" data-target="#pelunasan{{ $o -> id }}">
                                      Konfirmasi
                                    </button>
                                  @elseif ($o->status =='5')
                                    <button type="button" class="dropdown-item" data-toggle="modal" data-target="#edit{{ $o -> id }}">
                                      Selesai
                                    </button>
                                  @endif
                                </div>

                                  <!-- modal pembatalan  -->
                                <div class="modal fade" id="pembatalan{{ $o -> id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Pembatalan pesanan | ID: {{ $o -> id }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                        <form action="/home/order/batalkan/{{ $o -> id }}" method="POST">

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

                                <!-- Modal exampleBatalkan -->
                                <!-- <div class="modal fade" id="exampleBatalkan{{ $o -> id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                        <form method="POST" action="/home/order/batalkan/{{ $o -> id}}">
                                                  {{ csrf_field() }}
                                                  {{ method_field('PUT') }}
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                          <a type="button" href="/home/order/batalkan/{{ $o -> id}}" class="btn btn-primary">Save changes</a>
                                        </div>
                                        </form>
                                      </div>

                                    </div>
                                  </div>
                                </div> -->



                                <!-- Modal DP -->
                                <div class="modal fade" id="pembayaran{{ $o -> id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Pembatalan pesanan | ID: {{ $o -> id }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                        <form action="/home/order/pembayaran/{{ $o -> id }}" method="POST" enctype="multipart/form-data">

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

                                <!-- Modal Pelunasan -->
                                <div class="modal fade" id="pelunasan{{ $o -> id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Pembatalan pesanan | ID: {{ $o -> id }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                        <form action="/home/order/pelunasan/{{ $o -> id }}" method="POST" enctype="multipart/form-data">

                                          {{ csrf_field() }}
                                          {{ method_field('PUT') }}

                                          <div class="form-row">
                                          <div class="form-group col-md-6">
                                            <b>Upload jaminan</b><br/>
                                            <input type="file" name="upload_jaminan">
                                          </div>

                                          <div class="form-group col-md-6">
                                            <label for="jenis_jaminan">Jaminan</label>
                                            <select class="form-control" name="jenis_jaminan" id="jenis_jaminan">
                                              <option value="KTP">KTP</option>
                                              <option value="KTM">KTM</option>
                                              <option value="SIM">SIM</option>
                                            </select>
                                          </div>
                                          </div>

                                          <div class="form-group col-md-12">
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


                              </div>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal newOrder -->
<div class="modal fade" id="newOrder" tabindex="-1" role="dialog" aria-labelledby="newOrderLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newOrderLabel">Sewa baru - {{ Auth::user()->name }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="/home/new_order">
                  {{ csrf_field() }}
          <div class="form-row">
            <div class="form-group col-md-6">
              <label >Nama penyewa</label>
              <input type="text" name="nama" class="form-control" placeholder="{{ Auth::user()->name }}" value="{{ Auth::user()->name }}" readonly>
              <small class="form-text text-muted">Nama penyewa haru sama dengan Jaminan.</small>
            </div>
            <div class="form-group col-md-6">
              <label for="no_hp">Nomor telfon</label>
              <input type="text" name="no_hp" class="form-control" id="no_hp" placeholder="{{ Auth::user()->phone }}" value="{{ Auth::user()->phone }}" readonly>
            </div>
          </div>
          <div class="form-group">
            <label for="alamat">Alamat / Fakultas dan jurusan </label>
            <input type="text" name="alamat" class="form-control" id="alamat" placeholder="Alamat / Fakultas dan jurusan">
          </div>
          <div class="form-row">
          <div class="form-group col-md-6">
            <label for="acara">Acara</label>
            <input type="text" name="acara" class="form-control" id="acara" placeholder="Nama acara / kegiatan">
          </div>
          <div class="form-group col-md-6">
            <label for="paket">Paket</label>
            <select id="paket" name="paket" class="form-control">
              <option selected>Pilih..</option>
                <option value="1">Normal</option>
                <option value="2">Media Partner</option>
            </select>
          </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="tanggal_sewa">Tanggal sewa</label>
              <input type="date" name="tanggal_sewa" class="form-control" id="tanggal_sewa">
            </div>
            <div class="form-group col-md-4">
              <label for="jumlah_hari">Jumlah hari</label>
              <select id="jumlah_hari" name="jumlah_hari" class="form-control">
                <option selected>Pilih..</option>
                    @for ($i = 1; $i < 11; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
              </select>
            </div>
            <div class="form-group col-md-2">
              <label for="jumlah_unit">Unit</label>
              <select id="jumlah_unit" name="jumlah_unit" class="form-control">
                <option selected>Pilih..</option>
                    @for ($i = 1; $i < 21; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
              </select>
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

<script type="text/javascript">

    $('.date').datepicker({
       format: 'Y-m-d'
     });
</script>
@endsection
