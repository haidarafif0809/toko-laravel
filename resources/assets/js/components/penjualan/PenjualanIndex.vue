<style type="text/css">
.list-produk {

	padding-left: 4px;
	padding-right: 4px;

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
								<div class="thumbnail" @click="">
									<div class="caption">
										<h4>{{produk.nama_produk}}</h4>
										<p>Harga: {{produk.harga_jual}}</p>
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
				<div class="panel-heading">Produk</div>
				<ul class="list-group cart-item">
					<li class="list-group-item list-group-item-warning">Tidak ada item</li>
					<li class="list-group-item" track-by="id" v-on:click="">
						<span class="pull-right">
							<!-- <i class="glyphicon glyphicon-remove cart-item-action" v-on:click=""></i> -->
						</span>
						<!-- <button class="pull-right" v-on:click="deleteItemFromCart(cartItem)">-</button> -->
					</li>
				</ul>
				<div class="panel-footer">
					Total Item:
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
			produksData:{},
			search: '',
			url : window.location.origin + (window.location.pathname).replace("home", "penjualan"),
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
	// alert(pesan) {
	// 	this.$swal({
	// 		title: "Berhasil!",
	// 		text: pesan,
	// 		icon: "success",
	// 	});
	// }

}
}
</script>
