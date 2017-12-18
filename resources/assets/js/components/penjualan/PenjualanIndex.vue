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
							<div v-for="produk , index in produks" class="col-md-4 list-produk">
								<div class="thumbnail">
									<div class="caption"  @click="submitTbsPenjualan(produk)">
										<h4>{{produk.data_produk.nama_produk}}</h4>
										<p>Harga: {{produk.data_produk.harga_jual}}</p>
									</div>
								</div>
							</div>
						</div>
					</div>

					<vue-simple-spinner v-if="loading"></vue-simple-spinner>

					<div align="right">
						<pagination :data="produksData" v-on:pagination-change-page="getPenjualans" :limit="3"></pagination>
					</div>
					<div align="right">
						<pagination :data="produksData" v-on:pagination-change-page="getHasilPencarian":limit="1" v-if="search != '' "></pagination>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-4">
			<div class="panel panel-default">
				<div class="panel-heading">Pesanan</div>
				<ul class="list-group cart-item">

					<!-- <li class="list-group-item list-group-item-warning">Tidak ada item</li> -->
					<div v-if="tbs_penjualans.length > 0 && loading == false" class="data-ada">	
						<li class="list-group-item" track-by="id" v-for="tbsPenjualan, index in tbs_penjualans">
							{{ tbsPenjualan.nama_produk }} 
							<!-- <span class="pull-right">  -->
								<!-- <i class="glyphicon glyphicon-remove cart-item-action" v-on:click=""></i> --> 
								({{ tbsPenjualan.harga_produk }} x {{ tbsPenjualan.jumlah_produk }}) 
								X 
								<!-- ({{ tbsPenjualan.subtotal }})  -->
								<!-- </span> -->
							</li>
						</div>
						<div v-else-if="loading == true" class="text-center">
							<li>Sedang Memuat Produk</li>
						</div>
						<div v-else class="list-group-item list-group-item-warning">
							Tidak Ada Produk
						</div>
						<vue-simple-spinner v-if="loading"></vue-simple-spinner>
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
								0
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
			produks: [],
			tbs_penjualans: [],
			produksData:{},
			inputTbsPenjualan: {
				satuan:'',
				produk_id:'',
				jumlah: '',
				harga:'',
			},
			search: '',
			url : window.location.origin + (window.location.pathname).replace("home", "penjualan"),
			urlTbs : window.location.origin + (window.location.pathname).replace("home", "proses-tbs-penjualan"),
			loading : true,

			setting_pelanggan:{
				placeholder: 'Pilih Pelanggan'
			},
		}
	},
	mounted() {
		var app = this;
		app.loading = true
		app.getPenjualans();
		app.getTbsPenjualan();
		app.selectPelanggans();
	},

	// computed: {
	// 	cartCount: function(){
	// 		return this.cart.length
	// 	},
		// totalPrice: function(){
		// 	return this.cart.reduce(function(prev, item){
		// 		return prev + (item.price * item.quantity)
		// 	}, 0)
		// },
		// amountDue: function() {
		// 	return this.totalPrice - this.form.totalPayment
		// }
	// },

	watch: {
	    // whenever question changes, this function will run
	    search: function (newQuestion) {
	    	this.getHasilPencarian()
	    }
	},
	methods: {
		getPenjualans(page) {
			var app = this;
			if (typeof page === 'undefined') {
				page = 1;
			}

			axios.get(app.url+'/view?page='+page)
			.then(function (resp) {
				app.loading = false;
				app.produks = resp.data.data;
				app.produksData = resp.data;
			})
			.catch(function (resp) {
				alert("Could not load produks");
				app.loading = false
			});
		},
		getTbsPenjualan() {
			var app = this;
			axios.get(app.url +'/tbs-penjualan')
			.then(function (resp) {
				app.tbs_penjualans = resp.data;
				// app.tbs_penjualans.total_item = 
				
			})	
			.catch(function () {
				alert("Could not load tbs penjualan");
			});

		},

		// storeItemToCart: function(item) {
		// 	var ids = _.map(this.cart, 'id')

		// 	if (!_.includes(ids, item.id)) {
		// 		item.quantity = 1
		// 		this.cart.push(item)
		// 	} else {
		// 		var index = _.findIndex(this.cart, item)
		// 		this.cart[index].quantity = this.cart[index].quantity + 1
		// 	}
		// },

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
				app.produks = resp.data.data;
				app.penjualansData = resp.data;
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
