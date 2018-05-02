<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <!-- CSRF Token -->
    <meta content="{{ csrf_token() }}" name="csrf-token">
    <title>
        KavePos
    </title>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/chartist.js/latest/chartist.min.css"> <!-- untuk chart -->
    <script src="//cdn.jsdelivr.net/chartist.js/latest/chartist.min.js"></script> <!-- untuk chart -->
    <link rel="icon" type="img" href="{{ asset('favicon-kavepos.ico') }}">
    <!-- Styles -->
    <link href='https://fonts.googleapis.com/css?family=Orbitron' rel='stylesheet' type='text/css'>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sidenav.css') }}" rel="stylesheet">
    <link href="{{ asset('css/timer.css') }}" rel="stylesheet">

    <style type="text/css">
    @font-face {
        font-family: Roboto;
        src: url({{ asset('fonts/Roboto-Bold.ttf') }});
}
/*@font-face {
    font-family: Museo Sans;
    src: url({{ asset('fonts/MuseoSans_500.otf') }});
    }*/
    body {
        font-family: Roboto;
    }
    input {
        font-family: Roboto;
    }
    .swal2-content {
        font-family: Roboto;
    }
    .logo-navbar{
        width:30px;
        height:30px;
    }
    @media screen and (max-width: 480px){
        #nav-desktop{
            display: none;
        }
        #nav-top-desktop{
            display: none;
        }
    }
    @media screen and (min-width: 480px){
        .main-container {
            margin-left: 65px;
        }
        #nav-mobile{
            display: none;
        }
    }
</style>
</head>
<body>
    <div id="app">

        <div id="nav-desktop">
            @include('layouts.nav-desktop')
        </div>


        <section>
            <div class='main-container'>

                <div id="nav-mobile">
                    @include('layouts.nav-mobile')
                </div>

                <nav class="navbar navbar-default" id="nav-top-desktop">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <p class="navbar-brand">
                                <i class="fa fa-info-circle"></i> VERSI GRATIS | Upgrade Sekarang!.
                            </p>
                        </div>

                        <ul class="nav navbar-nav navbar-right">
                            <!-- Authentication Links -->
                            @guest
                            <li>
                                <a href="{{ route('login') }}">Login</a>
                            </li>
                            <li>
                                <a href="{{ route('register') }}">Register</a>
                            </li>
                            @else
                            @role('member')
                            <notification v-bind:notifications="notifications"></notification>
                            @endrole
                            <li class="dropdown">
                                <a aria-expanded="false" aria-haspopup="true" class="dropdown-toggle" data-toggle="dropdown" href="#" role="button">
                                    @role('admin')
                                    <img src="{{ asset('images/user-no-image.png') }}" class="img-circle logo-navbar">
                                    @endrole
                                    @role('member')
                                    @if(App\Toko::logoNavbar() === null)
                                    <img src="{{ asset('images/user-no-image.png') }}" class="img-circle logo-navbar">
                                    @else
                                    <img src="{{ App\Toko::logoNavbar() }}" class="img-circle logo-navbar">
                                    @endif
                                    @endrole
                                    {{ Auth::user()->nama_pemilik }}
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <router-link :to="{name: 'profileTokoIndex'}">
                                            <i class="fa fa-user" aria-hidden="true"></i> Profile Toko
                                        </router-link>
                                    </li>
                                    <li>
                                        <a href="{{ url('/ubah-password/password') }}"><i class="fa fa-btn fa-lock"></i> Ubah Password</a>
                                    </li>

                                    <li>
                                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        <i class="fa fa-sign-out" aria-hidden="true"></i>
                                        Keluar
                                    </a>
                                    <form action="{{ route('logout') }}" id="logout-form" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>

                            </ul>
                        </li>
                        @endguest
                    </ul>
                </div>
            </nav>
            @include('layouts._flash')
            <!-- put your contents here -->
            @yield('content')
        </div>
    </section>

</div>
<!-- Scripts -->
<!-- Include a polyfill for ES6 Promises (optional) for IE11 and Android browser -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="{{ asset('js/app.js?v=1.32') }}"></script>
<script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('js/sidenav.js') }}"></script>
<script src="{{ asset('js/timer.js') }}"></script>
<script src="{{ asset('js/moment.min.js') }}"></script>
<script src="{{ asset('js/moment.js') }}"></script>
<!-- <script src="{{ asset('js/moment-with-locales.min.js') }}"></script> -->
<script src="{{ asset('js/locales.js') }}"></script>
<script src="{{ asset('js/locales.min.js') }}"></script>
<!-- charts -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.3.0/Chart.js"></script>
<script src="{{ asset('js/vue-charts.js') }}"></script>
<script src="js/Chart.min.js "></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.0.3/vue.min.js"></script> -->
<script src="{{ asset('js/Chart.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
<script src="https://unpkg.com/vue-chartjs/dist/vue-chartjs.min.js"></script>
<script type="text/javascript">
    function sweetAlert(){
        var namaToko = document.getElementById('nama_toko').value;
        var userName = document.getElementById('nama_pemilik').value;
        var email = document.getElementById('email').value;
        var no_telp = document.getElementById('no_telp').value;
        var password = document.getElementById('password').value;
        var emails = document.forms['emails']['email'].value;
        var atpos = emails.indexOf("@");
        var dotpos = emails.lastIndexOf(".");
        if (atpos < 1 || dotpos < atpos + 2 || dotpos+2 >= emails.length || namaToko == '' || userName == '' || email == '' || no_telp == '' || password == '') {
          return;
      }
      else{
         swal({
            title: "Memproses...",
            text: "Mohon tunggu",
            imageUrl: "images/ajaxloader.gif",
            showConfirmButton: false,
            allowOutsideClick: false,
            allowEscapeKey: false
        });
     }
 }
 function sweetAlerts(){
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;
    var emails = document.forms['emails']['email'].value;
    var atpos = emails.indexOf("@");
    var dotpos = emails.lastIndexOf(".");
    if (atpos < 1 || dotpos < atpos + 2 || dotpos+2 >= emails.length || email == '' || password == '') {
        return;
    }
    else{
     swal({
        title: "Memproses...",
        text: "Mohon tunggu",
        imageUrl: "images/ajaxloader.gif",
        showConfirmButton: false,
        allowOutsideClick: false,
        allowEscapeKey: false
    });
 }
}
</script>
</body>
</html>
