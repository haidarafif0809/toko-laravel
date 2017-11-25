
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
 Vue.component('vue-simple-spinner', require('vue-simple-spinner'))

 window.Vue.use(VueRouter);

 window.Vue = require('vue');

//DASHBOARD
import DashboardIndex from './components/dashboard/Dashboard.vue'

//USER
import UserIndex from './components/user/UserIndex.vue'
import UserCreate from './components/user/UserCreate.vue'
import UserEdit from './components/user/UserEdit.vue'

const routes = [
{
	path: '/',
	components: {
		dashboardIndex:DashboardIndex
	},
	name : 'indexDashboard'
},

 //USER

 {
 	path: '/user', component:UserIndex,name:'indexUser'
 } ,
 {
 	path: '/user/create',component:UserCreate,name:'createUser' 
 },
 {
 	path: '/user/edit/:id',component:UserEdit,name:'editUser'
 }
 ]
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

 //Vue.component('example', require('./components/Example.vue'));

 const router =  new VueRouter({routes})
 const app = new Vue ({router}).$mount('#app')