<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <!-- CSRF Token -->
    <meta content="{{ csrf_token() }}" name="csrf-token">
    <title>
        Toko Dasar
    </title>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sidenav.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
    <nav>   
        <div class='link-wrapper'>
            <div class='link-container' style="background-image: url('images/gambar.png');">
                <div class='hum-container'>
                    <div class='bar2'></div>
                    <div class='bar-mid'></div>
                    <div class='bar3'></div>
                </div>
                <!-- ////logo and title -->
                <div class='lgo'>
                    <div class='img-holder'>
                        <img src="{{ asset('images/logo.png') }}" class="img-circle" width="100" height="100" />
                    </div>
                    <div class='title-holder'>
                        {{-- <span>Toko Dasar</span> --}}
                    </div>
                </div>  
                <!-- word navigations -->
                <ul id='menu_teks'>
                    @if (Auth::check())
                    <li class='w-lnk'><router-link :to="{name: 'indexDashboard'}">
                        Dashboard
                    </router-link></li>

                    <li class='w-lnk'><router-link :to="{name: 'indexStafToko'}">
                        Staf Toko
                    </router-link></li>

                    <li class='w-lnk'><router-link :to="{name: 'indexGerai'}">
                        Gerai
                    </router-link></li>
                    @endif
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
                    @if (auth()->check())

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

                    @endif

                </ul>
                <!-- icon navigation -->
                <ul id='icons'>
                    @if (Auth::check())
                    <li><router-link :to="{name: 'indexDashboard'}">
                        <i class="fa fa-home  fa-2x"></i>
                    </router-link></li>
                    <span class='nav_txt'>Home</span>

                    <li><router-link :to="{name: 'indexStafToko'}">
                        <i class="fa fa-user-circle-o fa-2x"></i>
                    </router-link></li>
                    <span class='nav_txt'>Staf Toko</span>

                    <li><router-link :to="{name: 'indexGerai'}">
                        <i class="fa fa-map-marker fa-2x"></i>
                    </router-link></li>
                    <span class='nav_txt'>Gerai</span>
                    @endif
                    @role('admin')
                    <a href="">
                        <li data-toggle="collapse" href="#logo-masterdata-collapse">
                            <i class="fa fa-database fa-2x"></i><i class="fa fa-chevron-down" style="font-size: 10px;padding-bottom: 5px;"></i>
                        </li>
                    </a>
                    <span class="nav_txt">Master Data</span>
                    <ul id="logo-masterdata-collapse" class="collapse">
                        <li><router-link :to="{name: 'indexToko'}">
                            <i class="fa fa-windows fa-2x"></i>
                        </router-link></li>
                        <span class='nav_txt'>Toko</span>

                        <li><router-link :to="{name: 'indexUser'}">
                            <i class="fa fa-user-o fa-2x"></i>
                        </router-link></li>
                        <span class='nav_txt'>User Toko</span>
                    </ul>

                    @endrole
                    @if (auth()->check())
                    <a href="">
                        <li data-toggle="collapse" href="#logo-produk-collapse">
                            <i class="fa fa-briefcase fa-2x"></i><i class="fa fa-chevron-down" style="font-size: 10px;padding-bottom: 5px;"></i>
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

                    <li><router-link :to="{name: 'indexLaporan'}">
                        <i class="fa fa-file-archive-o fa-2x"></i>
                    </router-link></li>
                    <span class='nav_txt'>Laporan</span>
                    @endif

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
                            <i class="fa fa-info-circle"></i> Disini Buat Pengumuman Atau Sejenisnya.
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
                                <img src="{{ asset('images/profile.jpg') }}" class="img-circle" width="30px" height="30px">
                                {{ Auth::user()->nama_pemilik }}
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <router-link :to="{name: 'profileTokoIndex'}">
                                        Profile Toko
                                    </router-link>
                                </li>
                                <li>
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    Logout
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
        <!-- put your contents here -->
            @yield('content')
        </div>
    </section>

    </div>
<!-- Scripts -->
<script src="{{ asset('js/app.js?v=1.26') }}"></script>
<script src="{{ asset('js/sidenav.js') }}"></script>

</body>
</html>
