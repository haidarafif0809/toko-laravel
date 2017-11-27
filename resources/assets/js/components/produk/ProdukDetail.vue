<template>  
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<ol class="breadcrumb">
				<li><router-link :to="{name: 'indexProduk'}" >Produk</router-link></li>
				<li class="active" >Produk</li>    
			</ol>
			<div class="panel panel-default">
				<div class="panel-heading">Dashboard</div>

				<div class="panel-body">
					<div class="table table-responsive">
						<table class="table">
							<thead>
								<th>Kode</th>
								<th>Nama produk</th>
								<th>Harga jual</th>
								<th>Harga beli</th>
								<th>Satuan</th>
							</thead>
							<tbody>
								<tr>
									<td>{{ produk.kode_produk }}</td>
									<td>{{ produk.nama_produk }}</td>
									<td>{{ produk.harga_jual }}</td>
									<td>{{ produk.harga_beli }}</td>
									<td>{{ produk.satuan.nama_satuan }}</td>
								</tr>
							</tbody>
						</table>
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
			produk: [],
			produkId: null,
			url : window.location.origin + (window.location.pathname).replace("home", "produk"),
		} 
	},
	mounted(){
		var app = this;
		app.getData();
	},
	methods: {
		alert(pesan) {
			this.$swal({
				title: "Berhasil!",
				text: pesan,
				icon: "success",
			});
		},
		getData(){
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
		}

	}
}
</script>