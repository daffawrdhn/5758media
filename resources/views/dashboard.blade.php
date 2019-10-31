@extends('layouts.navbar_admin')

@section('content')
<div class="container">
      <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Users</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Orders</a>
        </li>
        </ul>
        <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
          <div class="row justify-content-center">
              <div class="col-md-8">
              <br>
                  <div class="card">
                      <div class="card-header">Dashboard</div>

                      <div class="card-body">
                          @if (session('status'))
                              <div class="alert alert-success" role="alert">
                                  {{ session('status') }}
                              </div>
                          @endif

                          You are logged in as admin!
                      </div>
                  </div>
              </div>
          </div>
        </div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
          <div class="row justify-content-center">
              <div class="col-xl-12">
              <br>
                  <div class="card">
                      <div class="card-header">User Role</div>

                      <div class="card-body">
                        <div class="table-responsive">
                          <table class="table table-hover">
                            <thead>
                              <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Phone</th>
                                <th scope="col">User type</th>
                                <th scope="col">Email</th>
                                <th scope="col">Option</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach ($users as $row)
                              <tr>
                                <td>{{ $row -> id }}</td>
                                <td>{{ $row -> name }}</td>
                                <td>{{ $row -> phone }}</td>
                                <td>{{ $row -> usertype }}</td>
                                <td>{{ $row -> email }}</td>
                                <td>
                                  <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      Options
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                      <!-- Button trigger modal -->
                                      <button type="button" class="dropdown-item" data-toggle="modal" data-target="#edit{{ $row -> id }}">
                                        Edit
                                      </button>

                                      <button type="button" class="dropdown-item" data-toggle="modal" data-target="#delete{{ $row -> id }}">
                                        Delete
                                      </button>

                                      <!-- <button class="dropdown-item" href="/dashboard/user/delete/{{ $row -> id }}">Delete</button> -->
                                    </div>

                                    <!-- Modal Edit-->
                                    <div class="modal fade" id="edit{{ $row -> id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">User edit</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                          </div>
                                          <div class="modal-body">
                                            <form action="/dashboard/user/edit/update/{{ $row -> id }}" method="POST">

                                              {{ csrf_field() }}
                                              {{ method_field('PUT') }}

                                              <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" name="name" class="form-control" id="name" aria-describedby="name" placeholder="{{ $row -> name}}" value="{{ $row -> name}}">
                                              </div>
                                              <div class="form-group">
                                                <label for="phone">Phone</label>
                                                <input type="number" name="phone" class="form-control" id="phone" aria-describedby="phone" placeholder="{{ $row -> phone}}" value="{{ $row -> phone}}">
                                              </div>
                                              <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" name="email" class="form-control" id="email" placeholder="{{ $row -> email}}" value="{{ $row -> email}}">
                                                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                                              </div>
                                              <div class="form-group">
                                                <label for="usertype">User Type</label>
                                                <select class="form-control" id="usertype" name="usertype" value="{{ $row -> usertype}}">
                                                  <option selected value="{{ $row -> usertype }}">{{ $row -> usertype }}</option>
                                                  <option value="admin">Admin</option>
                                                  <option value="user">User</option>
                                                </select>
                                              </div>
                                              <div class="form-group">
                                                <label for="created_at">Date created</label>
                                                <input type="created_at" name="created_at" class="form-control" id="created_at" placeholder="{{ $row -> created_at}}" value="{{ $row -> created_at}}" readonly>
                                              </div>
                                                <br>
                                                <div class="modal-footer">
                                                  <p><small>Last update: {{ $row -> updated_at }}</small></p>
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
                                    <div class="modal fade" id="delete{{ $row -> id }}" tabindex="-1" role="dialog" aria-labelledby="AexampleModalLabel" aria-hidden="true">
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
                                            <a class="btn btn-danger" role="button" href="/dashboard/user/delete/{{ $row -> id }}">Confirm</a>
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
                  </div>
              </div>
          </div>
        </div>



        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
          <div class="row justify-content-center">
              <div class="col-xl-12">
              <br>
          <div class="card">
              <div class="card-header">User orders</div>

              <div class="card-body">
              <div class="table-responsive">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th scope="col">ID</th>
                      <th scope="col">Kode</th>
                      <th scope="col">Nama</th>
                      <th scope="col">Alamat</th>
                      <th scope="col">Paket</th>

                      <th scope="col">Acara</th>
                      <th scope="col">Nomor hp</th>
                      <th scope="col">Jaminan</th>
                      <th scope="col">Upload jaminan</th>

                      <th scope="col">Harga unit</th>
                      <th scope="col">Jumlah unit</th>
                      <th scope="col">Jumlah hari</th>
                      <th scope="col">Tanggal sewa</th>
                      <th scope="col">Tanggal kembali</th>

                      <th scope="col">Total pembayaran</th>
                      <th scope="col">DP</th>
                      <th scope="col">Tanggal dp</th>
                      <th scope="col">Pelunasan</th>
                      <th scope="col">Tanggal pelunasan</th>

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

                      <td>{{ $o -> nama }}</td>
                      <td>{{ $o -> alamat }}</td>

                      <td>{{ $o -> paket }}</td>

                      <td>{{ $o -> acara }}</td>
                      <td>{{ $o -> no_hp }}</td>
                      <td>{{ $o -> jenis_jaminan }}</td>
                      <td>{{ $o -> upload_jaminan }}</td>

                      <td>{{ $o -> harga_unit }}</td>
                      <td>{{ $o -> jumlah_unit }}</td>
                      <td>{{ $o -> jumlah_hari }}</td>
                      <td>{{ $o -> tanggal_sewa }}</td>
                      <td>{{ $o -> tanggal_kembali }}</td>

                      <td>{{ $o -> total_pembayaran }}</td>
                      <td>{{ $o -> dp }}</td>
                      <td>{{ $o -> tanggal_dp }}</td>
                      <td>{{ $o -> pelunasan }}</td>
                      <td>{{ $o -> tanggal_pelunasan }}</td>

                      <td>@if($o->status =='0')
                              <p>Menunggu di proses</p>

                        @elseif($o->status =='1')
                              <p>Proses pembayaran</p>

                        @elseif($o->status =='2')
                              <p>Pembayaran di konfirmasi</p>

                        @elseif($o->status =='3')
                              <p>Proses jaminan</p>

                        @elseif($o->status =='4')
                              <p>Jaminan di konfirmasi</p>

                        @elseif($o->status =='5')
                              <p>Sewa berjalan</p>

                        @elseif($o->status =='6')
                              <p>Sewa selesai</p>


                        @elseif($o->status =='98')
                              <p>proses pembatalan order</p>
                        @elseif($o->status =='99')
                              <p>Pesanan dibatalkan</p>
                        @else
                              <p>eror</p>
                        @endif
                      </td>

                      <td>{{ $o -> keterangan }}</td>
                      <td>
                        <div class="dropdown">
                          <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Option
                          </button>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <button type="button" class="dropdown-item" data-toggle="modal" data-target="#prosesorder{{ $o -> id }}">
                              Proses
                            </button>
                            <button type="button" class="dropdown-item" data-toggle="modal" data-target="#deleteorder{{ $o -> id }}">
                              Delete
                            </button>

                          </div>


                          <!-- Modal proses Order -->
                          <div class="modal fade" id="prosesorder{{ $o -> id }}" tabindex="-1" role="dialog" aria-labelledby="newOrderLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="prosesorder{{ $o -> id }}">Order ID {{ $o -> id }}</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <form method="POST" action="/dashboard/order/proses/{{ $o -> id }}">
                                    {{ csrf_field() }}
                                    {{ method_field('PUT') }}
                                    <div class="form-row">
                                      <div class="form-group col-md-6">
                                        <label >Nama penyewa</label>
                                        <input type="text" name="nama" class="form-control"  value="{{ $o -> nama }}" readonly>
                                      </div>
                                      <div class="form-group col-md-6">
                                        <label for="no_hp">Nomor telfon</label>
                                        <input type="text" name="no_hp" class="form-control" id="no_hp"  value="{{ $o -> no_hp }}" readonly>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label for="alamat">Alamat / Fakultas dan jurusan </label>
                                      <input type="text" name="alamat" class="form-control" id="alamat" value="{{ $o -> alamat }}"readonly>
                                    </div>
                                    <div class="form-row">
                                    <div class="form-group col-md-6">
                                      <label for="acara">Acara</label>
                                      <input type="text" name="acara" class="form-control" id="acara" value="{{ $o -> acara }}"readonly>
                                    </div>
                                    <div class="form-group col-md-6">
                                      <label for="paket">Paket</label>
                                      <input type="text" name="paket" class="form-control" id="paket" value="{{ $o -> paket }}"readonly>
                                    </div>
                                    </div>
                                    <div class="form-row">
                                      <div class="form-group col-md-6">
                                        <label for="tanggal_sewa">Tanggal sewa</label>
                                        <input type="text" name="tanggal_sewa" class="form-control" id="tanggal_sewa" value="{{ $o -> tanggal_sewa }}"readonly>
                                      </div>
                                      <div class="form-group col-md-4">
                                        <label for="jumlah_hari">Jumlah hari</label>
                                        <input type="text" name="jumlah_hari" class="form-control" id="jumlah_hari" value="{{ $o -> jumlah_hari }}"readonly>
                                      </div>
                                      <div class="form-group col-md-2">
                                        <label for="jumlah_unit">Unit</label>
                                        <input type="text" name="jumlah_unit" class="form-control" id="jumlah_unit" value="{{ $o -> jumlah_unit }}"readonly>
                                      </div>
                                    </div>
                                    <div class="form-row">
                                    <div class="form-group col-md-6">
                                      <label for="status_lama">Status</label>
                                      <input type="text" name="status_lama" class="form-control" id="status_lama" placeholder="{{ $o -> status}}"readonly>
                                    </div>
                                    <div class="form-group col-md-6">
                                      <label for="status_baru">Example select</label>
                                      <select class="form-control" name="status_baru" id="status_baru">
                                        <option value="1">Konfirmasi order</option>
                                        <option value="3">Konfirmasi dp</option>
                                        <option value="5">Konfirmasi jaminan & pelunasan</option>
                                        <option value="6">Selesai order</option>
                                        <option value="99">Batalkan order</option>
                                      </select>
                                    <!-- <select id="status" name="status" class="form-control">
                                      <option selected>Pilih..</option>

                                              @if ( $o->status = '0')
                                              <option value="1">Konfirmasi order</option>
                                              @elseif ($o->status =='2')
                                              <option value="3">Konfirmasi dp</option>
                                              @elseif ($o->status =='4')
                                              <option value="5">Konfirmasi jaminan & pelunasan</option>
                                              @elseif ($o->status =='5')
                                              <option value="6">Selesai order</option>
                                              @elseif ($o->status =='98')
                                              <option value="99">Batalkan order</option>

                                              @endif

                                    </select> -->
                                    </div>
                                    <div class="form-row">
                                    <span>Pembayaran</span>
                                    <div class="form-group col-md-6">
                                      <img src="{{ url('/dp_upload/'.$o -> dp_upload) }}" class="img-fluid" alt="Responsive image">
                                    </div>
                                    <div class="form-group col-md-6">
                                      <label for="dp">Nominal DP</label>
                                      <input type="text" name="dp" class="form-control" id="dp" placeholder="{{ $o -> dp }}" readonly>
                                      </div>
                                    </div>

                                    <div class="form-row">
                                    <span>Pelunasan</span>
                                    <div class="form-group col-md-6">
                                      <img src="{{ url('/dp_upload/'.$o -> dp_upload) }}" class="img-fluid" alt="Responsive image">
                                    </div>
                                    <div class="form-group col-md-6">
                                      <label for="dp">Nominal DP</label>
                                      <input type="text" name="dp" class="form-control" id="dp" placeholder="{{ $o -> dp }}" readonly>
                                      </div>
                                    </div>





                                    </div>

                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                      <button type="submit" class="btn btn-primary pull-right">Proses</button>
                                    </div>

                                  </form>

                                </div>

                              </div>
                            </div>
                          </div>

                          <!-- Modal order Delete-->
                          <div class="modal fade" id="deleteorder{{ $o -> id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Delete confirmation</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  Are you sure want to delete this order ?
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  <a class="btn btn-danger" role="button" href="/dashboard/order/delete/{{ $o -> id }}">Confirm</a>
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
          </div>
        </div>
      </div>

        </div>
    </div>
</div>

<script type="text/javascript">

    $('.date').datepicker({

       format: 'yyyy-mm-dd'

     });

</script>

@endsection
