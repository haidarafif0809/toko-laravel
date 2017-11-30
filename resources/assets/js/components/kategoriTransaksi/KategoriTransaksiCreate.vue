<template>
	<div class="container">

		<ul class="breadcrumb">
			<li><router-link :to="{name: 'indexDashboard'}">Home</router-link></li>
			<li><router-link :to="{name: 'indexKategoriTransaksi'}">Kategori Transaksi</router-link></li>
			<li class="active">Tambah Kategori Transaksi</li>
		</ul>

		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title"> Kategori Transaksi </h4>
					</div>
					<div class="panel-body">
						<form v-on:submit.prevent="saveForm()" class="form-horizontal">
							<div class="form-group">
								<label for="nama_kategori_transaksi" class="col-md-2 control-label">Nama Kategori Transaksi</label>
								<div class="col-md-4">
									<input class="form-control" required autocomplete="off" placeholder="Nama Kategori Transaksi" type="text" v-model="kategoriTransaksi.nama_kategori_transaksi" name="nama_kategori_transaksi"  autofocus="">
									<span v-if="errors.nama_kategori_transaksi" class="label label-danger">{{ errors.nama_kategori_transaksi[0] }}</span>

								</div>


							</div>
							<div class="form-group">
								<div class="col-md-4 col-md-offset-2">
									<button class="btn btn-primary" id="btnSimpanKategoriTransaksi" type="submit">Submit</button>
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
			url : window.location.origin+(window.location.pathname).replace("home", "kategoriTransaksi"),
			kategoriTransaksi: {
				nama_kategori_transaksi: ''
			},
		}
	},
	methods: {
		saveForm() {
			var app = this;
			var newKategoriTransaksi = app.kategoriTransaksi;
			axios.post(app.url, newKategoriTransaksi)
			.then(function (resp) {
				app.alert();
				app.$router.replace('/kategoriTransaksi');

			})
			.catch(function (resp) {
				app.errors = resp.response.data.errors;
			});
		},
		alert() {
			this.$swal({
				title: "Berhasil!",
				text: "Berhasil Menambahkan Kategori Transaksi",
				icon: "success",
			});
		}

	}
}
</script>