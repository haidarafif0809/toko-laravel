<template>
	<div class="container">
		<ul class="breadcrumb">
			<li><router-link :to="{name: 'indexDashboard'}">Home</router-link></li>
			<li><router-link :to="{name: 'indexSuplier'}">Suplier</router-link></li>
			<li class="active">Edit Suplier</li>
		</ul>
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-9">
				<div class="panel panel-default">
					<div class="panel-heading">
						<p class="panel-title">Edit Suplier</p>
					</div>
					<div class="panel-body">
						<form v-on:submit.prevent="saveForm()" class="form-horizontal"> 
							<div class="form-group">
								<label for="name" class="col-md-2 control-label">
									Nama Suplier
								</label>
								<div class="col-md-4">
									<input class="form-control" required autocomplete="off" placeholder="Nama suplier" type="text" v-model="suplier.nama_suplier" name="nama_suplier"  autofocus="">
									<span v-if="errors.nama_suplier" class="label label-danger">
										{{ errors.nama_suplier[0] }}
									</span>
								</div>
							</div> 

							<div class="form-group">
								<label for="name" class="col-md-2 control-label">
									Alamat Suplier
								</label>
								<div class="col-md-4">
									<input class="form-control" required autocomplete="off" placeholder="Alamat suplier" type="text" v-model="suplier.alamat_suplier" name="alamat_suplier"  autofocus="">
									<span v-if="errors.alamat_suplier" class="label label-danger">
										{{ errors.alamat_suplier[0] }}
									</span>
								</div>
							</div> 

							<div class="form-group">
								<label for="name" class="col-md-2 control-label">
									Nomer Telpon 
								</label>
								<div class="col-md-4">
									<input class="form-control" required autocomplete="off" placeholder="Nomer Telpon" type="text" v-model="suplier.no_telp_suplier" name="no_telp_suplier"  autofocus="">
									<span v-if="errors.no_telp_suplier" class="label label-danger">
										{{ errors.no_telp_suplier[0] }}
									</span>
								</div>
							</div> 

							<div class="form-group">
								<div class="col-md-4 col-md-offset-2">
									<button class="btn btn-primary" id="btnSimpansuplier" type="submit">
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
			suplierId: null,
			url : window.location.origin+(window.location.pathname).replace("home","suplier"),
			suplier: {
				nama_suplier: '',
				alamat_suplier: '',
				no_telp_suplier: ''
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
			var newSuplier = app.suplier;
			axios.patch(app.url+'/' + app.suplierId, newSuplier)
			.then(function (resp) {
				app.message = 'Sukses : Berhasil Mengedit suplier '+ app.suplier.nama_suplier;
				app.alert(app.message);
				app.suplier.nama_suplier = ''
				app.suplier.alamat_suplier = ''
				app.suplier.no_telp_suplier = ''
				app.errors = '';
				app.$router.replace('/suplier');

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
			app.suplierId = id;

			axios.get(app.url+'/' + id +'/edit')
			.then(function (resp) {
				app.suplier = resp.data;
			})
			.catch(function () {
				alert("Could not load your suplier")
			});
		}

	}
}
</script>
