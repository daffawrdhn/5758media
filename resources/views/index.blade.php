@extends('welcome')

@section('content')

@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif

<div id="panel1" class="container vh-auto d-flex flex-column justify-content-center font-5758" style="min-height: 100vh;">
  <div class="row ">
    <div class="col-sm-6 d-flex flex-column justify-content-center">
      <div class="container">
        <h1 class="display-1 font-weight-bold linear-wipe text-left">5758</h1>
        <p class="text-left">5758Media merupakan penyedia persewaan HT termurah untuk daerah Jember dan sekitarnya. Didirikan sejak Oktober 2019. Kami menyewakan HT berkualitas dengan merek Baofeng tipe 888s .</p>
        <div class="row">
          <div class="col-sm-12 d-flex justify-content-start">
            <p><a class="btn btn-outline-primary btn-lg shadow" href="#fact" role="button">Lihat fakta &ddarr;</a></p>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 d-flex flex-column justify-content-center">
      <div class="row">
        <div class="col-sm-12 d-flex flex-column align-items-center pb-3">
          <p>Yuk cek ketersediaan unit untuk tanggal acaramu</p>
          <div class="content">
            <div class="card shadow-sm" style="min-width: 352px;">
              <div class="card-body">
                <form action="{{route('sonya')}}" method="GET">
                  <div class="row">
                    <div class="col-sm-12 d-flex flex-column align-items-center">
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                        </div>
                        <input type="text" class="form-control date" name="tanggal" id="tanggal" placeholder="Tanggal sewa" style="width: 85%;"/>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6 d-flex flex-column align-items-center">
                      <label for="hari">Jumlah hari</label>
                      <select id="hari" name="hari" class="form-control">
                        <option selected>Pilih..</option>
                        @for ($i = 1; $i < 11; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                      </select>
                    </div>
                    <div class="col-sm-6 d-flex flex-column align-items-center">
                      <label for="unit">Unit</label>
                      <select id="unit" name="unit" class="form-control">
                        <option selected>Pilih..</option>
                        @for ($i = 1; $i < 31; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                      </select>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12 d-flex justify-content-end mt-4">
                      <button type="submit " value="cari" class="btn btn-outline-secondary btn-lg">Cek</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <p class="text-muted text-center pt-2">
            *Maksimal peminjaman 30 Unit.<br>
            *Maksimal durasi peminjaman 10 hari.
          </p>
        </div>
      </div>
      <div class="row border-top">
        <div class="col-sm-12 d-flex flex-column align-items-center pt-3">
          <p class="text-center">Mari kita lihat status peminjamanmu dengan memasukkan KODE order.</p>
          <div class="content">
            <div class="card shadow" style="min-width: 352px;">
              <div class="card-body">
                <div class="input-group">
                  <input id="myInput" type="text" class="form-control" placeholder="Kode nota" aria-label="Recipient's username" aria-describedby="basic-addon2">
                  <div class="input-group-append">
                    <button type="button" onclick="getInputNota();" class="btn btn-outline-secondary">Cek</button>
                  </div>
                </div>
              </div>
            </div>
            <p class="text-muted text-center pt-2">*besar kecil huruf berpengaruh.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div id="fact" class="container-fluid vh-auto d-flex flex-column justify-content-center font-5758 gradient-5758" style="min-height: 100vh;">
  <div id="fakta" class="container">
    <div class="card">
      <div class="card-header">
        5758 Media
      </div>
      <div class="card-body">
        <div class="row">

          <div class="col-sm-6 d-flex flex-column justify-content-center">

            <div class="row pt-3">
              <div class="col-sm-12 d-flex flex-column justify-content-center align-items-center">
                <div class="row">
                  <div class="col-sm-6 d-flex flex-column">
                    <h1 class="display-4 text-center">{{$totalorders}}</h1>
                  </div>
                  <div class="col-sm-6 d-flex flex-column">
                    <p class="text-left">Peminjaman telah berhasil dilakukan mulai dari 5758Media berdiri sampai sekarang.</p>
                  </div>
                </div>
              </div>
            </div>

            <div class="row border-top pt-4">
              <div class="col-sm-12 d-flex flex-column justify-content-center align-items-center">
                <div class="row">
                  <div class="col-sm-6 d-flex flex-column">
                    <h1 class="display-4 text-center">{{$totalmediapartners}}</h1>
                  </div>
                  <div class="col-sm-6 d-flex flex-column">
                    <p class="text-left">{{$totalmediapartners}} dari {{$totalorders}} Peminjaman atau {{($totalmediapartners/$totalorders)*100}}% dari peminjaman memilih media partner .</p>
                  </div>
                </div>
              </div>
            </div>

            <div class="row border-top pt-4">
              <div class="col-sm-12 d-flex flex-column justify-content-center align-items-center">
                <div class="row">
                  <div class="col-sm-6 d-flex flex-column">
                    <h1 class="display-4 text-center">{{round($averageunits)}}</h1>
                  </div>
                  <div class="col-sm-6 d-flex flex-column">
                    <p class="text-left">Rata-rata banyak unit yang disewa untuk sekali peminjaman dari {{$totalorders}} data peminjaman.</p>
                  </div>
                </div>
              </div>
            </div>

            <div class="row border-top pt-4">
              <div class="col-sm-12 d-flex flex-column justify-content-center align-items-center">
                <div class="row">
                  <div class="col-sm-6 d-flex flex-column">
                    <h1 class="display-4 text-center">{{$days}}</h1>
                  </div>
                  <div class="col-sm-6 d-flex flex-column">
                    <p class="text-left">Hari telah kami lalui untuk menjaga kepercayaan peminjan dan berjalannya jasa kami.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6 d-flex flex-column justify-content-center">
            <div class="container">
              <h1 class="display-2 font-weight-bold text-center">Fakta</h1>
              <p class="text-center">Fakta mengenai 5758Media yang harus kalian ketahui sekaligus menjadi transparasi data dan jasa kami kepada client agar semakin percaya.</p>
              <div class="row">
                <div class="col-sm-12 d-flex justify-content-center">
                  <p><a class="btn btn-outline-primary btn-lg shadow" href="#panel2" role="button">Lihat harga &ddarr;</a></p>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>

</div>

<div id="panel2" class="container vh-auto d-flex flex-column align-items-center justify-content-center font-5758" style="min-height: 100vh;">

  <div class="pricing-header px-3 py-5 pt-md-5 pb-md-4 mx-auto text-center">
    <h1 class="display-2 font-weight-bold">Harga</h1>
    <p>Harga murah, bersahabat bukan?</p>
  </div>

  <div class="card-deck mb-3 text-center">
    <div class="card mb-4 shadow">
      <div class="card-header gradient-5758">
        <h4 class="my-0 font-weight-normal text-white">Normal</h4>
      </div>
      <div class="card-body">
        <h1 class="card-title pricing-card-title">Rp 9.000</small></h1>
        <ul class="list-unstyled mt-3 mb-4">
          <li>Minimal > 1 Unit</li>
          <li><del>Feedback</del></li>
          <li><del>Prioritas</del></li>
          <li>Fullset</li>
        </ul>
        @if (Auth::guest())
        <a class="btn btn-lg btn-block btn-outline-primary" href="{{ route('register') }}" role="button">Daftar sekarang</a>
        @elseif (Auth::check())
        <a class="btn btn-lg btn-block btn-outline-primary" href="#" role="button" data-toggle="modal" data-target=".pesan-normal">Pesan</a>
        @endif
      </div>
    </div>
    <div class="card mb-4 shadow">
      <div class="card-header gradient-5758">
        <h4 class="my-0 font-weight-normal text-white">Media partner</h4>
      </div>
      <div class="card-body">
        <h1 class="card-title pricing-card-title">Rp 5.000</h1>
        <ul class="list-unstyled mt-3 mb-4">
          <li>Minimal > 10 Unit</li>
          <li>Feedback</li>
          <li>Prioritas</li>
          <li>Fullset</li>
        </ul>
        @if (Auth::guest())
        <a class="btn btn-lg btn-block btn-primary" href="{{ route('register') }}" role="button">Yuk mulai</a>
        @elseif (Auth::check())
        <a class="btn btn-lg btn-block btn-primary" href="#" role="button" data-toggle="modal" data-target=".pesan-mediapartner">Pesan</a>
        @endif
      </div>
    </div>
    <div class="card mb-4 shadow">
      <div class="card-header gradient-5758">
        <h4 class="my-0 font-weight-normal text-white">Berlangganan</h4>
      </div>
      <div class="card-body">
        <h1 class="card-title pricing-card-title">Open</h1>
        <ul class="list-unstyled mt-3 mb-4">
          <li>Minimal > 20 Unit</li>
          <li>Bulanan / Semester</li>
          <li>Fakultas / Himpunan</li>
          <li>Harga terbaik</li>
        </ul>
        <button type="button" class="btn btn-lg btn-block btn-primary" data-toggle="modal" data-target=".modal-hubungi">Hubungi</button>
      </div>
    </div>
  </div>
  <p class="text-muted text-center">
    *Maksimal peminjaman 30 Unit.<br>
    *Maksimal durasi peminjaman 10 hari.<br>
    *Kuota Media partner 5/Bulan
  </p>
</div>

@endsection
