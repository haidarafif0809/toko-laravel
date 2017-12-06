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
</link>
</link>
</meta>
</meta>
</meta>
</meta>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <!-- Collapsed Hamburger -->
                    <button aria-expanded="false" class="navbar-toggle collapsed" data-target="#app-navbar-collapse" data-toggle="collapse" type="button">
                        <span class="sr-only">
                            Toggle Navigation
                        </span>
                        <span class="icon-bar">
                        </span>
                        <span class="icon-bar">
                        </span>
                        <span class="icon-bar">
                        </span>
                    </button>
                    <!-- Branding Image -->
                    <router-link :to="{name: 'indexDashboard'}" class="navbar-brand">
                        Toko Dasar
                    </router-link>
                </div>
                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        <li>
                            <router-link :to="{name: 'indexDashboard'}">
                                Dashboard
                            </router-link>
                        </li>
                        <li class="dropdown">
                            <a aria-expanded="false" aria-haspopup="true" class="dropdown-toggle" data-toggle="dropdown" href="#" role="button">
                                Produk
                                <span class="caret">
                                </span>
                            </a>
                            <ul class="dropdown-menu">

                                <!-- <li>
                                    <router-link :to="{name: 'indexSuplier'}">
                                        Supplier
                                    </router-link>
                                </li> -->
                                <!-- <li>
                                    <router-link :to="{name: 'indexSatuan'}">
                                        Satuan
                                    </router-link>
                                </li> -->
                                <li>
                                    <router-link :to="{name: 'indexKategoriProduk'}">
                                        Kategori Produk
                                    </router-link>
                                </li>

                                <li>
                                    <router-link :to="{name: 'indexProduk'}">
                                        Produk
                                    </router-link>
                                </li>
                                <!-- <li>
                                    <router-link :to="{name: 'indexKas'}">
                                        Kas
                                    </router-link>
                                </li> -->
                                <!-- <li>
                                    <router-link :to="{name: 'indexKategoriTransaksi'}">
                                        Kategori Transaksi
                                    </router-link>
                                </li> -->
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a aria-expanded="false" aria-haspopup="true" class="dropdown-toggle" data-toggle="dropdown" href="#" role="button">
                                Transaksi
                                <span class="caret">
                                </span>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <router-link :to="{name: 'indexKasMasuk'}">
                                        Kas Masuk
                                    </router-link>
                                </li>
                                <li>
                                    <router-link :to="{name: 'indexKasKeluar'}">
                                        Kas Keluar
                                    </router-link>
                                </li>
                               <!--  <li>
                                    <router-link :to="{name: 'indexUser'}">
                                        Kas Mutasi
                                    </router-link>
                                </li> -->
                            </ul>
                        </li>

                        <li>
                            <router-link :to="{name: 'indexUser'}">
                                Staf
                            </router-link>
                        </li>

                        <li>
                            <router-link :to="{name: 'indexPelanggan'}">
                                Pelanggan
                            </router-link>
                        </li>

                        <li>
                            <router-link :to="{name: 'indexDashboard'}">
                                Penjualan
                            </router-link>
                        </li>

                        <li class="dropdown">
                            <a aria-expanded="false" aria-haspopup="true" class="dropdown-toggle" data-toggle="dropdown" href="#" role="button">
                                Laporan
                                <span class="caret">
                                </span>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <router-link :to="{name: 'indexDashboard'}">
                                        Laporan Ringkas
                                    </router-link>
                                </li>

                                <li>
                                    <router-link :to="{name: 'indexDashboard'}">
                                        Analisa Penjualan Harian
                                    </router-link>
                                </li>

                                <li>
                                    <router-link :to="{name: 'indexDashboard'}">
                                        Analisa Penjualan Per Jam
                                    </router-link>
                                </li>

                                <li>
                                    <router-link :to="{name: 'indexDashboard'}">
                                        Data Transaksi Penjualan
                                    </router-link>
                                </li>

                                <li>
                                    <router-link :to="{name: 'indexDashboard'}">
                                        Rekapitulasi Kas
                                    </router-link>
                                </li>

                            </ul>
                        </li>
                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                        <li>
                            <a href="{{ route('login') }}">
                                Login
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('register') }}">
                                Register
                            </a>
                        </li>
                        @else
                        <li class="dropdown">
                            <a aria-expanded="false" aria-haspopup="true" class="dropdown-toggle" data-toggle="dropdown" href="#" role="button">
                                {{ Auth::user()->name }}
                                <span class="caret">
                                </span>
                            </a>
                            <ul class="dropdown-menu">
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
        </div>
    </nav>
    @yield('content')
</div>
<!-- Scripts -->
<script src="{{ asset('js/app.js?v=1.18') }}">
</script>
</body>
</html>
