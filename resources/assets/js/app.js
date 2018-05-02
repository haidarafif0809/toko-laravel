/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
 require('./bootstrap');
// chartjs package
require('chart.js');
// vue-charts package
require('hchs-vue-charts');
Vue.use(VueCharts);
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
import myDatepicker from 'vuejs-datepicker'
// chart.js
import VueChartJs from 'vue-chartjs'
Vue.use(money, {
    precision: 4
})
Vue.use(require('vue-chartist'))
Vue.use(BootstrapVue);
window.Vue.use(VueSwal)
window.Vue.use(Spinner)
window.Vue.use(VueChartJs)
Vue.component('line-chart', {
    extends: VueChartJs.Line,
    mounted() {
        this.renderChart({
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            datasets: [{
                label: 'Data Satu',
                backgroundColor: '#f87979',
                data: [40, 39, 10, 40, 39, 80, 40]
            }]
        }, {
            responsive: true,
            maintainAspectRatio: false
        })
    }
});
Vue.component('vue-chart', require('vue-chartjs'));
Vue.component('notification', require('./components/Notification.vue'));
Vue.component('pagination', require('laravel-vue-pagination'));
Vue.component('vue-simple-spinner', require('vue-simple-spinner'));
Vue.component('selectize-component', require('vue2-selectize'));
Vue.component('datepicker', require('vuejs-datepicker'));
Vue.component('example', require('./components/Example.vue'));
window.Vue.use(VueRouter);
window.Vue = require('vue');
//DASHBOARD
import DashboardIndex from './components/dashboard/Dashboard.vue'
//USER
import Datepicker from './components/datepicker/Datepicker.vue'
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
//Penjualan
import PenjualanIndex from './components/penjualan/PenjualanIndex.vue'
import BukaPenjualan from './components/penjualan/BukaPenjualan.vue'
import RiwayatPenjualan from './components/penjualan/RiwayatPenjualan.vue'
// toko
import TokoIndex from './components/toko/TokoIndex.vue'
import TokoEdit from './components/toko/TokoEdit.vue'
// profile toko
import ProfileTokoIndex from './components/profileToko/ProfileTokoIndex.vue'
import ProfileTokoEdit from './components/profileToko/ProfileTokoEdit.vue'
import LengkapiProfile from './components/profileToko/LengkapiProfile.vue'
// Kelola Kas
import KelolaKasIndex from './components/kelolaKas/KelolaKasIndex.vue'
import KelolaKasCreate from './components/kelolaKas/KelolaKasCreate.vue'
import KelolaKasEdit from './components/kelolaKas/KelolaKasEdit.vue'
// Laporan
import LaporanIndex from './components/laporan/LaporanIndex.vue'
import LaporanRingkasIndex from './components/laporan/LaporanRingkasIndex.vue'
import RekapKasIndex from './components/laporan/RekapKasIndex.vue'
import LaporanPenjualanHarianIndex from './components/laporan/LaporanPenjualanHarianIndex.vue'
import LaporanPenjualanPerJam from './components/laporan/LaporanPenjualanPerJam.vue'
import DataTransaksiPenjualan from './components/laporan/DataTransaksiPenjualan.vue'
import LaporanRekapitulasiKas from './components/laporan/LaporanRekapitulasiKas.vue'
// staf toko
import StafTokoIndex from './components/stafToko/StafTokoIndex.vue'
import StafTokoCreate from './components/stafToko/StafTokoCreate.vue'
import StafTokoEdit from './components/stafToko/StafTokoEdit.vue'
// if (typeof Chart === "undefined") throw "ChartJS is undefined";
// // 4 kb here
// window.VueCharts = {};
// VueCharts.core = require('./vue-chartjs-lib.js');
// VueCharts.install = function(Vue) {
//     // Vue.component('chartjs-line', require('./components/chartjs-line.vue'));
//     // Vue.component('chartjs-bar', require('./components/chartjs-bar.vue'));
//     Vue.component('chartjs-horizontal-ber', require('./components/chartjs-horizontal-bar.vue'));
//     Vue.component('chartjs-doughnut', require('./components/chartjs-doughnut.vue'));
// }
const routes = [{
    path: '/',
    components: {
        dashboardIndex: DashboardIndex
    },
    name: 'indexDashboard'
},
    // Master data Produk
    {
        path: '/datepicker',
        component: Datepicker,
        name: 'indexDatepicker'
    }, 
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
        path: '/admin/user',
        component: UserIndex,
        name: 'indexUser'
    }, {
        path: '/admin/user/create',
        component: UserCreate,
        name: 'createUser'
    }, {
        path: '/admin/user/edit/:id',
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
    },
    //Penjualan
    {
        path: '/penjualan',
        component: PenjualanIndex,
        name: 'indexPenjualan'
    },{
        path: '/penjualan/view-buka-penjualan',
        component: BukaPenjualan,
        name: 'bukaPenjualan'
    },{
        path: '/penjualan/riwayat-penjualan',
        component: RiwayatPenjualan,
        name: 'riwayatPenjualan'
    },
    // toko
    {
        path: '/admin/toko',
        component: TokoIndex,
        name: 'indexToko'
    }, {
        path: '/admin/toko/edit/:id',
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
    }, {
        path: '/profile-toko/lengkapi-profile/:id',
        component: LengkapiProfile,
        name: 'lengkapiProfile'
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
    }, {
        path: '/laporan/laporan-penjualan-harian',
        component: LaporanPenjualanHarianIndex,
        name: 'indexLaporanPenjualanHarian'
    }, {
        path: '/laporan/laporan-penjualan-perjam',
        component: LaporanPenjualanPerJam,
        name: 'indexLaporanPenjualanPerJam'
    },{
        path: '/laporan/data-transaksi-penjualan',
        component: DataTransaksiPenjualan,
        name: 'indexDataTransaksiPenjualan'
    },{
        path: '/laporan/rekapitulasi-kas',
        component: LaporanRekapitulasiKas,
        name: 'indexLaporanRekapitulasiKas'
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
    data: {
        notifications: ''
    },
    created(){
        var app = this;
        axios.post(window.location.origin+(window.location.pathname).replace('home', 'notification/get'))
        .then(resp =>{
            app.notifications = resp.data;
        })
    },
    router
}).$mount('#app')