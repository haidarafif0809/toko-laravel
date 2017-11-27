<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Toko Dasar</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
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
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                Master Data <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <router-link :to="{name: 'indexUser'}">
                                        User
                                    </router-link>
                                </li>
                                <li>
                                    <router-link :to="{name: ''}">
                                        Supplier
                                    </router-link>
                                </li>
                                <li>
                                    <router-link :to="{name: 'indexSatuan'}">
                                        Satuan
                                    </router-link>
                                </li>
                                <li>
                                    <router-link :to="{name: 'indexKategoriProduk'}">
                                        Kategori Produk
                                    </router-link>
                                </li>
                                <li>
                                    <router-link :to="{name: 'indexDashboard'}">
                                        Pelanggan
                                    </router-link>
                                </li>
                                <li>
                                    <router-link :to="{name: 'indexDashboard'}">
                                        Produk
                                    </router-link>
                                </li>
                            </ul>
                        </li>

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                Transaksi <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <router-link :to="{name: 'indexKasMasuk'}">
                                        Kas Masuk
                                    </router-link>
                                </li>
                                <li>
                                    <router-link :to="{name: 'indexUser'}">
                                        Kas Keluar
                                    </router-link>
                                </li>
                                <li>
                                    <router-link :to="{name: 'indexUser'}">
                                        Kas Mutasi
                                    </router-link>
                                </li>
                            </ul>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu">
                                <li>
                                    <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
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
<script src="{{ asset('js/app.js?v=1.3') }}"></script>
</body>
</html>
