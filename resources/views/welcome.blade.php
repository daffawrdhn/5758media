<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>5758 Media</title>

  <!-- Fonts -->
  <style>
  @import url('https://fonts.googleapis.com/css?family=Montserrat&display=swap');
  </style>

  <!-- Style -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <!-- Javascript -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  <!-- Styles -->
  <style>
  html, body {
    background-color: #fff;
    color: #636b6f;
    font-family: 'Montserrat', sans-serif;
    font-weight: 200;
    height: 100vh;
    margin: 0;
  }
  .full-height {
    height: 100vh;
  }
  .half-height {
    height: 50vh;
  }
  .half-two-height {
    height: 40vh;
  }
  .flex-center {
    align-items: center;
    display: flex;
    justify-content: center;
  }
  .position-ref {
    position: relative;
  }
  .top-right {
    position: absolute;
    right: 10px;
    top: 18px;
  }
  .content {
    text-align: center;
  }
  .title {
    font-size: 84px;
  }
  .links > a {
    color: #636b6f;
    padding: 0 25px;
    font-size: 13px;
    font-weight: 600;
    letter-spacing: .1rem;
    text-decoration: none;
    text-transform: uppercase;
  }
  .m-b-md {
    margin-bottom: 30px;
  }
  </style>
</head>
<!-- <body class="overflow-hidden"> -->
<body>

  <div class="pos-f-t">
    <div class="collapse" id="navbarToggleExternalContent">
      <div class="bg-dark p-4">
        <div class="row">
          <div class="col-sm">
            <h4 class="text-white">About</h4>
            <p class="text-muted">Add some information about the album below, the author, or any other background context. Make it a few sentences long so folks can pick up some informative tidbits. Then, link them off to some social networking sites or contact information.</p>
          </div>
          <div class="col-sm">
            <!-- One of three columns -->
          </div>
          <div class="col-sm">
            <h4 class="text-white">Menu</h4>
            <ul class="list-unstyled text-white">
              @if (Route::has('login'))
              <!-- <div class="top-right links"> -->
              @auth
              <li><a class="text-white" href="{{ url('/home') }}">Home</a></li>
              @if (Auth::check() && Auth::user()->isAdmin())

              <li><a class="text-white" href="{{ url('/dashboard') }}">Dashboard</a></li>

              @elseif(Auth::check() && Auth::user()->isUser())

              @endif
              @else
              <li><a class="text-white" href="{{ route('login') }}">Login</a></li>

              @if (Route::has('register'))
              <li><a class="text-white" href="{{ route('register') }}">Register</a></li>
              @endif
              @endauth
              <!-- </div> -->
              @endif
            </ul>
          </div>
        </div>
      </div>
    </div>
    <nav class="navbar sticky-top navbar-transparent bg-transparent d-flex justify-content-between">
      <div class="top-right">
        <button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
          <a href="#"><img src="https://img.icons8.com/ios-filled/25/000000/menu.png"></a>
        </button>
      </div>
      <!-- @if (Route::has('login'))
      <div class="top-right links">
      @auth
      <a href="{{ url('/home') }}">Home</a><
      @if (Auth::check() && Auth::user()->isAdmin())
      <a href="{{ url('/dashboard') }}">Dashboard</a>
      @elseif(Auth::check() && Auth::user()->isUser())
      @endif
      @else
      <a href="{{ route('login') }}">Login</a>
      @if (Route::has('register'))
      <a href="{{ route('register') }}">Register</a>
      @endif
      @endauth
    </div>
    @endif -->
  </nav>
</div>

<div class="container-fluid">
  <div class="flex-center position-ref full-height">


    <div class="content">


      <div class="title m-b-md">
        <p>5758</p>
      </div>

      <div class="align-middle">
        <h6>masukkan kode untuk melihat</br>status peminjaman & download nota</h6>
      </div>


      <div class="input-group mb-3">

        <input id="myInput" type="text" class="form-control" placeholder="Nota's code" aria-label="Recipient's username" aria-describedby="basic-addon2">

        <div class="input-group-append">

          <button type="button" onclick="getInputNota();" class="btn btn-outline-secondary">Cek</button>

        </div>
      </div>
    </div>
  </div>
</div>

<!--  Facts -->
<section class="half-two-height bg-light">
  <div class="container">


    <div class="row align-items-center pt-5">
      <div class="col">
        <div class="text-center">
          <h1 class="font-weight-bold display-4"><strong>FACTS</strong></h1>
          <span class="font-weight-normal text-muted">real fact about our service</span>
        </div>
      </div>
    </div> <br> <br>

    <div class="row align-items-center justify-content-between pt-2">
      <div class="col text-center">
        <h1 class="font-weight-bold">100</h1>
        <p class="">Orders made.</p>
      </div>
      <div class="col text-center">
        <h1 class="font-weight-bold">100</h1>
        <p>Media Partner take</p>
      </div>
      <div class="col text-center">
        <h1 class="font-weight-bold">100</h1>
        <p>Days out.</p>
      </div>
      <div class="col text-center">
        <h1 class="font-weight-bold">100</h1>
        <p>Average unit <br> order</p>
      </div>
    </div>
  </div>
</section>

</body>

<script>
function getInputNota(){
  // Selecting the input element and get its value
  var inputVal = document.getElementById("myInput").value;
  // Displaying the value
  window.location.href = 'http://wrdhndty.site/nota/'+inputVal;
}
</script>
</html>
