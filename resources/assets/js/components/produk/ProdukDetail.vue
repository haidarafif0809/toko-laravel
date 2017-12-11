<style scoped>
	.shadow {
		box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
	}
</style>
<template>  
	<div class="container">
		<ol class="breadcrumb">
			<li><router-link :to="{name: 'indexDashboard'}" >Dashboard</router-link></li>
			<li><router-link :to="{name: 'indexProduk'}" >Produk</router-link></li>
			<li class="active" >Detail</li>    
		</ol>
		<div class="panel panel-default">
			<div class="panel-heading">Detail Produk {{ produk.nama_produk }}</div>

			<div class="panel-body">
				<table class="table">
					<tbody>
						<tr>
							<td>
								Foto Produk:
							</td>
							<td width="40%">
								<img class="img-responsive thumbnail shadow" :src="url_foto_produk +'/' + produk.foto">
							</td>
						</tr>
						<tr>
							<td>
								Kode Produk:
							</td>
							<td>{{ produk.kode_produk }}</td>
						</tr>
						<tr>
							<td>Harga Jual:</td>
							<td>{{ produk.harga_jual }}</td>
						</tr>
						<tr>
							<td>Harga Beli:</td>
							<td>{{ produk.harga_beli }}</td>
						</tr>
						<tr>
							<td>Satuan:</td>
							<td>{{ satuan.nama_satuan }}</td>
						</tr>
						<tr>
							<td>Kategori Produk:</td>
							<td>{{ kategori_produk.nama_kategori_produk }}</td>
						</tr>
						<tr>
							<td>Status Jual:</td>
							<td>
								<span v-if="produk.status_jual == 1">Aktif</span>
								<span v-if="produk.status_jual == 0">Tidak Aktif</span>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</template>
<script>
export default {
	data: function () {
		return {
			produk: [],
			satuan: [],
			kategori_produk: [],
			produkId: null,
			url : window.location.origin + (window.location.pathname).replace("home", "produk"),
			url_foto_produk : window.location.origin+(window.location.pathname).replace("home", "foto_produk"),
		} 
	},
	mounted(){
		var app = this;
		app.getDataProduk();
		app.getDataSatuanDariProduk();
		app.getDataKategoriProdukDariProduk();
	},
	methods: {
		alert(pesan) {
			this.$swal({
				title: "Berhasil!",
				text: pesan,
				icon: "success",
			});
		},
		getDataProduk(){
			let app = this;
			let id = app.$route.params.id;
			app.produkId = id;

			axios.get(app.url+'/detail/' + id)
			.then(function (resp) {
				app.produk = resp.data;
			})
			.catch(function () {
				alert("Could not load your produk");
			});
		},
		getDataSatuanDariProduk() {
			let app = this;
			let id = app.$route.params.id;

			axios.get(app.url+'/detailSatuanDariProduk/' + id)
			.then(function (resp) {
				app.satuan = resp.data;
			})
			.catch(function () {
				alert("Could not load your satuan");
			});
		},
		getDataKategoriProdukDariProduk() {
			let app = this;
			let id = app.$route.params.id;

			axios.get(app.url+'/kategori_produks_id/' + id)
			.then(function (resp) {
				app.kategori_produk = resp.data;
			})
			.catch(function () {
				alert("Could not load your kategori produk");
			});			
		}

	}
}
</script>