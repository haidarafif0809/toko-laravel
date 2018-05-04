<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#" style="padding:0px;">
        <img alt="Brand" src="{{ asset('images/logo.png') }}" style="height: 100%;padding: 0px 5px;width: auto;" />
      </a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        @if (Auth::check())
        <li>
          <router-link :to="{name: 'indexDashboard'}">
            Dashboard
          </router-link>
        </li>
        @endif
        @role('member')
        <li>
          <router-link :to="{name: 'indexPenjualan'}">
            Penjualan
          </router-link>
        </li>
        <li>
          <router-link :to="{name: 'indexStafToko'}">
            Staf Toko
          </router-link>
        </li>
        @endrole

        @role('admin')
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Master Data <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li>
              <router-link :to="{name: 'indexToko'}">
                Toko
              </router-link>
            </li>

            <li>
              <router-link :to="{name: 'indexUser'}">
                User Toko
              </router-link>
            </li>

          </ul>
        </li>
        @endrole
        @role('member')
        <li class="dropdown">
              <li>
              <router-link :to="{name: 'indexProduk'}">
                Produk
              </router-link>
            </li>
        <li>
          <router-link :to="{name: 'indexKelolaKas'}">
            Kelola Kas
          </router-link>
        </li>
        <li>
          <router-link :to="{name: 'indexPelanggan'}">
            Pelanggan
          </router-link>
        </li>
        <li>
          <router-link :to="{name: 'riwayatPenjualan'}">
            Riwayat Penjualan
          </router-link>
        </li>
        <li>
          <router-link :to="{name: 'indexLaporan'}">
            Laporan
          </router-link>
        </li>
        @endrole

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

    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
