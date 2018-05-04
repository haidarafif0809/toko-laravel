<nav>
    <div class='link-wrapper'>
        <div class='link-container' style="background-color:#457087;">

            <div class='hum-container'>
                <div class='bar2'></div>
                <div class='bar-mid'></div>
                <div class='bar3'></div>
            </div>
            <!-- ////logo and title -->
            <div class='lgo'>
                <div class='img-holder'>
                    <img src="{{ asset('images/logo.png') }}" class="img-circle" width="150" height="80" />
                </div>
                <div class='title-holder'>
                    {{-- <span>KavePos</span> --}}
                </div>
            </div>
            <!-- word navigations -->
            <ul id='menu_teks'>
                @if (Auth::check())
                <li class='w-lnk'><router-link :to="{name: 'indexDashboard'}">
                    Dashboard
                </router-link></li>
                <li class='w-lnk'><router-link :to="{name: 'indexPenjualan'}">
                    Penjualan
                </router-link></li>
                @endif
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
                        <p>Produk</p>
                    </li>
                </a>

                <li class='w-lnk'><router-link :to="{name: 'indexKelolaKas'}">
                    Kelola Kas
                </router-link></li>

                <li class='w-lnk'><router-link :to="{name: 'indexPelanggan'}">
                    Pelanggan
                </router-link></li>


                <li class='w-lnk'><router-link :to="{name: 'riwayatPenjualan'}">
                 Riwayat Penjualan
             </router-link></li>

             <li class='w-lnk'><router-link :to="{name: 'indexLaporan'}">
                Laporan
            </router-link></li>

            @endrole

        </ul>
        <!-- icon navigation -->
        <ul id='icons'>
            @if (Auth::check())
            <li><router-link :to="{name: 'indexDashboard'}">
                <i class="fa fa-home  fa-2x"></i>
            </router-link></li>
            <span class='nav_txt'>Home</span>
            @endif
            @role('member')
            <li><router-link :to="{name: 'indexPenjualan'}">
                <i class="fa fa-shopping-bag fa-2x"></i>
            </router-link></li>
            <span class='nav_txt'>Penjualan</span>
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
                <li><router-link :to="{name: 'indexProduk'}">
                    <i class="fa fa-tag fa-2x"></i>
                </router-link></li>
                <span class='nav_txt'>Produk</span>


            <li><router-link :to="{name: 'indexKelolaKas'}">
                <i class="fa fa-money fa-2x"></i>
            </router-link></li>
            <span class='nav_txt'>Kelola Kas</span>

            <li><router-link :to="{name: 'indexPelanggan'}">
                <i class="fa fa-users fa-2x"></i>
            </router-link></li>
            <span class='nav_txt'>Pelanggan</span>


            <li><router-link :to="{name: 'riwayatPenjualan'}">
                <i class="fa fa-history fa-2x"></i>
            </router-link></li>
            <span class='nav_txt'>Riwayat Penjualan</span>

            <li><router-link :to="{name:'indexLaporan'}">
                <i class="fa fa-file-archive-o fa-2x"></i>
            </router-link></li>
            <span class='nav_txt'>Laporan</span>
            @endrole

        </ul>
    </div>
</div>
</nav>
