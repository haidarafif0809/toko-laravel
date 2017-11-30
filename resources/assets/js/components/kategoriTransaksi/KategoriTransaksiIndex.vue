<template>
	<div class="container">
		<ul class="breadcrumb">
			<li><router-link :to="{name: 'indexDashboard'}">Home</router-link></li>
			<li class="active">Kategori Transaksi</li>
		</ul>
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<p class="panel-title">Table Kategori Transaksi</p>
					</div>
					<div class="panel-body">
						<div class="tambah-kategoriTransaksi">
							<p>
								<div class="tambah">
									<router-link :to="{name: 'createKategoriTransaksi'}" type="button" class="btn btn-primary">
										Tambah Kategori Transaksi
									</router-link>
								</div>
							</p>
						</div>
						<div class="pencarian">
							<input type="text" class="form-control" name="search" placeholder="Pencarian"  v-model="search" >
						</div>

						<table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
							<thead>
								<th>Nama Kategori Transaksi</th>

								<th>Aksi</th>
							</thead>
							<tbody v-if="kategoriTransaksis.length > 0 && loading == false" class="data-ada">
								<tr v-for="kategoriTransaksi ,index in kategoriTransaksis">
									<td>{{ kategoriTransaksi.nama_kategori_transaksi }}</td>

									<td>
										<router-link :to="{name: 'editKategoriTransaksi', params: {id:kategoriTransaksi.id}}" class="btn btn-xs btn-default">
											Edit
										</router-link>
										<a href="#"
										class="btn btn-xs btn-danger" 
										v-on:click="deleteEntry(kategoriTransaksi.id, index,kategoriTransaksi.nama_kategori_transaksi)">
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
					<vue-simple-spinner v-if="loading"></vue-simple-spinner>

					<div align="right"><pagination :data="kategoriTransaksiData" v-on:pagination-change-page="getKategoriTransaksis":limit="1" v-if="search == '' "></pagination></div>

					<div align="right"><pagination :data="kategoriTransaksiData" v-on:pagination-change-page="getHasilPencarian":limit="1" v-if="search != '' "></pagination></div>
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
			kategoriTransaksis: [],
			kategoriTransaksiData: {},
			url : window.location.origin+(window.location.pathname).replace("home","kategoriTransaksi"),
			search : '',
			loading : true

		}
	},
	mounted() {
		var app = this;
		app.loading = true
		app.getKategoriTransaksis();	

	},
	watch: {
        // whenever question changes, this function will run
        search: function (newQuestion) {
        	this.getHasilPencarian();  
        }
    },
    methods: {
    	getKategoriTransaksis(page) {
    		var app = this;
    		if (typeof page === 'undefined') {
    			page = 1;
    		}
    		axios.get(app.url+'/view?page='+page)
    		.then(function (resp) {
    			app.loading = false
    			app.kategoriTransaksis = resp.data.data;
    			app.kategoriTransaksiData = resp.data

    		})
    		.catch(function (resp) {
    			alert("Could not load kategoriTransaksis");
    		});
    	},
    	deleteEntry(id, index,nama_kategori_transaksi) {
    		if (confirm("Yakin Ingin Menghapus Kategori Transaksi "+nama_kategori_transaksi+" ?")) {
    			var app = this;
    			axios.delete(app.url+'/' + id)
    			.then(function (resp) {
    				app.getKategoriTransaksis();
    				app.alert(nama_kategori_transaksi)
    				app.$router.replace('/kategoriTransaksi');
    			})
    			.catch(function (resp) {
    				alert("Could not delete Kategori Transaksi");
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
    			app.kategoriTransaksis = resp.data.data;
    			app.kategoriTransaksiData = resp.data;
    		})
    		.catch(function (resp) {
    			console.log(resp);
    			app.loading = false
    			alert("Could not load kategori Transaksis");
    		});


    	},
    	alert(nama_kategori_transaksi) {
    		this.$swal({
    			title: "Berhasil!",
    			text: "Berhasil Menghapus "+ nama_kategori_transaksi,
    			icon: "success",
    		});
    	}
    }

}
</script>

