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

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="{{ asset('css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{ asset('css/bootstrap-datepicker.min.css')}}" rel="stylesheet">

  <!-- Your custom styles (optional) -->
  <link href="{{ asset('css/style.css')}}" rel="stylesheet">
  <link href="{{ asset('css/stylesheet.css')}}" rel="stylesheet">

  <!-- Styles -->
  <style>
  html, body {
    background-color: white;
    /* font-family: 'Montserrat', sans-serif; */
    /* font-weight: 200; */
    margin: 0;
    font-size: 14px;
  }
  @media (min-width: 768px) {
    html {
      font-size: 16px;
    }
    #panel1 {
      padding-top: ($spacer * 2.5) !important;
    }
  }

  @media (max-width: 425px) {
    #panel1 {
      padding-top: 20px;
    }
  }

  .font-5758 {
    font-family: 'Montserrat', sans-serif;
  }


  .pricing-header {
    max-width: 700px;
  }

  .card-deck .card {
    min-width: 220px;
  }

  .gradient-5758 {
    background: linear-gradient(45deg,#F17C58, #E94584, #24AADB , #27DBB1,#FFDC18, #FF3706);
    background-size: 600% 100%;
    animation: gradient 16s linear infinite;
    animation-direction: alternate;
  }
  @keyframes gradient {
      0% {background-position: 0%}
      100% {background-position: 100%}
  }

  .linear-wipe {

  background: linear-gradient(45deg,#EC5776,#EE813E,#4EDB95, #418F98);
  background-size: 600% 100%;

  background-clip: text;
  text-fill-color: transparent;
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;

  animation: gradient 2s linear infinite;
  animation-direction: alternate;
  }
  @keyframes gradient {
      0% {background-position: 0%}
      100% {background-position: 100%}
  }

  #return-to-top {
    position: fixed;
    bottom: 20px;
    right: 20px;
    background: rgb(0, 0, 0);
    background: rgba(0, 0, 0, 0.7);
    width: 50px;
    height: 50px;
    display: block;
    text-decoration: none;
    -webkit-border-radius: 35px;
    -moz-border-radius: 35px;
    border-radius: 35px;
    display: none;
    -webkit-transition: all 0.3s linear;
    -moz-transition: all 0.3s ease;
    -ms-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease;
}
#return-to-top i {
    color: #fff;
    margin: 0;
    position: relative;
    left: 16px;
    top: 13px;
    font-size: 19px;
    -webkit-transition: all 0.3s ease;
    -moz-transition: all 0.3s ease;
    -ms-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease;
}
#return-to-top:hover {
    background: rgba(0, 0, 0, 0.9);
}
#return-to-top:hover i {
    color: #fff;
    top: 5px;
}
  }

  </style>
</head>
<!-- <body class="overflow-hidden"> -->
<body>

<div id="panel" class="pos-f-t">
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
              @if (Route::currentRouteName() == 'index')
                @if (Route::has('login'))
                <!-- <div class="top-right links"> -->
                @auth
                <li><a class="text-white" href="#panel1">Home</a></li>
                <li><a class="text-white" href="#panel2">Harga</a></li>
                <li><a class="text-white" href="{{ url('/home') }}">Profile</a></li>
                @if (Auth::check() && Auth::user()->isAdmin())

                <li><a class="text-white" href="{{ url('/dashboard') }}">Dashboard</a></li>

                @elseif(Auth::check() && Auth::user()->isUser())

                @endif
                @else
                <li><a class="text-white" href="#panel1">Home</a></li>
                <li><a class="text-white" href="#panel2">Harga</a></li>
                <li><a class="text-white" href="{{ route('login') }}">Login</a></li>

                @if (Route::has('register'))
                <li><a class="text-white" href="{{ route('register') }}">Register</a></li>
                @endif
                @endauth
                <!-- </div> -->
                @endif

              @endif
              @if (Route::currentRouteName() == 'sonya')
                @if (Route::has('login'))
                <!-- <div class="top-right links"> -->
                @auth
                <li><a class="text-white" href="{{ route('index')}}">Home</a></li>
                <li><a class="text-white" href="{{ route('home') }}">Profile</a></li>
                @if (Auth::check() && Auth::user()->isAdmin())

                <li><a class="text-white" href="{{ route('dashboard') }}">Dashboard</a></li>

                @elseif(Auth::check() && Auth::user()->isUser())

                @endif
                @else
                <li><a class="text-white" href="{{ route('index') }}">Home</a></li>
                <li><a class="text-white" href="{{ route('login') }}">Login</a></li>

                @if (Route::has('register'))
                <li><a class="text-white" href="{{ route('register') }}">Register</a></li>
                @endif
                @endauth
                <!-- </div> -->
                @endif
              @endif
            </ul>
          </div>
        </div>
      </div>
    </div>
    <nav class="navbar navbar-transparent bg-transparent fixed-top d-flex justify-content-end">
      <div class="top-right">
        @if (Auth::guest())

        <a class="btn btn-outline-primary" href="{{ route('register') }}" role="button">Daftar</a>
        <a class="btn btn-outline-primary" href="{{ route('login') }}" role="button">Masuk</a>
        @elseif (Auth::check())
        <a class="btn btn-outline-primary" href="#" role="button">Pesan</a>
        @endif

        <button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
          <a href="#panel"><img src="https://img.icons8.com/ios-filled/25/000000/menu.png"></a>
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

<a href="javascript:" id="return-to-top" style="z-index: 1200;"><i class="fas fa-arrow-up"></i></a>

@yield('content')

<div id="kaki" class="container-fluid vh-auto mt-5 text-white bg-dark">
  <div class="row">
    <div class="col-sm-4 pt-5 pb-5">
        <div class="container">

          <h1 class="display-2 font-5758 linear-wipe">5758</h1>
          <p> &copy; Copyright 2019 Majumapan Media.</p>

          <div class="d-flex flex-row">
            <a class="btn btn-outline-light mr-3" href="https://www.instagram.com/5758media" role="button"><i class="fab fa-instagram"></i></a>
            <a class="btn btn-outline-light" href="https://www.google.com/maps/dir//-8.1772155,113.7207026/@-8.1771989,113.7207106,20z" role="button"><i class="fas fa-map-marked-alt"></i></a>
          </div>

        </div>
    </div>
    <div class="col-sm-4 pt-5 pb-5">
      <div class="container">
        <p class="font-weight-bold">Navigasi</p>
        <ul class="list-unstyled text-white font-5758">
          @if (Route::currentRouteName() == 'index')
            @if (Route::has('login'))
            <!-- <div class="top-right links"> -->
            @auth
            <li><a class="text-white" href="#panel1">Home</a></li>
            <li><a class="text-white" href="#panel2">Harga</a></li>
            <li><a class="text-white" href="{{ url('/home') }}">Profile</a></li>
            @if (Auth::check() && Auth::user()->isAdmin())

            <li><a class="text-white" href="{{ url('/dashboard') }}">Dashboard</a></li>

            @elseif(Auth::check() && Auth::user()->isUser())

            @endif
            @else
            <li><a class="text-white" href="#panel1">Home</a></li>
            <li><a class="text-white" href="#panel2">Harga</a></li>
            <li><a class="text-white" href="{{ route('login') }}">Masuk</a></li>

            @if (Route::has('register'))
            <li><a class="text-white" href="{{ route('register') }}">Daftar</a></li>
            @endif
            @endauth
            <!-- </div> -->
            @endif

          @endif
          @if (Route::currentRouteName() == 'sonya')
            @if (Route::has('login'))
            <!-- <div class="top-right links"> -->
            @auth
            <li><a class="text-white" href="{{ route('index')}}">Home</a></li>
            <li><a class="text-white" href="{{ route('home') }}">Profile</a></li>
            @if (Auth::check() && Auth::user()->isAdmin())

            <li><a class="text-white" href="{{ route('dashboard') }}">Dashboard</a></li>

            @elseif(Auth::check() && Auth::user()->isUser())

            @endif
            @else
            <li><a class="text-white" href="{{ route('index') }}">Home</a></li>
            <li><a class="text-white" href="{{ route('login') }}">Masuk</a></li>

            @if (Route::has('register'))
            <li><a class="text-white" href="{{ route('register') }}">Daftar</a></li>
            @endif
            @endauth
            <!-- </div> -->
            @endif
          @endif
        </ul>

      </div>
    </div>
    <div class="col-sm-4 pt-5 pb-5">
      <div class="container">
        <p class="font-weight-bold">Alamat </p>
        <p><i class="fas fa-map-marker-alt"></i> Perumahan Semeru Permai 3 <br>Blok.H No.6<br>Sumbersari, Jember<br></p>
        <p class="font-weight-bold pt-1">Kontak</p>
        <div class="d-flex flex-row">
          <a class="btn btn-outline-success mr-3" href="https://wa.me/62895385250387?text=Saya%20tertarik%20untuk%20menyewa%20HT%20di%205758Media" role="button"><i class="fab fa-whatsapp"></i> Ilham</a>
          <a class="btn btn-outline-success" href="https://wa.me/6289516156911?text=Saya%20tertarik%20untuk%20menyewa%20HT%20di%205758Media" role="button"><i class="fab fa-whatsapp"></i> Daffa</a>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- JQuery -->
<script type="text/javascript" src="{{ asset('js/jquery-3.4.1.min.js')}}"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="{{ asset('js/popper.min.js')}}"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="{{ asset('js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/bootstrap-datepicker.min.js')}}"></script>
<!-- Moment -->
<script type="text/javascript" src="{{ asset('js/moment.min.js')}}"></script>


<script>
function getInputNota(){
  // Selecting the input element and get its value
  var inputVal = document.getElementById("myInput").value;
  // Displaying the value
  window.location.href = 'http://wrdhndty.site/nota/'+inputVal;
}
</script>

<script type="text/javascript">
$("a[href^='#']").click(function(e) {
  e.preventDefault();

  var position = $($(this).attr("href")).offset().top;

  $("body, html").animate({
    scrollTop: position
  } ,
  500,
  'linear' );
});
</script>

<script>
$('.date').datepicker({
  uiLibrary: 'bootstrap4',
  format: 'yyyy-mm-dd',
  todayBtn:'linked',
  autoclose:true
});
</script>

<script type="text/javascript">
// ===== Scroll to Top ====
$(window).scroll(function() {
    if ($(this).scrollTop() >= 50) {        // If page is scrolled more than 50px
        $('#return-to-top').fadeIn(200);    // Fade in the arrow
    } else {
        $('#return-to-top').fadeOut(200);   // Else fade out the arrow
    }
});
$('#return-to-top').click(function() {      // When arrow is clicked
    $('body,html').animate({
        scrollTop : 0                       // Scroll to top of body
    }, 500);
});

</script>

</body>


</html>
