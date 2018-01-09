/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');
window.Vue = require('vue');
var VueResource = require('vue-resource');
Vue.use(VueResource);
import VueRouter from 'vue-router';
import VueSwal from 'vue-swal'
import Spinner from 'vue-simple-spinner'
import BootstrapVue from 'bootstrap-vue'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import Vue from 'vue'
import money from 'v-money'
Vue.use(money, {
    precision: 4
})
Vue.use(BootstrapVue);
window.Vue.use(VueSwal)
window.Vue.use(Spinner)
Vue.component('pagination', require('laravel-vue-pagination'));
Vue.component('vue-simple-spinner', require('vue-simple-spinner'));
Vue.component('selectize-component', require('vue2-selectize'));
window.Vue.use(VueRouter);
window.Vue = require('vue');
//DASHBOARD
import DashboardIndex from './components/dashboard/Dashboard.vue'
//USER
import UserIndex from './components/user/UserIndex.vue'
import UserCreate from './components/user/UserCreate.vue'
import UserEdit from './components/user/UserEdit.vue'

// Master Data Produk
import ProdukIndex from './components/produk/ProdukIndex.vue'
import ProdukCreate from './components/produk/ProdukCreate.vue'
import ProdukEdit from './components/produk/ProdukEdit.vue'
import ProdukDetail from './components/produk/ProdukDetail.vue'

// kategori produk
import KategoriProdukIndex from './components/kategoriProduk/KategoriProdukIndex.vue'
import KategoriProdukCreate from './components/kategoriProduk/KategoriProdukCreate.vue'
import KategoriProdukEdit from './components/kategoriProduk/KategoriProdukEdit.vue'

// master data pelanggan
import PelangganIndex from './components/pelanggan/PelangganIndex.vue'
import PelangganCreate from './components/pelanggan/PelangganCreate.vue'
import PelangganEdit from './components/pelanggan/PelangganEdit.vue'
import PelangganDetail from './components/pelanggan/PelangganDetail.vue'

//Penjualan
import PenjualanIndex from './components/penjualan/PenjualanIndex.vue'
// toko
import TokoIndex from './components/toko/TokoIndex.vue'
import TokoEdit from './components/toko/TokoEdit.vue'
// profile toko
import ProfileTokoIndex from './components/profileToko/ProfileTokoIndex.vue'
import ProfileTokoEdit from './components/profileToko/ProfileTokoEdit.vue'
// Kelola Kas
import KelolaKasIndex from './components/kelolaKas/KelolaKasIndex.vue'
import KelolaKasCreate from './components/kelolaKas/KelolaKasCreate.vue'
import KelolaKasEdit from './components/kelolaKas/KelolaKasEdit.vue'
// Laporan
import LaporanIndex from './components/laporan/LaporanIndex.vue'
import LaporanRingkasIndex from './components/laporan/LaporanRingkasIndex.vue'
import RekapKasIndex from './components/laporan/RekapKasIndex.vue'
// staf toko
import StafTokoIndex from './components/stafToko/StafTokoIndex.vue'
import StafTokoCreate from './components/stafToko/StafTokoCreate.vue'
import StafTokoEdit from './components/stafToko/StafTokoEdit.vue'
//gerai
import GeraiIndex from './components/gerai/GeraiIndex.vue'
import GeraiCreate from './components/gerai/GeraiCreate.vue'
import GeraiEdit from './components/gerai/GeraiEdit.vue'
 
const routes = [{
        path: '/',
        components: {
            dashboardIndex: DashboardIndex
        },
        name: 'indexDashboard'
    },
    // Master data Produk
    {
        path: '/produk',
        component: ProdukIndex,
        name: 'indexProduk'
    }, {
        path: '/produk/create',
        component: ProdukCreate,
        name: 'createProduk'
    }, {
        path: '/produk/edit/:id',
        component: ProdukEdit,
        name: 'editProduk'
    }, {
        path: '/produk/detail/:id',
        component: ProdukDetail,
        name: 'detailProduk'
    },
    //USER
    {
        path: '/user',
        component: UserIndex,
        name: 'indexUser'
    }, {
        path: '/user/create',
        component: UserCreate,
        name: 'createUser'
    }, {
        path: '/user/edit/:id',
        component: UserEdit,
        name: 'editUser'
    },
    // kategori produk
    {
        path: '/kategoriProduk',
        component: KategoriProdukIndex,
        name: 'indexKategoriProduk'
    }, {
        path: '/kategoriProduk/create',
        component: KategoriProdukCreate,
        name: 'createKategoriProduk'
    }, {
        path: '/kategoriProduk/edit/:id',
        component: KategoriProdukEdit,
        name: 'editKategoriProduk'
    },
    // Master data pelanggan
    {
        path: '/pelanggan',
        component: PelangganIndex,
        name: 'indexPelanggan'
    }, {
        path: '/pelanggan-create',
        component: PelangganCreate,
        name: 'createPelanggan'
    }, {
        path: '/pelanggan-edit',
        component: PelangganEdit,
        name: 'editPelanggan'
    }, {
        path: '/pelanggan/detail/:id',
        component: PelangganDetail,
        name: 'detailPelanggan'
    },
    //Penjualan
    {
        path: '/penjualan',
        component: PenjualanIndex,
        name: 'indexPenjualan'
    },
    // toko
    {
        path: '/toko',
        component: TokoIndex,
        name: 'indexToko'
    }, {
        path: '/toko/edit/:id',
        component: TokoEdit,
        name: 'editToko'
    },
    // profile toko
    {
        path: '/profile-toko',
        component: ProfileTokoIndex,
        name: 'profileTokoIndex'
    }, {
        path: '/profile-toko/edit/:id',
        component: ProfileTokoEdit,
        name: 'editProfileToko'
    },
    // Kelola Kas
    {
        path: '/kelola-kas',
        component: KelolaKasIndex,
        name: 'indexKelolaKas'
    }, {
        path: '/kelola-kas/create',
        component: KelolaKasCreate,
        name: 'createKelolaKas'
    }, {
        path: '/kelola-kas/edit/:id',
        component: KelolaKasEdit,
        name: 'editKelolaKas'
    },
    // Laporan
    {
        path: '/laporan',
        component: LaporanIndex,
        name: 'indexLaporan'
    }, {
        path: '/laporan-ringkas',
        component: LaporanRingkasIndex,
        name: 'indexLaporanRingkas'
    }, {
        path: '/laporan/rekap_kas',
        component: RekapKasIndex,
        name: 'indexRekapKas'
    },
    // staf toko
    {
        path: '/staf-toko',
        component: StafTokoIndex,
        name: 'indexStafToko',
    }, {
        path: '/staf-toko/create',
        component: StafTokoCreate,
        name: 'createStafToko',
    }, {
        path: '/staf-toko/edit/:id',
        component: StafTokoEdit,
        name: 'editStafToko',
    },
    // Gerai
    {
        path: '/gerai',
        component: GeraiIndex,
        name: 'indexGerai'
    }, {
        path: '/gerai/create',
        component: GeraiCreate,
        name: 'createGerai'
    }, {
        path: '/gerai/edit',
        component: GeraiEdit,
        name: 'editGerai'
    } 
]
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
//Vue.component('example', require('./components/Example.vue'));
const router = new VueRouter({
    routes
})
const app = new Vue({
    router
}).$mount('#app')