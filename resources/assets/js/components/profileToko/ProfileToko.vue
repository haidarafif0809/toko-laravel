<style scoped>
.pencarian {
	color: red;

	float: right;
	padding-bottom: 10px;
}
</style>

<template>  
	<div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <ul class="breadcrumb">
         <li><router-link :to="{name: 'indexDashboard'}">Home</router-link></li>
         <li class="active">Profile Toko</li>
       </ul>

       <div class="panel panel-default">
         <div class="panel-heading">Profile Toko</div>
         <div class="panel-body">
          <div class="table-responsive">
            <table class="table table-striped table-hover">
              <tbody v-if="tokos.length > 0 && loading == false" class="data-ada">
                <tr v-for="toko , index in tokos" >
                  <td class="text-muted">NAMA TOKO</td>
                  <td>: {{toko.profile_toko.nama_toko}}</td>
                </tr>
                <tr v-for="toko , index in tokos" >
                  <td class="text-muted">NAMA PEMILIK TOKO</td>
                  <td>: {{toko.profile_toko.nama_pemilik}}</td>
                </tr>
                <tr v-for="toko , index in tokos" >
                  <td class="text-muted">ALAMAT EMAIL</td>
                  <td>: {{toko.profile_toko.email}}</td>
                </tr>
                <tr v-for="toko , index in tokos" >
                  <td class="text-muted">ALAMAT/TEMPAT</td>
                  <td>: {{toko.profile_toko.alamat}}</td>
                </tr>
                <tr v-for="toko , index in tokos" >
                  <td class="text-muted">LOGO TOKO</td>
                  <td>: {{toko.profile_toko.logo}}</td>
                </tr>
                <tr v-for="toko , index in tokos" >
                  <td class="text-muted">NOMOR TELP</td>
                  <td>: {{toko.profile_toko.no_telp}}</td>
                </tr>
                <tr v-for="toko , index in tokos" >
                  <td class="text-muted">LOGIN TERAKHIR </td>
                  <td>: {{toko.last_login}}</td>
                </tr><br>
                <ul>
                  <span v-for="toko , index in tokos">
                    <router-link :to="{name: 'editProfileToko', params: {id: toko.profile_toko.id}}" class="btn btn-md btn-primary" v-bind:id="'edit-' + toko.profile_toko.id" >
                    Edit  </router-link> 
                  </span>
                </ul>
              </tbody>

              <tbody v-else-if="loading == true" class="data-ada" >
               <tr >
                <td colspan="4"  class="text-center">
                 Sedang Memuat Data
               </td>
             </tr>
           </tbody>
           <tbody v-else class="tidak-ada-data">
             <tr>
              <td colspan="4"  class="text-center">
               Tidak Ada Data
             </td>
           </tr>
         </tbody>
       </table>

     </div>
     <vue-simple-spinner v-if="loading"></vue-simple-spinner>

     <div align="right">
       <pagination :data="tokosData" v-on:pagination-change-page="getTokos"></pagination>
     </div>
   </div>
 </div>
</div>
</div>
</div>
</template>


<script>
export default {
	data: function () {
		return {
      // buat nampilin data dlm bentuk array
      tokos: [],
      // buat paginations
      tokosData: {},
      pencarian: '',
      message : '',
      url : window.location.origin+(window.location.pathname).replace("home", "profile-toko"),
      loading : true
    }
  },
  mounted() {
   var app = this;
   app.getTokos();
 },

 methods: {
        // method getkategoriProduk
        getTokos(page) {
        	var app = this;
        	if (typeof page === 'undefined') {
        		page = 1;
        	}
        	axios.get(app.url+'/view?page='+page)
        	.then(function (resp) {
        		app.tokos = resp.data.data;
        		app.tokosData = resp.data;
        		app.loading = false;
        // buat cek ddi console
        console.log(resp.data.data)
      })
        	.catch(function (resp) {
        		alert("Could not load tokos");
        		app.loading = false
        	});
        },
        alert(nama_toko) {
        	this.$swal({
        		title: "Berhasil!",
        		text: 'Sukses : Berhasil menghapus Kas Masuk '+ nama_toko,
        		icon: "success",
        	});
        }
      }
    }
    </script>