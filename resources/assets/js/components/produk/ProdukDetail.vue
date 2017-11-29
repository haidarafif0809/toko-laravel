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
				<div class="table-responsive">
					<table class="table">
						<thead>
							<th>Kode</th>
							<th>Harga jual</th>
							<th>Harga beli</th>
							<th>Satuan</th>
						</thead>
						<tbody>
							<tr>
								<td>{{ produk.kode_produk }}</td>
								<td>{{ produk.harga_jual }}</td>
								<td>{{ produk.harga_beli }}</td>
								<td>{{ satuan.nama_satuan }}</td>
							</tr>
						</tbody>
					</table>
				</div>
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
			produkId: null,
			url : window.location.origin + (window.location.pathname).replace("home", "produk"),
		} 
	},
	mounted(){
		var app = this;
		app.getDataProduk();
		app.getDataSatuanDariProduk();
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
		getDataSatuanDariProduk(){
			let app = this;
			let id = app.$route.params.id;

			axios.get(app.url+'/detailSatuanDariProduk/' + id)
			.then(function (resp) {
				app.satuan = resp.data;
			})
			.catch(function () {
				alert("Could not load your produk");
			});
		}

	}
}
</script>