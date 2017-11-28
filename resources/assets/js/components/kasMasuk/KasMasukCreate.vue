<template>
	<div class="container">
		<ul class="breadcrumb">
			<li><router-link :to="{name: 'indexDashboard'}">Home</router-link></li>
			<li><router-link :to="{name: 'indexKasMasuk'}">Kas Masuk</router-link></li>
			<li class="active">Tambah Kas Masuk</li>
		</ul>
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<div class="panel panel-default">
					<div class="panel-heading">
						<p class="panel-title">Tambah Kas Masuk</p>
					</div>
					<div class="panel-body">
						<form v-on:submit.prevent="saveForm()" class="form-horizontal"> 
							<div class="form-group">
								<label for="kas_id" class="col-md-2 control-label">
									Kas
								</label>
								<div class="col-md-4">
									<selectize-component v-model="kasMasuk.kas_id" :settings="settings"> 
										<option v-for="ka, index in kas" v-bind:value="ka.id" >{{ ka.nama_kas }}</option>
									</selectize-component>
									<span v-if="errors.kas_id" class="label label-danger">{{ errors.kas_id[0] }}</span>
								</div>
							</div>
							<div class="form-group">
								<label for="kategori_id" class="col-md-2 control-label">
									Kategori Transaksi
								</label>
								<div class="col-md-4">
									<selectize-component v-model="kasMasuk.kategori_id" :settings="setting"> 
										<option v-for="kategoriTransaksi, index in kategoriTransaksis" v-bind:value="kategoriTransaksi.id" >{{ kategoriTransaksi.nama_kategori_transaksi }}</option>
									</selectize-component>
									<span v-if="errors.kategori_id" class="label label-danger">{{ errors.kategori_id[0] }}</span>
								</div>
							</div>
							<div class="form-group">
								<label for="jumlah" class="col-md-2 control-label">
									Jumlah
								</label>
								<div class="col-md-4">
									<input class="form-control" required autocomplete="off" placeholder="Nama Produk" type="text" v-model="kasMasuk.jumlah" name="jumlah"  autofocus="">
									<span v-if="errors.jumlah" id="name_error" class="label label-danger">
										{{ errors.jumlah[0] }}
									</span>
								</div>
							</div>
							<div class="form-group">
								<label for="keterangan" class="col-md-2 control-label">
									Keterangan
								</label>
								<div class="col-md-4">
									<input class="form-control" required autocomplete="off" placeholder="Nama Produk" type="text" v-model="kasMasuk.keterangan" name="keterangan"  autofocus="">
									<span v-if="errors.keterangan" id="name_error" class="label label-danger">
										{{ errors.keterangan[0] }}
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
			kas: [],
			kategoriTransaksis: [],
			url : window.location.origin+(window.location.pathname).replace("home", "kasMasuk"),
			kasMasuk: {
				kas_id: '',
				kategori_id: '',
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
				app.message = 'Sukses : Berhasil Menambah Kas Masuk '+ app.kasMasuk.kas_id;
				app.alert(app.message);
				app.kasMasuk.kas_id = ''
				app.kasMasuk.kategori_id = ''
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

