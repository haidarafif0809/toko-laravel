
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

// master data satuan
import SatuanIndex from './components/satuan/SatuanIndex.vue'
import SatuanCreate from './components/satuan/SatuanCreate.vue'
import SatuanEdit from './components/satuan/SatuanEdit.vue'

// kategori produk
import KategoriProdukIndex from './components/kategoriProduk/KategoriProdukIndex.vue'
import KategoriProdukCreate from './components/kategoriProduk/KategoriProdukCreate.vue'
import KategoriProdukEdit from './components/kategoriProduk/KategoriProdukEdit.vue'

// kas Masuk
import KasMasukIndex from './components/kasMasuk/KasMasukIndex.vue'
import KasMasukCreate from './components/kasMasuk/KasMasukCreate.vue'
import KasMasukEdit from './components/kasMasuk/KasMasukEdit.vue'

const routes = [
{
	path: '/',
	components: {
		dashboardIndex:DashboardIndex
	},
	name : 'indexDashboard'
},

// Master data Produk
{ path: '/produk', component: ProdukIndex, name: 'indexProduk' },
{ path: '/produk/create', component: ProdukCreate, name: 'createProduk' },
{ path: '/produk/edit/:id', component: ProdukEdit, name: 'editProduk' },
{ path: '/produk/detail/:id', component: ProdukDetail, name: 'detailProduk' },

// Master data satuan
{path: '/satuan',component:SatuanIndex,name:'indexSatuan'},
{path: '/satuan-create',component:SatuanCreate,name:'createSatuan'},
{path: '/satuan-edit',component:SatuanEdit,name:'editSatuan'},

 //USER

 { path: '/user', component:UserIndex,name:'indexUser' } ,
 { path: '/user/create',component:UserCreate,name:'createUser' },
 { path: '/user/edit/:id',component:UserEdit,name:'editUser' },

// kategori produk
{ path: '/kategoriProduk', component: KategoriProdukIndex, name: 'indexKategoriProduk' },
{ path: '/kategoriProduk/create', component: KategoriProdukCreate, name: 'createKategoriProduk' },
{ path: '/kategoriProduk/edit/:id', component: KategoriProdukEdit, name: 'editKategoriProduk' },
// kas Masuk
{ path: '/kasMasuk', component: KasMasukIndex, name: 'indexKasMasuk' },
{ path: '/kasMasuk/create', component: KasMasukCreate, name: 'createKasMasuk' },
{ path: '/kasMasuk/edit/:id', component: KasMasukEdit, name: 'editKasMasuk' }
]
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

 //Vue.component('example', require('./components/Example.vue'));

 const router =  new VueRouter({routes})
 const app = new Vue ({router}).$mount('#app')