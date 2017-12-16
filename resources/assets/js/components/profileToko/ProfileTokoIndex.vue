</style>

<template>  
    <div class="container">
        <ul class="breadcrumb">
            <li><router-link :to="{name: 'indexDashboard'}">Home</router-link></li>
            <li class="active">Profile Toko</li>
        </ul>
        <div class="panel panel-default">
            <div class="panel-heading">Profile Toko</div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <th>Nama Toko</th>
                            <th>Nama Pemilik</th>
                            <th>Email</th>
                            <th>No. Telp</th>
                            <th>Alamat</th>
                            <th>Logo</th>
                            <th>Login Terakhir</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody v-if="profileTokos.length > 0 && loading == false" class="data-ada">
                            <tr v-for="profileToko , index in profileTokos" >
                                <td>{{profileToko.profileToko.nama_toko}}</td>
                                <td>{{profileToko.profileToko.nama_pemilik}}</td>
                                <td>{{profileToko.profileToko.email}}</td>
                                <td>{{profileToko.profileToko.no_telp}}</td>
                                <td>{{profileToko.profileToko.alamat}}</td>
                                <td>{{profileToko.profileToko.logo}}</td>
                                <td>{{profileToko.last_login}}</td>
                                <td>
                                    <router-link :to="{name: 'editProfileToko', params: {id: profileToko.profileToko.id}}" class="btn btn-xs btn-default" v-bind:id="'edit-' + profileToko.profileToko.id" >
                                    Edit  </router-link> 
                                </td>
                            </tr>
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
                 <pagination :data="profileTokosData" v-on:pagination-change-page="getProfileTokos"></pagination>
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
      profileTokos: [],
      // buat paginations
      profileTokosData: {},
      message : '',
      url : window.location.origin+(window.location.pathname).replace("home", "profile-toko"),
      loading : true
  }
},
mounted() {
	var app = this;
	app.getProfileTokos();
},
methods: {
        // method getprofileToko
        getProfileTokos(page) {
        	var app = this;
        	if (typeof page === 'undefined') {
        		page = 1;
        	}
        	axios.get(app.url+'/view?page='+page)
        	.then(function (resp) {
        		app.profileTokos = resp.data.data;
        		app.profileTokosData = resp.data;
        		app.loading = false;
        // buat cek ddi console
        console.log(app.profileTokos)
    })
        	.catch(function (resp) {
        		alert("Could not load Profile Tokos");
        		app.loading = false
        	});
        },
    }
}
</script>