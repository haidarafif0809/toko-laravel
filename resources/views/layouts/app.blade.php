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
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sidenav.css') }}" rel="stylesheet">
    <link href="{{ asset('css/timer.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />

    <style type="text/css">
        @font-face {
            font-family: Ubuntu Medium;
            src: url({{ asset('fonts/Ubuntu-Medium.ttf') }});
        }
        body {
            font-family: Ubuntu Medium;
        }
        .logo-navbar{
            width:30px;
            height:30px;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav>
            <div class='link-wrapper'>
                <div class='link-container' style="background-color:#101920;">

                    <div class='hum-container'>
                        <div class='bar2'></div>
                        <div class='bar-mid'></div>
                        <div class='bar3'></div>
                    </div>
                    <!-- ////logo and title -->
                    <div class='lgo'>
                        <div class='img-holder'>
                            <img src="{{ asset('images/logo.png') }}" class="img-circle" width="194" height="100" />
                        </div>
                        <div class='title-holder'>
                            {{-- <span>KavePos</span> --}}
                        </div>
                    </div>
                    <!-- word navigations -->
                    <ul id='menu_teks'>
                        <li class='w-lnk'><router-link :to="{name: 'indexDashboard'}">
                            Dashboard
                        </router-link></li>
                        @role('member')
                        <li class='w-lnk'><router-link :to="{name: 'indexStafToko'}">
                            Staf Toko
                        </router-link></li>

                        @endrole
                        @role('admin')
                        {{-- dropdown MASTER DATA --}}
                        <a href="">
                            <li data-toggle="collapse" href="#master-data-collapse">
                                <p>Master Data <i class="fa fa-chevron-down"></i></p>
                            </li>
                        </a>
                        <div class="collapse" id="master-data-collapse">
                            <ul>
                                <li class='w-lnk'><router-link :to="{name: 'indexToko'}">
                                    <i class="fa fa-circle"></i> Toko
                                </router-link></li>

                                <li class='w-lnk'><router-link :to="{name: 'indexUser'}">
                                    <i class="fa fa-circle"></i> User Toko
                                </router-link></li>
                            </ul>
                        </div>
                        {{-- dropdown --}}
                        @endrole
                        @role('member')

                        {{-- dropdown PRODUK--}}
                        <a href="">
                            <li data-toggle="collapse" href="#produk-collapse">
                                <p>Produk <i class="fa fa-chevron-down"></i></p>
                            </li>
                        </a>
                        <div class="collapse" id="produk-collapse">
                            <ul>
                                <li class='w-lnk'><router-link :to="{name: 'indexProduk'}">
                                    <i class="fa fa-circle"></i> Produk
                                </router-link></li>

                                <li class='w-lnk'><router-link :to="{name: 'indexKategoriProduk'}">
                                    <i class="fa fa-circle"></i> Kategori Produk
                                </router-link></li>
                            </ul>
                        </div>
                        {{-- dropdown --}}

                        <li class='w-lnk'><router-link :to="{name: 'indexKelolaKas'}">
                            Kelola Kas
                        </router-link></li>

                        <li class='w-lnk'><router-link :to="{name: 'indexPelanggan'}">
                            Pelanggan
                        </router-link></li>

                        <li class='w-lnk'><router-link :to="{name: 'indexPenjualan'}">
                            Penjualan
                        </router-link></li>

                        <li class='w-lnk'><router-link :to="{name: 'indexLaporan'}">
                            Laporan
                        </router-link></li>

                        @endrole

                    </ul>
                    <!-- icon navigation -->
                    <ul id='icons'>
                        <li><router-link :to="{name: 'indexDashboard'}">
                            <i class="fa fa-home  fa-2x"></i>
                        </router-link></li>
                        <span class='nav_txt'>Home</span>
                        @role('member')
                        <li><router-link :to="{name: 'indexStafToko'}">
                            <i class="fa fa-user-circle-o fa-2x"></i>
                        </router-link></li>
                        <span class='nav_txt'>Staf Toko</span>
                        @endrole
                        @role('admin')
                        <a href="">
                            <li data-toggle="collapse" href="#logo-masterdata-collapse">
                                <i class="fa fa-database fa-2x"></i><i class="fa fa-chevron-down" style="font-size: 10px;padding-bottom: 5px;"></i>
                            </li>
                        </a>
                        <span class="nav_txt">Master Data</span>
                        <ul id="logo-masterdata-collapse" class="collapse">
                            <li><router-link :to="{name: 'indexToko'}">
                                <i class="fa fa-th-large fa-2x"></i>
                            </router-link></li>
                            <span class='nav_txt'>Toko</span>

                            <li><router-link :to="{name: 'indexUser'}">
                                <i class="fa fa-user-o fa-2x"></i>
                            </router-link></li>
                            <span class='nav_txt'>User Toko</span>
                        </ul>

                        @endrole
                        @role('member')
                        <a href="">
                            <li data-toggle="collapse" href="#logo-produk-collapse">
                                <i class="fa fa-cubes fa-2x"></i><i class="fa fa-chevron-down" style="font-size: 10px;padding-bottom: 5px;"></i>
                            </li>
                        </a>
                        <span class="nav_txt">Produk</span>
                        <ul id="logo-produk-collapse" class="collapse">
                            <li><router-link :to="{name: 'indexProduk'}">
                                <i class="fa fa-tag fa-2x"></i>
                            </router-link></li>
                            <span class='nav_txt'>Produk</span>

                            <li><router-link :to="{name: 'indexKategoriProduk'}">
                                <i class="fa fa-filter fa-2x"></i>
                            </router-link></li>
                            <span class='nav_txt'>Kategori Produk</span>
                        </ul>

                        <li><router-link :to="{name: 'indexKelolaKas'}">
                            <i class="fa fa-money fa-2x"></i>
                        </router-link></li>
                        <span class='nav_txt'>Kelola Kas</span>

                        <li><router-link :to="{name: 'indexPelanggan'}">
                            <i class="fa fa-users fa-2x"></i>
                        </router-link></li>
                        <span class='nav_txt'>Pelanggan</span>

                        <li><router-link :to="{name: 'indexPenjualan'}">
                            <i class="fa fa-shopping-bag fa-2x"></i>
                        </router-link></li>
                        <span class='nav_txt'>Penjualan</span>

                        <li><router-link :to="{name:'indexLaporan'}">
                            <i class="fa fa-file-archive-o fa-2x"></i>
                        </router-link></li>
                        <span class='nav_txt'>Laporan</span>
                        @endrole

                    </ul>
                </div>
            </div>
        </nav>

        <section>
            <div class='main-container'>
                <nav class="navbar navbar-default">
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
<script src="{{ asset('js/app.js?v=1.28') }}"></script>
<script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('js/sidenav.js') }}"></script>
<script src="{{ asset('js/timer.js') }}"></script>
<!-- charts -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.3.0/Chart.js"></script>
<script src="{{ asset('js/vue-charts.js') }}"></script>
<script src="js/Chart.min.js "></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.0.3/vue.min.js"></script> -->
<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script src="https://www.amcharts.com/lib/3/serial.js"></script>
<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
<script src="https://www.amcharts.com/lib/3/themes/light.js"></script>
<script type="text/javascript">
    function sweetAlert(){
        var namaToko = document.getElementById('nama_toko').value;
        var userName = document.getElementById('nama_pemilik').value;
        var email = document.getElementById('email').value;
        var no_telp = document.getElementById('no_telp').value;
        var password = document.getElementById('password').value;
        if ((!namaToko == '') && (!userName == '') && (!email == '') && (!no_telp == '') && (!password == '')) {
             swal({
            title: "Memproses...",
            text: "Mohon tunggu",
            imageUrl: "images/ajaxloader.gif",
            showConfirmButton: false,
            allowOutsideClick: false,
            allowEscapeKey: false
        });
        }
    } function sweetAlerts(){
        var email = document.getElementById('email').value;
        var password = document.getElementById('password').value;
        if ((!email == '') && (!password == '')) {
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
