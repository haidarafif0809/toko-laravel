<style scoped>
.shadow {
	box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
.detail_nama_modifier + .detail_nama_modifier:before {
	content: ", ";
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
				<div class="col-md-5">
					<div class="row">
						<img v-if="produk.foto == null || produk.foto == ''" class="img-responsive thumbnail shadow" src="https://www.glasgow.gov.uk/georgesquarewebcam/camera-unavailable.gif">
						<img v-else class="img-responsive thumbnail shadow" :src="url_foto_produk +'/' + produk.foto">

					</div>
				</div>
				<div class="col-md-7">
					<div class="row">
						<table class="table" style="margin-top: 5px;">
							<tbody>
								<tr>
									<td>
										<label>Harga Jual:</label>
									</td>
									<td>{{  "Rp" }}{{ new Intl.NumberFormat().format(produk.harga_jual) }}</td>
								</tr>
								<tr>
									<td>
										<label>Kategori Produk:</label>
									</td>
									<td>{{ kategori_produk.nama_kategori_produk }}</td>
								</tr>
								<tr>
									<td>
										<label>Status Jual:</label>
									</td>
									<td>
										<span v-if="produk.bisa_dijual == 1">Aktif</span>
										<span v-if="produk.bisa_dijual == 0">Tidak Aktif</span>
									</td>
								</tr>
								<tr>
									<td>
										<label>Satuan:</label>
									</td>
									<td>
										<span v-if="produk.satuan == 1">Pcs</span>
										<span v-else-if="produk.satuan == 2">Porsi</span>
										<span v-else-if="produk.satuan == 3">Pack</span>
										<span v-else>{{ produk.satuan }}</span>
									</td>
								</tr>
								<tr>
									<td>
										<label>Tambahan:</label>
									</td>
									<td>
										<span v-for="id,index in produk.produk_modifier_id" class="detail_nama_modifier">
											<span v-if="produk_modifier[id] == null">Tidak ada tambahan</span>
											<span v-else>{{ produk_modifier[id] }}</span>
										</span>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<div class="col-md-6"></div>
			</div>
		</div>
	</div>
</template>
<script>
export default {
	data: function () {
		return {
			produk: [],
			kategori_produk: [],
			produk_modifier: [],
			produkId: null,
			url : window.location.origin + (window.location.pathname).replace("home", "produk"),
			url_foto_produk : window.location.origin+(window.location.pathname).replace("home", "foto_produk"),
		} 
	},
	mounted(){
		var app = this;
		app.getDataProduk();
		app.getDataKategoriProdukDariProduk();
		app.getProdukModifier();
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
				app.produk.produk_modifier_id = resp.data.produk_modifier_id.split(',');
				console.log(app.produk.produk_modifier_id)
			})
			.catch(function () {
				alert("Could not load your produk");
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
		},
		getProdukModifier() {
			let app = this;
			let id = app.$route.params.id;

			axios.get(app.url+'/produk-modifier/')
			.then(function (resp) {
				app.produk_modifier = resp.data;
				console.log(resp.data)
			})
			.catch(function () {
				alert("Could not load your kategori produk");
			});			
		}

	}
}
</script>