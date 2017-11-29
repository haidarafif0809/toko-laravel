<template>
	<div class="container">
		<ul class="breadcrumb">
			<li><router-link :to="{name: 'indexDashboard'}">Home</router-link></li>
			<li><router-link :to="{name: 'indexKategoriProduk'}">Kategori Produk</router-link></li>
			<li class="active">Tambah Kategori Produk</li>
		</ul>
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<div class="panel panel-default">
					<div class="panel-heading">
						<p class="panel-title">Tambah Kategori Produk</p>
					</div>
					<div class="panel-body">
						<form v-on:submit.prevent="saveForm()" class="form-horizontal"> 
							<div class="form-group">
								<label for="nama_produk" class="col-md-2 control-label">
									Nama Produk
								</label>
								<div class="col-md-4">
									<input class="form-control" required autocomplete="off" placeholder="Nama Produk" type="text" v-model="kategoriProduk.nama_produk" name="nama_produk"  autofocus="">
									<span v-if="errors.nama_produk" id="name_error" class="label label-danger">
										{{ errors.nama_produk[0] }}
									</span>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-4 col-md-offset-2">
									<button class="btn btn-primary" id="btnSimpanKategoriProduk" type="submit"> 
										Tambah
									</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="col-md-2"></div>
		</div>
	</div>

</template>

<script>
export default {
	data: function () {
		return {
			errors: [],
			url : window.location.origin+(window.location.pathname).replace("home", "kategoriProduk"),
			kategoriProduk: {
				nama_produk: ''
			},
			message : ''
		}

	},
	methods: {
		saveForm() {
			var app = this;
			var newKategoriProduk = app.kategoriProduk;
			axios.post(app.url, newKategoriProduk)
			.then(function (resp) {
				app.message = 'Sukses : Berhasil Menambah Kategori Produk '+ app.kategoriProduk.nama_produk;
				app.alert(app.message);
				app.kategoriProduk.nama_produk = ''
				app.errors = '';
				app.$router.replace('/kategoriProduk');
			})
			.catch(function (resp) {
				app.success = false;
				app.errors = resp.response.data.errors;
			});
		},
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

