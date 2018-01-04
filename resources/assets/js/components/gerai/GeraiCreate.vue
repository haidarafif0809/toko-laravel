<style scoped>
.row{
	border-color:#FDA698;

}
#icon:hover{
	background-color: #00BCD4;
}
.box{
	width: 200px;
	height:40px;
	background-color: #FCF8E3;
	text-align: center;
	border:1px solid #ffafaf;
}
#border{
	border:1px solid #D3E0E9;
	

}
#btnSimpanGerai{
	background-color: #FFE24F;
}

</style>
<template>
	<div class="container-fluid">
		<ul class="breadcrumb">
			<li><router-link :to="{name: 'indexDashboard'}">Home</router-link></li>
			<li><router-link :to="{name: 'indexGerai'}">Gerai</router-link></li>
			<li class="active">Tambah Gerai</li>
		</ul>

		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-7">
				<div class="panel panel-default">

					<div class="panel-heading"></div>
					<div class="container-fluid">
						<div class="row-fluid">
							<div class="area-top clearfix">
								<div class="pull-left header">
									<h4 class="uppercase"><i class="fa fa-map-marker fa-1x"></i>
									Tambah Gerai</h4>
								</div>
							</div>
						</div>
					</div>

					<div class="panel-body" id="border">
						<div class="box">
							<label>Kolom bertanda <font size="5px" color="red">*</font> wajib diisi.</label>
						</div>
						<form v-on:submit.prevent="saveForm()" class="form-horizontal"> 


							<div class="form-group">

								<div class="col-md-7">
									<label for="nama_gerai">
										Nama Gerai <font size="5px" color="red">*</font>
									</label>
									<input class="form-control" required autocomplete="off" placeholder="Nama Gerai" type="text" v-model="gerai.nama_gerai" name="nama_gerai"  autofocus="">
									<span v-if="errors.nama_gerai" id="nama_gerai_error" class="label label-danger">
										{{ errors.nama_gerai[0] }}
									</span>
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-7">
									<label for="alamat_gerai">
										Alamat Gerai
									</label>
									<input class="form-control" autocomplete="off" placeholder="Alamat Gerai" type="text" v-model="gerai.alamat_gerai" name="alamat_gerai"  autofocus="">
									<span v-if="errors.alamat_gerai" id="alamat_gerai_error" class="label label-danger">
										{{ errors.alamat_gerai[0] }}
									</span>
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-7">
									<label for="kota">
										Kota
									</label>
									<input class="form-control" autocomplete="off" placeholder="Kota" type="text" v-model="gerai.kota" name="kota"  autofocus="">
									<span v-if="errors.kota" id="kota_error" class="label label-danger">
										{{ errors.kota[0] }}
									</span>
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-7">
									<label for="no_telepon_a">
										Nomor Telepon Gerai 1
									</label>
									<input class="form-control" autocomplete="off" placeholder="Nomor Telepon 1" type="number" v-model="gerai.no_telepon_a" name="no_telepon_a"  autofocus="">
									<span v-if="errors.no_telepon_a" id="no_telepon_a_error" class="label label-danger">
										{{ errors.no_telepon_a[0] }}
									</span>
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-7">
									<label for="no_telepon_b">
										Nomor Telepon Gerai 2
									</label>
									<input class="form-control" autocomplete="off" placeholder="Nomor Telepon 2" type="number" v-model="gerai.no_telepon_b" name="no_telepon_b"  autofocus="">
									<span v-if="errors.no_telepon_b" id="no_telepon_b_error" class="label label-danger">
										{{ errors.no_telepon_b[0] }}
									</span>
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-7">
									<label for="notes">
										Notes
										(Akan muncul di bagian bawah struk)
									</label>
									<input class="form-control" autocomplete="off" placeholder="Notes" type="text" v-model="gerai.notes" name="notes"  autofocus="">
									<span v-if="errors.notes" id="notes_error" class="label label-danger">
										{{ errors.notes[0] }}
									</span>
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-7">
									<label for="nama_pajak">
										Nama Pajak
										(Misal: Pajak, Service Charge)
									</label>
									<input class="form-control" autocomplete="off" placeholder="Nama Pajak" type="text" v-model="gerai.nama_pajak" name="nama_pajak"  autofocus="">
									<span v-if="errors.nama_pajak" id="nama_pajak_error" class="label label-danger">
										{{ errors.nama_pajak[0] }}
									</span>
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-7">
									<label for="rasio">
										Rasio
									</label>
									<div class="input-group">
										<input class="form-control" autocomplete="off" placeholder="Rasio" type="text" v-model="gerai.rasio" name="rasio"  autofocus="" maxlength="2" value="0" id="rasio">
										<div class="input-group-addon">
											%
										</div>
									</div>
									<span v-if="errors.rasio" id="rasio_error" class="label label-danger">
										{{ errors.rasio[0] }}
									</span>
								</div>
							</div>	

							<div class="form-group">
								<div class="col-md-7">
									<label for="meja">
										Meja
									</label>
									Modul Yang Diaktifkan di Lokasi ini : <br>
									<input class="form-check" autocomplete="off" placeholder="Meja" type="checkbox" v-model="gerai.meja" name="meja"  autofocus="">
									<span v-if="errors.meja" id="meja_error" class="label label-danger">
										{{ errors.meja[0] }}
									</span>
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-5">
									<button class="btn btn-default" id="btnSimpanGerai" type="submit"> 
										Buat
									</button>
									<router-link :to="{name: 'indexGerai'}" class="btn btn-default">Batal</router-link>
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
			url : window.location.origin+(window.location.pathname).replace("home", "gerai"),
			gerai: {
				nama_gerai: '',
				alamat_gerai: '',
				kota: '',
				no_telepon_a: '',
				no_telepon_b: '',
				notes: '',
				nama_pajak: '',
				rasio: '',
				meja: '',
			},
			message : ''
		}

	},
	methods: {
		saveForm() {
			var app = this;
			var newgerai = app.gerai;
			axios.post(app.url, newgerai)
			.then(function (resp) {
				app.message = 'Sukses : Berhasil Menambah Gerai '+ app.gerai.nama_gerai;
				app.alert(app.message);
				app.gerai.nama_gerai = ''
				app.gerai.alamat_gerai = ''
				app.gerai.kota = ''
				app.gerai.no_telepon_a = ''
				app.gerai.no_telepon_b = ''
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

		// saveForm() {
		// 	var app = this;
		// 	var newgerai = app.gerai;
		// 	axios.post(app.url, newgerai)
		// 	.then(function (resp) {
		// 		app.alert();
		// 		app.$router.replace('/gerai');

		// 	})
		// 	.catch(function (resp) {
		// 		app.errors = resp.response.data.errors;
		// 	});
		// },
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
