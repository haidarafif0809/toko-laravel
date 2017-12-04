<template>
	<div class="container">
		<ul class="breadcrumb">
			<li><router-link :to="{name: 'indexDashboard'}">Home</router-link></li>
			<li><router-link :to="{name: 'indexPelanggan'}">Pelanggan</router-link></li>
			<li class="active">Edit Pelanggan</li>
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
								<label for="nama_pelanggan" class="col-md-2 control-label">Nama</label>
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
									<input class="form-control" required autocomplete="off" placeholder="Nomor Telepon" type="tel" v-model="pelanggan.nomor_telepon" name="nomor_telepon"  autofocus="">
									<span v-if="errors.nomor_telepon" class="label label-danger">{{ errors.nomor_telepon[0] }}</span>
								</div>
							</div>

							<div class="form-group">
								<label for="alamat" class="col-md-2 control-label">Alamat</label>
								<div class="col-md-4">
									<span v-if="errors.alamat" class="label label-danger">{{ errors.alamat[0] }}</span>
									<p style="white-space: pre-line;">{{ message }}</p>
									<textarea class="form-control" v-model="pelanggan.alamat" name="alamat" placeholder="Alamat"></textarea>
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
	mounted() {
		this.getPelanggan();
	},

	data: function () {
		return {
			errors: [],
			url : window.location.origin+(window.location.pathname).replace("home", "pelanggan"),
			pelanggan: {
				kode_pelanggan: '',
				nama_pelanggan: '',
				tanggal_lahir: '',
				nomor_telepon: '',
				alamat: ''
			},
			pelangganId: null,
			message: ''
		}
	},
	methods: {
		saveForm() {
			var app = this;
			var newPelanggan = app.pelanggan;
			axios.patch(app.url+'/' + app.pelangganId, newPelanggan)
			.then(function (resp) {
				app.message = 'Berhasil Merubah Pelanggan "'+app.pelanggan.nama_pelanggan+'"'
				app.alert(app.message);
				app.$router.replace('/pelanggan');

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
		getPelanggan(){

			let app = this;
			let id = app.$route.params.id;
			app.pelangganId = id;

			axios.get(app.url+'/' + id + '/edit')
			.then(function (resp) {
				app.pelanggan = resp.data;
			})
			.catch(function () {
				alert("Could not load your pelanggan")
			});
		}

	}

}
</script>