<style scoped>
.pencarian {
	color: red;

	float: right;
	padding-bottom: 10px;
}
table{
	min-width: 775px;
}
</style>

<template>  
	<div class="container">
		<ul class="breadcrumb">
			<li><router-link :to="{name: 'indexDashboard'}">Home</router-link></li>
			<li><router-link :to="{name: 'indexPenjualan'}">Penjualan</router-link></li>
			<li class="active">Data Penjualan Tersimpan</li>
		</ul>
		<div class="panel panel-default">
			<div class="panel-heading"><i class="fa fa-bookmark"></i> Data Penjualan Tersimpan</div>
			<div class="panel-body">
				<div class="table-responsive table">
					<div class="pencarian">
						<input type="text" class="form-control" name="search"placeholder="Pencarian"  v-model="search" >
					</div>
					<table class="table table-striped table-bordered">
						<thead class="thead-dark">
							<th class="col-md-2">Tanggal / Waktu</th>
							<th class="col-md-1">Waiters</th>
							<th class="col-md-2">Pelanggan</th>
							<!-- <th class="col-md-2">Produk</th> -->
							<th class=" col-md-2 text-right">Total</th>
							<th class=" col-md-3">Catatan</th>
							<th class=" col-md-1"></th>
						</thead>
						<tbody v-if="buka_penjualans.length > 0 && loading == false" class="data-ada">
							<tr v-for="buka_penjualan ,index in buka_penjualans">
								<td>{{ buka_penjualan.data_simpan_penjualan.waktu | tanggal}}</td>
								<td>{{ buka_penjualan.data_simpan_penjualan.nama_pemilik }}</td>
								<td v-if="buka_penjualan.data_simpan_penjualan.nama_pelanggan == null">Umum</td>
								<td v-else>{{ buka_penjualan.data_simpan_penjualan.nama_pelanggan }}</td>
								<!-- <td>
									<ul v-for="data_produk, index in buka_penjualan.data_produk">
										<li >{{ data_produk.nama_produk }}</li>
									</ul>
								</td> -->
								<td align="right">{{ buka_penjualan.data_simpan_penjualan.total_bayar | pemisahTitik}}</td>
								<td>{{ buka_penjualan.data_simpan_penjualan.catatan }} | No. Meja {{buka_penjualan.data_simpan_penjualan.nomor_meja}}</td>
								<td>
									<button class="btn btn-xs btn-primary" id="btnSimpanKategoriProduk" @click="saveForm(buka_penjualan.data_simpan_penjualan.id)" type="submit">buka</button>
								</td>
							</tr>
						</tbody>
						<tbody v-else-if="loading == true" class="data-ada" >
							<tr >
								<td colspan="6"  class="text-center">
									Sedang Memuat Data
								</td>
							</tr>
						</tbody>
						<tbody v-else class="tidak-ada-data">
							<tr>
								<td colspan="6"  class="text-center">
									Tidak Ada Data
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<vue-simple-spinner v-if="loading"></vue-simple-spinner>
				<div align="right"><pagination :data="buka_penjualan_data" v-on:pagination-change-page="getBukaPenjualan" v-if="search == '' "></pagination></div>
				<div align="right"><pagination :data="buka_penjualan_data" v-on:pagination-change-page="getHasilPencarian" v-if="search != '' "></pagination></div>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	data: function () {
		return {
			tbs_penjualans:[],
			buka_penjualans: [],
			buka_penjualan_data: {},
			url : window.location.origin+(window.location.pathname).replace("home","penjualan"),
			search : '',
			loading : true

		}
	},
	mounted() {
		var app = this;
		app.loading = true
		app.getBukaPenjualan();   
		app.getTbsPenjualan();

	},
	filters: {
		pemisahTitik: function(value) {
			var angka = [value];
			var numberFormat = new Intl.NumberFormat('es-ES');
			var formatted = angka.map(numberFormat.format);
			return formatted.join('; ');
		},

		tanggal: function (value) {

			if (value){
				return moment(String(value)).format('MM/DD/YYYY hh:mm');
			}
		}
	},
	watch: {
        // whenever question changes, this function will run
        search: function (newQuestion) {
        	this.getHasilPencarian();  
        }
    },
    methods: {
    	// melihat data bts_penjualans = ada / tidak
    	getTbsPenjualan() {
    		var app = this;
    		axios.get(app.url +'/tbs-penjualan')
    		.then(function (resp) {
    			app.tbs_penjualans = resp.data.data;
    			app.loadingTbs = false;
    			// console.log(resp.data.data);
    		})	
    		.catch(function () {
    			alert("Could not load tbs penjualan");
    		});
    	},
    	// menampilkan data simpan penjualan
    	getBukaPenjualan(page) {
    		var app = this;
    		if (typeof page === 'undefined') {
    			page = 1;
    		}
    		axios.get(app.url+'/view-buka-penjualan?page='+page)
    		.then(function (resp) {
    			app.loading = false
    			app.buka_penjualans = resp.data.data;
    			app.buka_penjualan_data = resp.data
    			// console.log(resp.data.data)

    		})
    		.catch(function (resp) {
    			alert("Could not load buka_penjualans");
    		});
    	},

    	saveForm(id) {
    		var app = this;
    		if (app.tbs_penjualans === undefined) {
    			axios.get(app.url+'/create-tbs-penjualan?id=' + id)
    			.then(function(resp) {
    				swal({
    					title: 'Berhasil!',
    					type: 'success',
    					text: 'Berhasil membuka ke penjualan',
    					showConfirmButton: false,
    					timer: 2000,
    				});
    				app.$router.replace('/penjualan');
    			})

    		} else{
    			var app = this;
    			app.$router.replace('/penjualan');
    			app.getBukaPenjualan();
    			swal({
    				title: 'Gagal!',
    				type: 'warning',
    				text: 'Selesaikan dahulu penjualan sebelumnya!'
    			});
    		}
    	}
    	// getHasilPencarian(page){
    	// 	var app = this;
    	// 	app.loading = true;
    	// 	if (typeof page === 'undefined') {
    	// 		page = 1;
    	// 	}
    	// 	axios.get(app.url+'/search?search='+app.search+'&page='+page)
    	// 	.then(function (resp) {
    	// 		app.loading = false
    	// 		app.buka_penjualans = resp.data.data;
    	// 		app.buka_penjualans_data = resp.data;
    	// 	})
    	// 	.catch(function (resp) {
    	// 		console.log(resp);
    	// 		app.loading = false
    	// 		alert("Could not load buka_penjualans");
    	// 	});

    	// }
    }

}
</script>