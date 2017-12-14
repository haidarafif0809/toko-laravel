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
					<div class="panel-heading">List Produk</div>

					<div class="panel-body">
						<div class="row">
							<div class="col-md-12">
								<input type="text" class="form-control" name="search" placeholder="Pencarian"  v-model="search" >
							</div>
						</div>	
						<br>
						<div class="row">
							<div v-for="produk , index in produks" class="col-md-6 list-produk">
								<div class="thumbnail" @click="">
									<div class="caption">
										<h4>{{produk.nama_produk}}</h4>
										<p>{{produk.harga_jual}}</p>
									</div>
								</div>
							</div>
						</div>
					</div>
					<vue-simple-spinner v-if="loading"></vue-simple-spinner>

					<div align="right">
						<pagination :data="produksData" v-on:pagination-change-page="getPenjualans" :limit="3"></pagination>
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
			produks: [],
			produksData:{},
			pencarian: "",
			url : window.location.origin + (window.location.pathname).replace("home", "penjualan"),
			loading : true
		}
	},
	watch: {
    // whenever question changes, this function will run
    pencarian: function (newQuestion) {
    	this.searchData()
    }
},
mounted() {
	var app = this;
	app.getPenjualans();
},
methods: {
	getPenjualans(page) {
		var app = this;
		if (typeof page === 'undefined') {
			page = 1;
		}

		axios.get(app.url+'/view?page='+page)
		.then(function (resp) {
			app.produks = resp.data.data;
			app.produksData = resp.data;
			app.loading = false;
		})
		.catch(function (resp) {
			alert("Could not load produks");
			app.loading = false
		});
	},
	// searchData(page) {
	// 	var app = this;
	// 	app.loading = true;
	// 	if (typeof page === 'undefined') {
	// 		page = 1;
	// 	}

		// axios.get(app.url+'/cari?pencarian='+app.pencarian+'&page='+page)
		// .then(function (resp) {
		// 	app.produks = resp.data.data;
		// 	app.penjualansData = resp.data;
		// 	app.loading = false    
		// })
		// .catch(function (resp) {
		// 	alert("Tidak dapat memuat produk..");
		// 	app.loading = false;
		// })
	// },
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
