<template>
	<div class="container">
		<ul class="breadcrumb">
			<li><router-link :to="{name: 'indexDashboard'}">Home</router-link></li>
			<li><router-link :to="{name: 'indexGerai'}">Gerai</router-link></li>
			<li class="active">Edit Gerai</li>
		</ul>

		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-9">
				<div class="panel panel-default">
					<div class="panel-heading">
						<p class="panel-title">Edit Gerai</p>
					</div>
					<div class="panel-body">
						<form v-on:submit.prevent="saveForm()" class="form-horizontal">
							<div class="form-group">
								<label for="nama_gerai" class="col-md-2 control-label">
									Nama Gerai
								</label>
								<div class="col-md-5">
									<input class="form-control" required autocomplete="off" placeholder="Nama Gerai" type="text" v-model="gerai.nama_gerai" name="nama_gerai"  autofocus="">
									<span v-if="errors.nama_gerai" id="nama_gerai_error" class="label label-danger">
										{{ errors.nama_gerai[0] }}
									</span>
								</div>
							</div>

							<div class="form-group">
								<label for="alamat_gerai" class="col-md-2 control-label">
									Alamat Gerai
								</label>
								<div class="col-md-5">
									<input class="form-control" required autocomplete="off" placeholder="Alamat Gerai" type="text" v-model="gerai.alamat_gerai" name="alamat_gerai"  autofocus="">
									<span v-if="errors.alamat_gerai" id="alamat_gerai_error" class="label label-danger">
										{{ errors.alamat_gerai[0] }}
									</span>
								</div>
							</div>

							<div class="form-group">
								<label for="kota" class="col-md-2 control-label">
									Kota
								</label>
								<div class="col-md-5">
									<input class="form-control" required autocomplete="off" placeholder="Kota" type="text" v-model="gerai.kota" name="kota"  autofocus="">
									<span v-if="errors.kota" id="kota_error" class="label label-danger">
										{{ errors.kota[0] }}
									</span>
								</div>
							</div>

							<div class="form-group">
								<label for="no_telepon_1" class="col-md-2 control-label">
									No Telepon Gerai 1
								</label>
								<div class="col-md-5">
									<input class="form-control" required autocomplete="off" placeholder="Nomor Telepon 1" type="number" v-model="gerai.no_telepon_1" name="no_telepon_1"  autofocus="">
									<span v-if="errors.no_telepon_1" id="no_telepon_1_error" class="label label-danger">
										{{ errors.no_telepon_1[0] }}
									</span>
								</div>
							</div>

							<div class="form-group">
								<label for="no_telepon_2" class="col-md-2 control-label">
									No Telepon Gerai 2
								</label>
								<div class="col-md-5">
									<input class="form-control" required autocomplete="off" placeholder="Nomor Telepon 2" type="number" v-model="gerai.no_telepon_2" name="no_telepon_2"  autofocus="">
									<span v-if="errors.no_telepon_2" id="no_telepon_2_error" class="label label-danger">
										{{ errors.no_telepon_2[0] }}
									</span>
								</div>
							</div>

							<div class="form-group">
								<label for="notes" class="col-md-2 control-label">
									Notes
								</label>
								<div class="col-md-5">
									<input class="form-control" required autocomplete="off" placeholder="Notes" type="text" v-model="gerai.notes" name="notes"  autofocus="">
									<span v-if="errors.notes" id="notes_error" class="label label-danger">
										{{ errors.notes[0] }}
									</span>
								</div>
							</div>

							<div class="form-group">
								<label for="nama_pajak" class="col-md-2 control-label">
									Nama Pajak
								</label>
								<div class="col-md-5">
									<input class="form-control" required autocomplete="off" placeholder="Nama Pajak" type="text" v-model="gerai.nama_pajak" name="nama_pajak"  autofocus="">
									<span v-if="errors.nama_pajak" id="nama_pajak_error" class="label label-danger">
										{{ errors.nama_pajak[0] }}
									</span>
								</div>
							</div>

							<div class="form-group">
								<label for="rasio" class="col-md-2 control-label">
									Rasio
								</label>
								<div class="col-md-5">
									<input class="form-control" required autocomplete="off" placeholder="%" type="text" v-model="gerai.rasio" name="rasio"  autofocus="">
									<span v-if="errors.rasio" id="rasio_error" class="label label-danger">
										{{ errors.rasio[0] }}
									</span>
								</div>
							</div>	

							<div class="form-group">
								<label for="meja" class="col-md-2 control-label">
									Meja
								</label>
								<div class="col-md-5">
									<input class="form-check" required autocomplete="off" placeholder="Meja" type="checkbox" v-model="gerai.meja" name="meja"  autofocus="">
									<span v-if="errors.meja" id="meja_error" class="label label-danger">
										{{ errors.meja[0] }}
									</span>
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-4 col-md-offset-2">
									<button class="btn btn-primary" id="btnSimpangerai" type="submit">
										Simpan
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
			geraiId: null,
			url : window.location.origin+(window.location.pathname).replace("home","gerai"),
			gerai: {
				nama_gerai: '',
				alamat_gerai: '',
				kota: '',
				no_telepon_1: '',
				no_telepon_2: '',
				notes: '',
				nama_pajak: '',
				rasio: '',
				meja: '',
			},
			message : '',
		}
	},
	mounted(){
		this.getData();
	},
	methods: {
		saveForm() {
			var app = this;
			var newGerai = app.gerai;
			axios.patch(app.url+'/' + app.geraiId, newGerai)
			.then(function (resp) {
				app.message = 'Sukses : Berhasil Mengedit gerai '+ app.gerai.nama_gerai;
				app.alert(app.message);
				app.gerai.nama_gerai = ''
				app.gerai.alamat_gerai = ''
				app.gerai.kota = ''
				app.gerai.no_telepon_1 = ''
				app.gerai.no_telepon_2 = ''
				app.gerai.notes = ''
				app.gerai.nama_pajak = ''
				app.gerai.rasio = ''
				app.gerai.meja = ''
				app.errors = '';
				app.$router.replace('/gerai');

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
		},
		getData(){
			let app = this;
			let id = app.$route.params.id;
			app.geraiId = id;

			axios.get(app.url+'/' + id +'/edit')
			.then(function (resp) {
				app.gerai = resp.data;
			})
			.catch(function () {
				alert("Could not load your gerai")
			});
		}

	}
}
</script>