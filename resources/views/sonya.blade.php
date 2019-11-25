@extends('welcome')

@section('content')
<div id="test" class="container vh-auto " style="min-height: 100vh;">
  <div class="row d-flex flex-column">
    <div class="col-sm-12 mb-3 mt-3 d-flex justify-content-center">
      <div class="container">
        <form action="{{route('sonya')}}" method="GET">
          <div class="row border">

            <div class="col-sm mb-3 mt-3 d-flex">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                  <input type="text" class="form-control date" name="tanggal" id="tanggal" placeholder="Tanggal sewa" style="width: 85%;"/>
                </div>

              </div>
            </div>


            <div class="col-sm mb-3 mt-3 d-flex flex-column ">
              <select id="hari" name="hari" class="form-control">
                <option selected>Jumlah hari</option>
                @for ($i = 1; $i < 11; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
                @endfor
              </select>
            </div>

            <div class="col-sm mb-3 mt-3 d-flex flex-column ">
              <select id="unit" name="unit" class="form-control">
                <option selected>Unit</option>
                @for ($i = 1; $i < 31; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
                @endfor
              </select>
            </div>


            <div class="col-sm mb-3 mt-3 flex-column">
              <button type="submit" value="cari" class="btn btn-outline-secondary ">Cek</button>
            </div>


          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="pricing-header px-3 pb-md-4 mx-auto text-center">
    <h1 class="display-4">{{  Carbon::parse($tanggal)->format('F')}} {{ Carbon::parse($tanggal)->format('jS')}} - {{ Carbon::parse($tanggal)->addDays($hari)->format('jS') }}</h1>
    <p class="text-muted">*Unit tersedia 30Unit/Hari</p>
  </div>

  <div id="panel2" class="container vh-auto d-flex flex-column align-items-center" style="min-height: 100vh;">

    <div class="card-deck mb-3 text-center">
      @forelse ($cek as $o)
      <div class="card mb-4 shadow-sm" style="max-width: 220px;">
        <div class="card-header">
          <h4 class="my-0 font-weight-normal">{{$o->tanggal_sewa->toFormattedDateString()}}</h4>
        </div>
        <div class="card-body">
          <h1 class="card-title pricing-card-title">{{$o->jumlah_unit}}<span class="font-italic" style="font-size: 0.8rem;">Unit</span></h1>
          <ul class="list-unstyled mt-3 mb-2">
            <li>{{$o->nama}}</li>
            <li style="border-top">{{$o->acara}}</li>
            <li>@if ($o->paket == 1)
              <span class="font-weight-bold">Normal</span>
              @elseif ($o->paket == 2)
              <span class="font-weight-bold">Media Partner</span>
              @else
              <span class="text-muted">ERROR</span>
              @endif
            </li>
            <li>{{$o->jumlah_hari}} Hari</li>
          </ul>
          @if (Route::has('register'))
          @elseif ($o->idu == Auth::user()->id)
          <a href="{{url('nota', $o->kode)}}" class="btn btn-outline-primary">CEK</a>.
          @else
          <p></p>
          @endif
        </div>
      </div>
      @empty
      Tidak ada peminjaman / 30 Unit ready.
      @endforelse
    </div>
  </div>


</div>
@endsection
