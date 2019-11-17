@extends('welcome')

@section('content')
<div id="test" class="container vh-auto d-flex flex-column justify-content-center" style="min-height: 100vh;">
  <div class="row">
    <div class="col-sm-6 d-flex flex-column justify-content-center">
      <div class="container">
        @foreach ($cek as $o)
        {{$o->tanggal_sewa}}
        @endforeach
      </div>
    </div>
    <div class="col-sm-6 d-flex flex-column justify-content-center">
      <div class="container">
      </div>
    </div>
  </div>
</div>
@endsection
