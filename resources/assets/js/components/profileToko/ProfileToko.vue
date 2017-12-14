<style scoped>
.pencarian {
	color: red;

	float: right;
	padding-bottom: 10px;
}
</style>

<template>  
	<div class="container">
		<ul class="breadcrumb">
			<li><router-link :to="{name: 'indexDashboard'}">Home</router-link></li>
			<li class="active">Data Toko</li>
		</ul>

		<div class="panel panel-default">
			<div class="panel-heading">Data Toko</div>
			<div class="panel-body">
				<div class="table-responsive">
					<div class="pencarian">
						<input type="text" class="form-control" name="pencarian"placeholder="Pencarian"  v-model="pencarian" >
					</div>
					<table class="table table-striped table-hover">
						<thead>
							<th>Nama Toko</th>
							<th>Nama Pemilik</th>
							<th>Email</th>
							<th>Alamat</th>
							<th>Logo Toko</th>
							<th>No. Telp</th>
							<th>Aksi</th>
						</thead>
						<tbody v-if="tokos.length > 0 && loading == false" class="data-ada">
							<tr v-for="toko , index in tokos" >
								<td>{{toko.nama_toko}}</td>
								<td>{{toko.nama_pemilik}}</td>
								<td>{{toko.email}}</td>
								<td>{{toko.alamat}}</td>
								<td>{{toko.logo}}</td>
								<td>{{toko.no_telp}}</td>
								<td>
									<a href="#"
									class="btn btn-xs btn-danger" 
									v-on:click="deleteToko(toko.id, index,toko.nama_toko)">Delete</a>
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
					<pagination :data="tokosData" v-on:pagination-change-page="getTokos"></pagination>
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
watch: {
        // whenever question changes, this function will run
        pencarian: function (newQuestion) {
        	var app = this;
        	app.searchData()
        }
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
        searchData(page) {
        	var app = this;
        	app.loading == true;
        	if (typeof page === 'undefined') {
        		page = 1;
        	}
        	axios.get(app.url+'/search?pencarian='+app.pencarian+'&page='+page)
        	.then(function(resp) {
        		app.tokos = resp.data.data;
        		app.tokosData = resp.data;
        		app.loading = false;

        	})
        	.catch(function(resp) {
        		alert("data tidak ditemukan");
        		app.loading = false
        	});
        },
        deleteToko(id, index,nama_toko) {
        	swal({
        		title: "Konfirmasi Hapus",
        		text : "Anda Yakin Ingin Menghapus "+nama_toko+" ?",
        		icon : "warning",
        		buttons: true,
        		dangerMode: true,
        	})
        	.then((willDelete) => {
        		if (willDelete) {
        			var app = this;
        			axios.delete(app.url+'/' + id)
        			.then(function (resp) {
        				app.getTokos();
        				swal("Berhasil Dihapus!  ", {
        					icon: "success",
        				});
        			})
        			.catch(function (resp) {
        				app.$router.replace('/toko/');
        				swal("Gagal Menghapus!", {
        					icon: "warning",
        				});
        			});
        		}
        		this.$router.replace('/toko/');
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