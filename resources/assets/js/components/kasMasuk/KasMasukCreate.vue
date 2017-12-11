<template>
	<div class="container">
		<ul class="breadcrumb">
			<li><router-link :to="{name: 'indexDashboard'}">Home</router-link></li>
			<li><router-link :to="{name: 'indexKasMasuk'}">Kas Masuk/Keluar</router-link></li>
			<li class="active">Buat Kas Masuk/keluar</li>
		</ul>
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<div class="panel panel-default">
					<div class="panel-heading">
						<p class="panel-title">Buat Kas Masuk/keluar</p>
					</div>
					<div class="panel-body">
						<form v-on:submit.prevent="saveForm()" class="form-horizontal"> 

							<div class="form-group">
								<label for="type" class="col-md-2 control-label">Type Kas</label>
								<div class="col-md-4">
									<input type="radio" name="type" v-model="kasMasuk.type" value="1"> kas masuk
									<input type="radio" name="type" v-model="kasMasuk.type" value="2"> kas keluar
									<span v-if="errors.type" class="label label-danger">{{ errors.type[0] }}</span>

								</div>
							</div> 

							<div class="form-group">
								<label for="jumlah" class="col-md-2 control-label">
									Jumlah
								</label>
								<div class="col-md-4">
									<input class="form-control" required autocomplete="off" placeholder="Jumlah" type="number" v-model="kasMasuk.jumlah" name="jumlah"  autofocus="">
									<span v-if="errors.jumlah" id="name_error" class="label label-danger">
										{{ errors.jumlah[0] }}
									</span>
								</div>
							</div>
							<div class="form-group">
								<label for="keterangan" class="col-md-2 control-label">Keterangan</label>
								<div class="col-md-4">
									<textarea class="form-control" required autocomplete="off" placeholder="Keterangan" v-model="kasMasuk.keterangan" name="keterangan"  autofocus=""></textarea>
									<span v-if="errors.keterangan" class="label label-danger">{{ errors.keterangan[0] }}</span>
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
			kas: [],
			kategoriTransaksis: [],
			url : window.location.origin+(window.location.pathname).replace("home", "kasMasuk"),
			kasMasuk: {
				type: '',
				jumlah: '',
				keterangan: ''
			},
			message : '',
			settings: {
				placeholder: 'Kas'
			},
			setting: {
				placeholder: 'Kategori'
			}

		}

	},
	mounted() {
		var app = this;
		app.selected();
		app.selected2();
	},
	methods: {
		saveForm() {
			var app = this;
			var newKategoriProduk = app.kasMasuk;
			axios.post(app.url, newKategoriProduk)
			.then(function (resp) {
				app.message = 'Sukses : Berhasil Menambah Kas Masuk '+ app.kasMasuk.type;
				app.alert(app.message);
				app.kasMasuk.type = ''
				app.kasMasuk.jumlah = ''
				app.kasMasuk.keterangan = ''
				app.errors = '';
				app.$router.replace('/kasMasuk');
			})
			.catch(function (resp) {
				app.success = false;
				app.errors = resp.response.data.errors;
			});
		},
		selected() {
			var app = this;
			axios.get(app.url+'/kas')
			.then(function (resp) {
				app.kas = resp.data;
			})
			.catch(function (resp) {
				alert("Could not load kas ");
			});
		},
		selected2() {
			var app = this;
			axios.get(app.url+'/kategoriTransaksi')
			.then(function (resp) {
				app.kategoriTransaksis = resp.data;
			})
			.catch(function (resp) {
				alert("Could not load kategori transaksi");
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

