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
    background-color: #fff;
    font-weight: 200;
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

  .pricing-header {
    max-width: 700px;
  }

  .card-deck .card {
    min-width: 220px;
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

@yield('content')


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
  minDate: new Date()
});
</script>


</body>


</html>
