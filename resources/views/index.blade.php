@extends('welcome')

@section('content')
<div id="panel1" class="container vh-auto d-flex flex-column justify-content-center" style="min-height: 100vh;">
  <div class="row">
    <div class="col-sm-6 d-flex flex-column justify-content-center">
      <div class="container">
        <h1 class="display-1">5758</h1>
        <p class="text-left">5758Media merupakan penyedia persewaan HT termurah untuk daerah Jember dan sekitarnya. Didirikan sejak Oktober 2019. Kami menyewakan HT berkualitas dengan merek Baofeng tipe 888s .</p>
        <p><a class="btn btn-primary btn-lg" href="#fact" role="button">Lihat fakta &raquo;</a></p>
      </div>
    </div>
    <div class="col-sm-6 d-flex flex-column justify-content-center">
      <div class="row">
        <div class="col-sm-12 d-flex flex-column align-items-center pb-3">
          <p>Yuk cek ketersediaan unit untuk tanggal acaramu</p>
          <div class="content">
            <div class="card" style="min-width: 352px;">
              <div class="card-body">
                <form action="/sonya" method="GET">
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
                      <button type="submit" value="cari" class="btn btn-outline-secondary btn-lg">Cek</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <p class="text-muted text-center">
            *Maksimal peminjaman 30 Unit.<br>
            *Maksimal durasi peminjaman 10 hari.
          </p>
        </div>
      </div>
      <div class="row border-top">
        <div class="col-sm-12 d-flex flex-column align-items-center pt-3">
          <p class="text-center">Mari kita lihat status peminjamanmu dengan memasukkan KODE order.</p>
          <div class="content">
            <div class="card" style="min-width: 352px;">
              <div class="card-body">
                <div class="input-group">
                  <input id="myInput" type="text" class="form-control" placeholder="Kode nota" aria-label="Recipient's username" aria-describedby="basic-addon2">
                  <div class="input-group-append">
                    <button type="button" onclick="getInputNota();" class="btn btn-outline-secondary">Cek</button>
                  </div>
                </div>
              </div>
            </div>
            <p class="text-muted text-center">*besar kecil huruf berpengaruh.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div id="fact" class="container vh-auto d-flex flex-column justify-content-center" style="min-height: 100vh;">

  <div class="row">
    <div class="col-sm-6 d-flex flex-column justify-content-center">
      <div class="container">
        <h1 class="display-1">Fakta</h1>
        <p class="text-left">Fakta mengenai 5758Media yang harus kalian ketahui sekaligus menjadi transparasi data dan jasa kami kepada client agar semakin percaya.</p>
        <p><a class="btn btn-primary btn-lg" href="#panel2" role="button">Lihat harga &raquo;</a></p>
      </div>
    </div>
    <div class="col-sm-6 d-flex flex-column justify-content-center">

      <div class="row">
        <div class="col-sm-12 d-flex flex-column ">
          <div class="row">
            <div class="col-sm-6 d-flex flex-column">
              <h1 class="display-4 text-right">{{$totalorders}}</h1>
            </div>
            <div class="col-sm-6 d-flex flex-column">
              <p class="text-left">Peminjaman telah berhasil dilakukan mulai dari 5758Media berdiri sampai sekarang.</p>
            </div>
          </div>
        </div>
      </div>

      <div class="row border-top pt-4">
        <div class="col-sm-12 d-flex flex-column r">
          <div class="row">
            <div class="col-sm-6 d-flex flex-column">
              <h1 class="display-4 text-right">{{$totalmediapartners}}</h1>
            </div>
            <div class="col-sm-6 d-flex flex-column">
              <p class="text-left">{{$totalmediapartners}} dari {{$totalorders}} Peminjaman adalah media partner.</p>
            </div>
          </div>
        </div>
      </div>

      <div class="row border-top pt-4">
        <div class="col-sm-12 d-flex flex-column ">
          <div class="row">
            <div class="col-sm-6 d-flex flex-column">
              <h1 class="display-4 text-right">{{round($averageunits)}}</h1>
            </div>
            <div class="col-sm-6 d-flex flex-column">
              <p class="text-left">Rata-rata banyak unit yang disewa untuk sekali peminjaman dari {{$totalorders}} data peminjaman.</p>
            </div>
          </div>
        </div>
      </div>

      <div class="row border-top pt-4">
        <div class="col-sm-12 d-flex flex-column align-items-center">
          <div class="row">
            <div class="col-sm-6 d-flex flex-column">
              <h1 class="display-4 text-right">{{$days}}</h1>
            </div>
            <div class="col-sm-6 d-flex flex-column">
              <p class="text-left">Hari telah kami lalui untuk menjaga kepercayaan peminjan dan berjalannya jasa kami.</p>
            </div>
          </div>
        </div>
      </div>
      <p class="text-muted text-center pt-3">
      * {{($totalmediapartners/$totalorders)*100}}% dari peminjaman memilih media partner
      </p>
    </div>

  </div>
</div>

<div id="panel2" class="container-fluid vh-auto d-flex flex-column align-items-center justify-content-center" style="min-height: 100vh;">

  <div class="pricing-header px-3 py-5 pt-md-5 pb-md-4 mx-auto text-center">
    <h1 class="display-4">Harga</h1>
    <p>Quickly build an effective pricing table for your potential customers with this Bootstrap example. It's built with default Bootstrap components and utilities with little customization.</p>
  </div>

  <div class="card-deck mb-3 text-center">
    <div class="card mb-4 shadow-sm">
      <div class="card-header">
        <h4 class="my-0 font-weight-normal">Free</h4>
      </div>
      <div class="card-body">
        <h1 class="card-title pricing-card-title">$0 <small class="text-muted">/ mo</small></h1>
        <ul class="list-unstyled mt-3 mb-4">
          <li>10 users included</li>
          <li>2 GB of storage</li>
          <li>Email support</li>
          <li>Help center access</li>
        </ul>
        <button type="button" class="btn btn-lg btn-block btn-outline-primary">Sign up for free</button>
      </div>
    </div>
    <div class="card mb-4 shadow-sm">
      <div class="card-header">
        <h4 class="my-0 font-weight-normal">Pro</h4>
      </div>
      <div class="card-body">
        <h1 class="card-title pricing-card-title">$15 <small class="text-muted">/ mo</small></h1>
        <ul class="list-unstyled mt-3 mb-4">
          <li>20 users included</li>
          <li>10 GB of storage</li>
          <li>Priority email support</li>
          <li>Help center access</li>
        </ul>
        <button type="button" class="btn btn-lg btn-block btn-primary">Get started</button>
      </div>
    </div>
    <div class="card mb-4 shadow-sm">
      <div class="card-header">
        <h4 class="my-0 font-weight-normal">Enterprise</h4>
      </div>
      <div class="card-body">
        <h1 class="card-title pricing-card-title">$29 <small class="text-muted">/ mo</small></h1>
        <ul class="list-unstyled mt-3 mb-4">
          <li>30 users included</li>
          <li>15 GB of storage</li>
          <li>Phone and email support</li>
          <li>Help center access</li>
        </ul>
        <button type="button" class="btn btn-lg btn-block btn-primary">Contact us</button>
      </div>
    </div>
  </div>

</div>
@endsection
