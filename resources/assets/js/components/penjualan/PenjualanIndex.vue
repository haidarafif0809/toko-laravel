<style scoped>
.cart-item {
	max-height: 160px;
	overflow-y: scroll;
}
</style>

<template>
	<div class="container">
		<ul class="breadcrumb">
			<li><router-link :to="{name: 'indexDashboard'}">Home</router-link></li>
			<li class="active">Penjualan</li>
		</ul>

		<div>
			<div class="col-md-8">
				<div class="panel panel-default">
					<div class="panel-heading">Daftar Produk</div>

					<div class="panel-body">
						<div class="row">
							<div class="col-md-12 pencarian">
								<input type="text" class="form-control" name="search" placeholder="Pencarian Produk"  v-model="search" >
							</div>
						</div>	
						<br>
						<div class="row">
							<div v-if="produksPenjualan.length > 0 && loading == false" class="data-ada">	
								<div v-if="produksPenjualan.length == 1">
									<div v-for="produk , index in produksPenjualan" class="col-md-4 list-produk">
										<div class="thumbnail">
											<div class="caption"  @click="submitTbsPenjualan(produk)">
												<h4 v-if="produk.data_produk.nama_produk.length > 15">
													{{produk.data_produk.nama_produk.slice(0, 15)}}...
												</h4>
												<h4 v-else>
													{{produk.data_produk.nama_produk}}
												</h4>
												<p>Harga: {{produk.data_produk.harga_jual}}</p>
											</div>
										</div>
									</div>
									
								</div>
								<div v-else>
									<div v-for="produk , index in produksPenjualan" class="col-md-4 list-produk">
										<div class="thumbnail">
											<div class="caption"  @click="submitTbsPenjualan(produk)">
												<h4 v-if="produk.data_produk.nama_produk.length > 15">
													{{produk.data_produk.nama_produk.slice(0, 15)}}...
												</h4>
												<h4 v-else>
													{{produk.data_produk.nama_produk}}
												</h4>
												<p>Harga: {{produk.data_produk.harga_jual}}</p>
											</div>
										</div>
									</div>
									
								</div>
							</div>
						</div>
					</div>

					<vue-simple-spinner v-if="loading"></vue-simple-spinner>

					<div align="right">
						<pagination :data="dataProduksPenjualan" v-on:pagination-change-page="getProduksPenjualan" :limit="3"></pagination>
					</div>
					<div align="right">
<!-- 						<pagination :data="dataProduksPenjualan" v-on:pagination-change-page="getHasilPencarian":limit="1" v-if="search != '' "></pagination>
-->					</div>
</div>
</div>
</div>

<div class="col-md-4">
	<div class="panel panel-default">
		<div class="panel-heading">Pesanan</div>
		<ul class="list-group cart-item">




			<!-- <li class="list-group-item list-group-item-warning">Tidak ada item</li> -->
			<div v-if="tbs_penjualans.length > 0 && loadingTbs == false" class="data-ada">	
				<li class="list-group-item" track-by="id" v-for="tbsPenjualan, index in tbs_penjualans">
					<div>
						<small>
							<span class="small" v-if="tbsPenjualan.nama_produk.length > 15">
								{{ tbsPenjualan.nama_produk.slice(0, 15) }}...
							</span>
							<span class="small" v-else>
								{{ tbsPenjualan.nama_produk}}
							</span>

							<span class="small" style="float: right;">					
								({{ tbsPenjualan.harga_produk }} x {{ tbsPenjualan.jumlah_produk }}) : {{ tbsPenjualan.subtotal }}
							</span>
						</small>
					</div>
				</li>
			</div>




			<div v-else-if="loadingTbs == true" class="text-center">
				<li>Sedang Memuat Produk</li>
			</div>
			<div v-else class="list-group-item list-group-item-warning">
				Tidak Ada Produk
			</div>
			<vue-simple-spinner v-if="loadingTbs"></vue-simple-spinner>
		</ul>

		<div class="panel-footer">
			Total Item: {{ tbs_penjualans.length }}
			<span class="pull-right">
				<!-- <i class="glyphicon glyphicon-refresh cart-item-action" v-on:click="clearCart()"></i> -->
			</span>
		</div>
	</div>

	<div class="panel panel-default">
		<div class="panel-body">
			<form>
				<div class="form-group">
					<label class="control-label">Total Bayar</label>
					<br>
					<br>
					<h1 align="center"><b>{{ tbs_penjualans.total_bayar }}</b><!-- <span class="glyphicon glyphicon-remove"></span> --></h1>
					<h2 class="form-control-static text-warning"></h2>
				</div>

				<div  class="form-group">
					<label class="control-label"> Nama Pelanggan:</label>
					<selectize-component v-model="penjualan.nama_pelanggan" :settings="setting_pelanggan"> 
						<option v-for="pelanggan in pelanggans" v-bind:value="pelanggan.id" >{{ pelanggan.nama_pelanggan }}</option>
					</selectize-component>
				</div>

				<div class="form-group">
					<div class="input-group">
						<input type="number" class="form-control" placeholder="Pembayaran">
						<span class="input-group-btn">
							<button class="btn btn-success">Bayar</button>
						</span>
					</div>
				</div>

				<div class="form-group">
					<label class="control-label">Keterangan</label>
					<textarea class="form-control"></textarea>
				</div> 
			</form>
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
			penjualan:[],
			pelanggans:[],
			produksPenjualan: [],
			tbs_penjualans: [],
			dataProduksPenjualan:{},
			inputTbsPenjualan: {
				satuan:'',
				produk_id:'',
				jumlah: '',
				harga:'',
				total_bayar: '',
			},
			search: '',
			url : window.location.origin + (window.location.pathname).replace("home", "penjualan"),
			urlTbs : window.location.origin + (window.location.pathname).replace("home", "proses-tbs-penjualan"),
			loading : true,
			loadingTbs : true,

			setting_pelanggan:{
				placeholder: 'Pilih Pelanggan'
			},
		}
	},
	mounted() {
		var app = this;
		app.loading = true
		app.loadingTbs = true
		app.getProduksPenjualan();
		app.getTbsPenjualan();
		app.selectPelanggans();
	},

	watch: {
	    // whenever question changes, this function will run
	    search: function (newQuestion) {
	    	this.getHasilPencarian()
	    }
	},
	methods: {
		getProduksPenjualan(page) {
			var app = this;
			if (typeof page === 'undefined') {
				page = 1;
			}

			axios.get(app.url+'/view?page='+page)
			.then(function (resp) {
				app.loading = false;
				app.produksPenjualan = resp.data.data;
				app.dataProduksPenjualan = resp.data;
				console.log(resp.data.data);

			})
			.catch(function (resp) {
				alert("Could not load produksPenjualan");
				app.loading = false
			});
		},
		getTbsPenjualan() {
			var app = this;
			axios.get(app.url +'/tbs-penjualan')
			.then(function (resp) {
				if (resp.data.length == 2) {

					app.tbs_penjualans = resp.data[0];
					app.tbs_penjualans.total_bayar = resp.data[1]
					app.loadingTbs = false;
				}
				else {
					
					app.tbs_penjualans = resp.data;
				}
				// console.log(resp.data.length);
				// app.tbs_penjualans.total_item = 
				
			})	
			.catch(function () {
				alert("Could not load tbs penjualan");
			});

		},

		selectPelanggans() {
			var app = this;
			axios.get(app.url+'/pelanggan')
			.then(function (resp) {
				app.pelanggans = resp.data;
			})
			.catch(function (resp) {
				alert("Could not load pelanggan");
			});
		},

		getHasilPencarian(page) {
			var app = this;
			app.loading = true;
			if (typeof page === 'undefined') {
				page = 1;
			}

			axios.get(app.url+'/pencarian?search='+app.search+'&page='+page)
			.then(function (resp) {
				app.loading = false    
				app.produksPenjualan = resp.data;
				app.dataProduksPenjualan = resp;
				console.log(resp.data);
			})
			.catch(function (resp) {
				alert("Tidak dapat memuat produk..");
				app.loading = false;
			});
		},
		submitTbsPenjualan(produk){
			var app = this;
			app.inputTbsPenjualan.produk_id = produk.data_produk.produk_id;
			app.inputTbsPenjualan.harga = produk.data_produk.harga_jual;
			app.inputTbsPenjualan.satuan = produk.data_produk.satuans_id;
			app.inputTbsPenjualan.jumlah = 1;
			var newTbs = app.inputTbsPenjualan;

			axios.post(app.urlTbs, newTbs)
			.then(function (resp) {
				app.message = 'Sukses : Berhasil Menambah "'+ produk.data_produk.nama_produk+'" ke Pemesanan';
				app.alert(app.message);
				app.$router.replace('/penjualan');
				app.getTbsPenjualan();
				app.$swal.close();
			})
			.catch(function (resp) {
				console.log(resp)

				app.success = false;
				app.errors = resp.response.data.errors;
			});
		},
	// deleteEntry(id, index,nama_produk) {
	// 	if (confirm("Yakin Ingin Menghapus produk "+nama_produk+" ?")) {
	// 		var app = this;
	// 		axios.delete(app.url+'/' + id)
	// 		.then(function (resp) {
	// 			app.getProduks();
	// 			app.alert("Berhasil Menghapus produk "+nama_produk)
	// 		})
	// 		.catch(function (resp) {
	// 			alert("Tidak dapat menghapus produk!");
	// 		});
	// 	}
	// },
	alert(pesan) {
		this.$swal({
			title: "Berhasil!",
			text: pesan,
			icon: "success",
		});
	}

}
}
</script>
