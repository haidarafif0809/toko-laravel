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
								<label class="col-md-4">Kolom bertanda <font size="5px" color="red">*</font> wajib diisi.</label>
							</div>

							<div class="form-group">
								<label for="kode_pelanggan" class="col-md-3 control-label">Kode<font size="5px" color="red">*</font></label>
								<div class="col-md-4">
									<input class="form-control" required autocomplete="off" placeholder="Kode Pelanggan" type="text" v-model="pelanggan.kode_pelanggan" name="kode_pelanggan"  autofocus="">
									<span v-if="errors.kode_pelanggan" class="label label-danger">{{ errors.kode_pelanggan[0] }}</span>
								</div>
							</div>

							<div class="form-group">
								<label for="nama_pelanggan" class="col-md-3 control-label">Nama<font size="5px" color="red">*</font></label>
								<div class="col-md-4">
									<input class="form-control" required autocomplete="off" placeholder="Nama Pelanggan" type="text" v-model="pelanggan.nama_pelanggan" name="nama_pelanggan"  autofocus="">
									<span v-if="errors.nama_pelanggan" class="label label-danger">{{ errors.nama_pelanggan[0] }}</span>
								</div>
							</div>

							<div class="form-group">
								<label for="jenis_kelamin'" class="col-md-3 control-label">Jenis Kelamin <font size="5px" color="red">*</font></label>
								<div class="col-md-4">
									<selectize-component v-model="pelanggan.jenis_kelamin" :settings="settings"> 
										<option value="1"  >laki-laki</option>
										<option value="2"  >perempuan</option>
									</selectize-component>
									<span v-if="errors.jenis_kelamin" class="label label-danger">{{ errors.jenis_kelamin[0] }}</span>
								</div>
							</div>


							<div class="form-group">
								<label for="tanggal_lahir" class="col-md-3 control-label">Tanggal Lahir</label>
								<div class="col-md-4">
									<input class="form-control" autocomplete="off" placeholder="YYYY-MM-DD" type="date" v-model="pelanggan.tanggal_lahir" name="tanggal_lahir"  autofocus="">
									<span v-if="errors.tanggal_lahir" class="label label-danger">{{ errors.tanggal_lahir[0] }}</span>
								</div>
							</div>

							<div class="form-group">
								<label for="nomor_telepon" class="col-md-3 control-label">Nomor Telepon <font size="5px" color="red">*</font></label>
								<div class="col-md-4">
									<input class="form-control" required autocomplete="off" placeholder="Nomor Telepon" type="number" v-model.phone="pelanggan.nomor_telepon" name="nomor_telepon"  autofocus="">
									<span v-if="errors.nomor_telepon" class="label label-danger">{{ errors.nomor_telepon[0] }}</span>
								</div>
							</div>

							<div class="form-group">
								<label for="email" class="col-md-3 control-label">Email</label>
								<div class="col-md-4">
									<input class="form-control" autocomplete="off" placeholder="Email" type="email" v-model="pelanggan.email" name="email" autofocus="">
									<span v-if="errors.email" id="email_error" class="label label-danger">{{ errors.email[0] }}</span>
								</div>
							</div>

							<div class="form-group">
								<label for="alamat" class="col-md-3 control-label">Alamat</label>
								<div class="col-md-4">
									<input class="form-control" autocomplete="off" placeholder="Alamat" type="text" v-model="pelanggan.alamat" name="alamat" autofocus="">

									<span v-if="errors.alamat" class="label label-danger">{{ errors.alamat[0] }}</span>
								</div>
							</div>

							<div class="form-group">
								<label for="kota" class="col-md-3 control-label">Kota</label>
								<div class="col-md-4">
									<input class="form-control" autocomplete="off" placeholder="Kota" type="text" v-model="pelanggan.kota" name="kota" autofocus="">
									<span v-if="errors.kota" id="email_error" class="label label-danger">{{ errors.kota[0] }}</span>
								</div>
							</div>

							<div class="form-group">
								<label for="kode_pos" class="col-md-3 control-label">Kode Pos</label>
								<div class="col-md-4">
									<input class="form-control" autocomplete="off" placeholder="Kode Pos" type="number" v-model="pelanggan.kode_pos" name="kode_pos" autofocus="">
									<span v-if="errors.kode_pos" id="email_error" class="label label-danger">{{ errors.kode_pos[0] }}</span>
								</div>
							</div>

							<div class="form-group">
								<label for="email" class="col-md-3 control-label">Catatan</label>
								<div class="col-md-4">
									<textarea class="form-control" autocomplete="off" placeholder="Catatan" v-model="pelanggan.catatan" name="catatan"  autofocus=""></textarea>
									<span v-if="errors.email" id="email_error" class="label label-danger">{{ errors.email[0] }}</span>
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
				jenis_kelamin: '',
				tanggal_lahir: '',
				nomor_telepon: '',
				email: '',
				alamat: '',
				kota: '',
				kode_pos: '',
				catatan: '',
			},
			pelangganId: null,
			message: '',
			settings: {
				placeholder: 'Pilih Jenis Kelamin'
			} 
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