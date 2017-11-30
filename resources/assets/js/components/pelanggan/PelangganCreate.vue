<template>
	<div class="container">
		<ul class="breadcrumb">
			<li><router-link :to="{name: 'indexDashboard'}">Home</router-link></li>
			<li><router-link :to="{name: 'indexPelanggan'}">Pelanggan</router-link></li>
			<li class="active">Tambah Pelanggan</li>
		</ul>

		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title"> Pelanggan </h4>
					</div>
					<div class="panel-body">
						<form v-on:submit.prevent="saveForm()" class="form-horizontal">
							<div class="form-group">
								<label for="kode_pelanggan" class="col-md-2 control-label">Kode Pelanggan</label>
								<div class="col-md-4">
									<input class="form-control" required autocomplete="off" placeholder="Kode Pelanggan" type="text" v-model="pelanggan.kode_pelanggan" name="kode_pelanggan"  autofocus="">
									<span v-if="errors.kode_pelanggan" class="label label-danger">{{ errors.kode_pelanggan[0] }}</span>
								</div>
							</div>

							<div class="form-group">
								<label for="nama_pelanggan" class="col-md-2 control-label">Nama Pelanggan</label>
								<div class="col-md-4">
									<input class="form-control" required autocomplete="off" placeholder="Nama Pelanggan" type="text" v-model="pelanggan.nama_pelanggan" name="nama_pelanggan"  autofocus="">
									<span v-if="errors.nama_pelanggan" class="label label-danger">{{ errors.nama_pelanggan[0] }}</span>
								</div>
							</div>


							<div class="form-group">
								<label for="tanggal_lahir" class="col-md-2 control-label">Tanggal Lahir</label>
								<div class="col-md-4">
									<input class="form-control" required autocomplete="off" placeholder="YYYY-MM-DD" type="date" v-model="pelanggan.tanggal_lahir" name="tanggal_lahir"  autofocus="">
									<span v-if="errors.tanggal_lahir" class="label label-danger">{{ errors.tanggal_lahir[0] }}</span>
								</div>
							</div>

							<div class="form-group">
								<label for="nomor_telepon" class="col-md-2 control-label">Nomor Telepon</label>
								<div class="col-md-4">
									<input class="form-control" required autocomplete="off" placeholder="Nomor Telepon" type="number" v-model="pelanggan.nomor_telepon" name="nomor_telepon"  autofocus="">
									<span v-if="errors.nomor_telepon" class="label label-danger">{{ errors.nomor_telepon[0] }}</span>
								</div>
							</div>

							<div class="form-group">
								<label for="alamat" class="col-md-2 control-label">Alamat</label>
								<div class="col-md-4">
									<input class="form-control" required autocomplete="off" placeholder="Alamat" type="text" v-model="pelanggan.alamat" name="alamat"  autofocus="">
									<span v-if="errors.alamat" class="label label-danger">{{ errors.alamat[0] }}</span>
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-4 col-md-offset-2">
									<button class="btn btn-primary" id="btnSimpanPelanggan" type="submit">Submit</button>
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
			url : window.location.origin+(window.location.pathname).replace("home", "pelanggan"),
			pelanggan: {
				kode_pelanggan: '',
				nama_pelanggan: '',
				tanggal_lahir: '',
				nomor_telepon: '',
				alamat: '',
			},
		}
	},
	methods: {
		saveForm() {
			var app = this;
			var newPelanggan = app.pelanggan;
			axios.post(app.url, newPelanggan)
			.then(function (resp) {
				app.alert();
				app.$router.replace('/pelanggan');

			})
			.catch(function (resp) {
				app.errors = resp.response.data.errors;
			});
		},
		alert() {
			this.$swal({
				title: "Berhasil!",
				text: "Berhasil Menambahkan Pelanggan",
				icon: "success",
			});
		}

	}
}
</script>