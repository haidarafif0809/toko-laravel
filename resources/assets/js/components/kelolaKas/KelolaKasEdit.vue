<template>
	<div class="container">
		<ul class="breadcrumb">
			<li><router-link :to="{name: 'indexDashboard'}">Home</router-link></li>
			<li><router-link :to="{name: 'indexKelolaKas'}">Kelola Kas</router-link></li>
			<li class="active">Edit Kas</li>
		</ul>
		<div class="row">
			<div class="col-md-8 col-md-offset-2">

				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title"> Kelola Kas </h4>
					</div>
					<div class="panel-body">
						<form v-on:submit.prevent="saveForm()" class="form-horizontal">

							<div class="form-group">
								<label for="type" class="col-md-2 control-label">Type Kas</label>
								<div class="col-md-4">
									<input id="radio1" type="radio" name="type" v-model="kelolaKas.type" value="1"> <label for="radio1">kas masuk</label>
									<input id="radio2" type="radio" name="type" v-model="kelolaKas.type" value="2"> <label for="radio2">kas keluar</label>
									<span v-if="errors.type" class="label label-danger">{{ errors.type[0] }}</span>

								</div>
							</div> 

							<div class="form-group">
								<label for="jumlah" class="col-md-2 control-label">Jumlah</label>
								<div class="col-md-4">
									<money class="form-control" required autocomplete="off" placeholder="Jumlah" v-model="kelolaKas.jumlah" v-bind="money" name="jumlah"  autofocus=""></money>
									<span v-if="errors.jumlah" class="label label-danger">{{ errors.jumlah[0] }}</span>
								</div>
							</div>

							<div class="form-group">
								<label for="keterangan" class="col-md-2 control-label">Keterangan</label>
								<div class="col-md-4">
									<textarea class="form-control" required autocomplete="off" placeholder="Keterangan" v-model="kelolaKas.keterangan" name="keterangan"  autofocus=""></textarea>
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
		// this.selected();
		// this.selected2();
	},

	data: function () {
		return {
			errors: [],
			url : window.location.origin+(window.location.pathname).replace("home", "kelola-kas"),
			kelolaKas: {
				kelola_kas_id: '',
				type: '',
				jumlah: '',
				keterangan: ''
			},
			kelolaKasId: null,
			message: '',
			settings: {
				placeholder: 'Kas'
			},
			setting: {
				placeholder: 'Kategori'
			},
			price: 123.45,
	        money: {
	          decimal: ',',
	          thousands: '.',
	          //prefix: 'Rp',
	          //suffix: ' #',
	          precision: 0,
	          masked: false
	        }
		}
	},
	methods: {
		saveForm() {
			var app = this;
			var newKelolaKas = app.kelolaKas;
			axios.patch(app.url+'/' + app.kelolaKasId, newKelolaKas)
			.then(function (resp) {
				if (app.kelolaKas.type == 1){
		            var typeKas = "Kas Masuk";
		          }
		          else{
		            var typeKas = "Kas Keluar";
		          }
				app.message = 'Berhasil Merubah Kas "'+typeKas+'"'
				app.alert(app.message);
				app.$router.replace('/kelola-kas');

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
			app.kelolaKasId = id;

			axios.get(app.url+'/' + id + '/edit')
			.then(function (resp) {
				app.kelolaKas = resp.data;
			})
			.catch(function () {
				alert("Could not load your Kelola Kas")
			});
		},
		// selected() {
		// 	var app = this;
		// 	axios.get(app.url+'/kas')
		// 	.then(function (resp) {
		// 		app.kas = resp.data;
		// 	})
		// 	.catch(function (resp) {
		// 		alert("Could not load kas ");
		// 	});
		// },
		// selected2() {
		// 	var app = this;
		// 	axios.get(app.url+'/kategoriTransaksi')
		// 	.then(function (resp) {
		// 		app.kategoriTransaksis = resp.data;
		// 	})
		// 	.catch(function (resp) {
		// 		alert("Could not load kategori transaksi");
		// 	});
		// }
	}

}
</script>