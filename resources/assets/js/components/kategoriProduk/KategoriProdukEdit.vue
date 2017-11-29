<template>
	<div class="container">
		<div class="row">
			<ul class="breadcrumb">
				<li><router-link :to="{name: 'indexDashboard'}">Home</router-link></li>
				<li><router-link :to="{name: 'indexKategoriProduk'}">Kategori Produk</router-link></li>
				<li class="active">Tambah Kategori Produk</li>
			</ul>
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title"> Kategori Produk </h4>
					</div>
					<form v-on:submit.prevent="saveForm()" class="form-horizontal">
						<div class="form-group">
							<label for="nama_produk" class="col-md-2 control-label">Nama Kategori Produk</label>
							<div class="col-md-4">
								<input class="form-control" required autocomplete="off" placeholder="Nama Kategori Produk" type="nama_produk" v-model="kategoriProduk.nama_produk" name="nama_produk"  autofocus="">
								<span v-if="errors.nama_produk" class="label label-danger">{{ errors.nama_produk[0] }}</span>

							</div>


						</div>
						<div class="form-group">
							<div class="col-md-4 col-md-offset-2">
								<button class="btn btn-primary" id="btnSimpanKategoriProduk" type="submit">Submit</button>
							</div>
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
	mounted() {
		this.getItem();
	},

	data: function () {
		return {
			errors: [],
			url : window.location.origin+(window.location.pathname).replace("home", "kategoriProduk"),
			kategoriProduk: {
				nama_produk: ''
			},
			kategoriProdukId: null,
			message: ''
		}
	},
	methods: {
		saveForm() {
			var app = this;
			var newKategoriProduk = app.kategoriProduk;
			axios.patch(app.url+'/' + app.kategoriProdukId, newKategoriProduk)
			.then(function (resp) {
				app.message = 'Berhasil Merubah kategori Produk "'+app.kategoriProduk.nama_produk+'"'
				app.alert(app.message);
				app.$router.replace('/kategoriProduk');

			})
			.catch(function (resp) {
				app.errors = resp.response.data.errors;
			});
		},
		alert(pesan) {
			this.$swal({
				title: "Berhasil!",
				text: pesan,
				icon: "success",
			});
		},
		getItem(){

			let app = this;
			let id = app.$route.params.id;
			app.kategoriProdukId = id;

			axios.get(app.url+'/' + id + '/edit')
			.then(function (resp) {
				app.kategoriProduk = resp.data;
			})
			.catch(function () {
				alert("Could not load your kategori Produk")
			});
		}

	}

}
</script>