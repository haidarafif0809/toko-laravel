<template>
	<div class="container">
		<ul class="breadcrumb">
			<li><router-link :to="{name: 'indexDashboard'}">Home</router-link></li>
			<li><router-link :to="{name: 'indexKasMasuk'}">Kas Masuk</router-link></li>
			<li class="active">Tambah Kas Masuk</li>
		</ul>
		<div class="row">
			<div class="col-md-8 col-md-offset-2">

				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title"> Kas Masuk </h4>
					</div>
					<div class="panel-body">
						<form v-on:submit.prevent="saveForm()" class="form-horizontal">
							<div class="form-group">
								<label for="kas_id" class="col-md-2 control-label">Kas</label>
								<div class="col-md-4">
									<selectize-component v-model="kasMasuk.kas_id" :settings="settings"> 
										<option v-for="ka, index in kas" v-bind:value="ka.id" >{{ ka.nama_kas }}</option>
									</selectize-component>
									<span v-if="errors.kas_id" class="label label-danger">{{ errors.kas_id[0] }}</span>
								</div>
							</div>

							<div class="form-group">
								<label for="kategori_id" class="col-md-2 control-label">Kategori Transaksi</label>
								<div class="col-md-4">
									<selectize-component v-model="kasMasuk.kategori_id" :settings="setting"> 
										<option v-for="kategoriTransaksi, index in kategoriTransaksis" v-bind:value="kategoriTransaksi.id" >{{ kategoriTransaksi.nama_kategori_transaksi }}</option>
									</selectize-component>
									<span v-if="errors.kategori_id" class="label label-danger">{{ errors.kategori_id[0] }}</span>
								</div>
							</div>

							<div class="form-group">
								<label for="jumlah" class="col-md-2 control-label">Jumlah</label>
								<div class="col-md-4">
									<input class="form-control" required autocomplete="off" placeholder="Jumlah" type="number" v-model="kasMasuk.jumlah" name="jumlah"  autofocus="">
									<span v-if="errors.jumlah" class="label label-danger">{{ errors.jumlah[0] }}</span>
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
		this.selected();
		this.selected2();
	},

	data: function () {
		return {
			errors: [],
			kas: [],
			kategoriTransaksis: [],
			url : window.location.origin+(window.location.pathname).replace("home", "kasMasuk"),
			kasMasuk: {
				kas_masuk_id: '',
				kas_id: '',
				kategori_id: '',
				jumlah: '',
				keterangan: ''
			},
			kasMasukId: null,
			message: '',
			settings: {
				placeholder: 'Kas'
			},
			setting: {
				placeholder: 'Kategori'
			}
		}
	},
	methods: {
		saveForm() {
			var app = this;
			var newKasMasuk = app.kasMasuk;
			axios.patch(app.url+'/' + app.kasMasukId, newKasMasuk)
			.then(function (resp) {
				app.message = 'Berhasil Merubah Kas Masuk "'+app.kasMasuk.kas_masuk_id+'"'
				app.alert(app.message);
				app.$router.replace('/kasMasuk');

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
			app.kasMasukId = id;

			axios.get(app.url+'/' + id + '/edit')
			.then(function (resp) {
				app.kasMasuk = resp.data;
			})
			.catch(function () {
				alert("Could not load your Kas Masuk")
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
		}
	}

}
</script>