<template>
    <div class="container">
        <ul class="breadcrumb">
            <li><router-link :to="{name: 'indexDashboard'}">Home</router-link></li>
            <li class="active">Data Toko</li>
        </ul>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <p class="panel-title">Data Toko</p>
                    </div>
                    <div class="panel-body">
                        <div class="pencarian">
                           <input type="text" class="form-control" name="search" placeholder="Pencarian"  v-model="search" >
                       </div>
                       <table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                           <thead>
                            <th>Nama Pemilik</th>
                            <th>Email</th>
                            <th>No. Tlp</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody v-if="users.length > 0 && loading == false" class="data-ada">
                            <tr v-for="user ,index in users">
                                <td>{{ user.nama_pemilik }}</td>
                                <td>{{ user.email }}</td>
                                <td>{{ user.no_telp }}</td>
                                <td>
                                    <router-link :to="{name: 'editUser', params: {id:user.id}}" class="btn btn-xs btn-default">
                                        Ubah Toko
                                    </router-link>
                                    <a href="#"
                                    class="btn btn-xs btn-danger" 
                                    v-on:click="deleteEntry(user.id, index,user.nama_toko)">Delete</a>
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
                    <vue-simple-spinner v-if="loading"></vue-simple-spinner>
                    <div align="right"><pagination :data="usersData" v-on:pagination-change-page="getUsers" v-if="search == '' "></pagination></div>
                    <div align="right"><pagination :data="usersData" v-on:pagination-change-page="getHasilPencarian" v-if="search != '' "></pagination></div>
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
         users: [],
         usersData: {},
         url : window.location.origin+(window.location.pathname).replace("home","user"),
         search : '',
         loading : true

     }
 },
 mounted() {
  var app = this;
  app.loading = true
  app.getUsers();	

},
watch: {
        // whenever question changes, this function will run
        search: function (newQuestion) {
        	this.getHasilPencarian();  
        }
    },
    methods: {
    	getUsers(page) {
    		var app = this;
    		if (typeof page === 'undefined') {
    			page = 1;
    		}
    		axios.get(app.url+'/view?page='+page)
    		.then(function (resp) {
    			app.loading = false
    			app.users = resp.data.data;
    			app.usersData = resp.data
                console.log(resp)

            })
    		.catch(function (resp) {
    			alert("Could not load users");
    		});
    	},
    	deleteEntry(id, index,name) {
    		if (confirm("Yakin Ingin Menghapus Staf "+name+" ?")) {
    			var app = this;
    			axios.delete(app.url+'/' + id)
    			.then(function (resp) {
    				app.getUsers();
    				app.alert(name)
                    app.$router.replace('/user');
                })
    			.catch(function (resp) {
    				alert("Could not delete user");
    			});
    		}
    	},
    	getHasilPencarian(page){
    		var app = this;
    		app.loading = true;
    		if (typeof page === 'undefined') {
    			page = 1;
    		}
    		axios.get(app.url+'/pencarian?search='+app.search+'&page='+page)
    		.then(function (resp) {
    			app.loading = false
    			app.users = resp.data.data;
    			app.usersData = resp.data;
    		})
    		.catch(function (resp) {
    			console.log(resp);
    			app.loading = false
    			alert("Could not load users");
    		});

    	},
    	alert(name) {
    		this.$swal({
    			title: "Berhasil!",
    			text: "Berhasil Menghapus "+ name,
    			icon: "success",
    		});
    	}
    }

}
</script>

