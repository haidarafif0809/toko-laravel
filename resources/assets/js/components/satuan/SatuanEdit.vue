<template>
	<div class="container">
		<ul class="breadcrumb">
			<li><router-link :to="{name: 'indexDashboard'}">Home</router-link></li>
			<li><router-link :to="{name: 'indexSatuan'}">Satuan</router-link></li>
			<li class="active">Tambah satuan</li>
		</ul>

		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title"> satuan </h4>
					</div>
					<div class="panel-body">
						<form v-on:submit.prevent="saveForm()" class="form-horizontal">
							<div class="form-group">
								<label for="nama_satuan" class="col-md-2 control-label">Nama</label>
								<div class="col-md-4">
									<input class="form-control" required autocomplete="off" placeholder="Nama" type="nama_satuan" v-model="satuan.nama_satuan" name="nama_satuan"  autofocus="">
									<span v-if="errors.nama_satuan" class="label label-danger">{{ errors.nama_satuan[0] }}</span>

								</div>


							</div>
							<div class="form-group">
								<div class="col-md-4 col-md-offset-2">
									<button class="btn btn-primary" id="btnSimpanSatuan" type="submit">Submit</button>
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
		this.getItem();
	},

	data: function () {
		return {
			errors: [],
			url : window.location.origin+(window.location.pathname).replace("home", "satuan"),
			satuan: {
				nama_satuan: ''
			},
			satuanId: null,
			message: ''
		}
	},
	methods: {
		saveForm() {
			var app = this;
			var newSatuan = app.satuan;
			axios.patch(app.url+'/' + app.satuanId, newSatuan)
			.then(function (resp) {
				app.message = 'Berhasil Merubah Satuan "'+app.satuan.nama_satuan+'"'
				app.alert(app.message);
				app.$router.replace('/satuan');

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
			app.satuanId = id;

			axios.get(app.url+'/' + id + '/edit')
			.then(function (resp) {
				app.satuan = resp.data;
			})
			.catch(function () {
				alert("Could not load your satuan")
			});
		}

	}

}
</script>