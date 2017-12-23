<template>
	<div class="container">
		<ol class="breadcrumb">
			<li><router-link :to="{name: 'indexDashboard'}">Home</router-link></li>
			<li class="active">Pelanggan</li>
		</ol>
		<div class="panel panel-default">
			<div class="panel-heading">Pelanggan</div>

			<div class="panel-body">
				<div class="table-responsive">
					<div class="tambah">
						<p><router-link :to="{name: 'createPelanggan'}" type="button" class="btn btn-primary">
						Tambah Pelanggan</router-link></p>
					</div>
					<div class="pencarian">
						<input type="text" class="form-control" name="search" placeholder="Pencarian"  v-model="search" >
					</div>
					<table class="table table-striped table-hover">
						<thead>
							<th>Kode Pelanggan</th>
							<th>Nama Pelanggan</th>
							<th>Jenis Kelamin</th>
							<th>Tanggal Lahir</th>
							<th>Nomor Telepon</th>
							<th>Email</th>
							<th>Alamat</th>
							<th>Kota</th>
							<th>Kode Pos</th>
							<th>Catatan</th>
							<th>Aksi</th>
						</thead>
						<tbody v-if="pelanggans.length > 0 && loading == false" class="data-ada">
							<tr v-for="pelanggan ,index in pelanggans">
								<td>{{ pelanggan.kode_pelanggan }}</td>
								<td>{{ pelanggan.nama_pelanggan }}</td>
								<td v-if="pelanggan.jenis_kelamin == 1">Laki-laki</td>
								<td v-else>Perempuan</td>
								<td>{{ pelanggan.tanggal_lahir }}</td>
								<td>{{ pelanggan.nomor_telepon }}</td>
								<td>{{ pelanggan.email }}</td>
								<td>{{ pelanggan.alamat }}</td>
								<td>{{ pelanggan.kota }}</td>
								<td>{{ pelanggan.kode_pos }}</td>
								<td>{{ pelanggan.catatan }}</td>

								<td>
									<router-link :to="{name: 'editPelanggan', params: {id:pelanggan.id}}" class="btn btn-xs btn-default">
										Edit
									</router-link>
									<a href="#"
									class="btn btn-xs btn-danger" 
									v-on:click="deleteEntry(pelanggan.id, index,pelanggan.nama_pelanggan)">
									Delete
								</a>
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
			<div align="right"><pagination :data="pelanggansData" v-on:pagination-change-page="getPelanggans":limit="1" v-if="search == '' "></pagination></div>
			<div align="right"><pagination :data="pelanggansData" v-on:pagination-change-page="getHasilPencarian":limit="1" v-if="search != '' "></pagination></div>
		</div>
	</div>
</div>
</template>

<script>
export default {
	data: function () {
		return {
			pelanggans: [],
			pelanggansData: {},
			url : window.location.origin+(window.location.pathname).replace("home","pelanggan"),
			search : '',
			loading : true

		}
	},
	mounted() {
		var app = this;
		app.loading = true
		app.getPelanggans();	

	},
	watch: {
        // whenever question changes, this function will run
        search: function (newQuestion) {
        	this.getHasilPencarian();  
        }
    },
    methods: {
    	getPelanggans(page) {
    		var app = this;
    		if (typeof page === 'undefined') {
    			page = 1;
    		}
    		axios.get(app.url+'/view?page='+page)
    		.then(function (resp) {
    			app.loading = false
    			app.pelanggans = resp.data.data;
    			app.pelanggansData = resp.data

    		})
    		.catch(function (resp) {
    			alert("Could not load pelanggans");
    		});
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
    			app.pelanggans = resp.data.data;
    			app.pelanggansData = resp.data;
    		})
    		.catch(function (resp) {
    			console.log(resp);
    			app.loading = false
    			alert("Could not load pelanggans");
    		});
    	},


    	deleteEntry(id, index,nama_pelanggan) {
    		swal({
    			title: "Konfirmasi Hapus",
    			text : "Anda Yakin Ingin Menghapus "+nama_pelanggan+" ?",
    			icon : "warning",
    			buttons: true,
    			dangerMode: true,
    		})
    		.then((willDelete) => {
    			if (willDelete) {
    				var app = this;
    				axios.delete(app.url+'/' + id)
    				.then(function (resp) {
    					app.getPelanggans();
    					swal("Pelanggan Berhasil Dihapus!  ", {
    						icon: "success",
    					});
    				})
    				.catch(function (resp) {
    					app.$router.replace('/pelanggan/');
    					swal("Gagal Menghapus Pelanggan!", {
    						icon: "warning",
    					});
    				});
    			}
    			this.$router.replace('/pelanggan/');
    		});
    	},
    }
}
</script>

