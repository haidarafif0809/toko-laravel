<template>
	<div class="container">
		<div class="row">
			<ul class="breadcrumb">
				<li><router-link :to="{name: 'indexDashboard'}">Home</router-link></li>
				<li><router-link :to="{name: 'profileTokoIndex'}">Profile Toko</router-link></li>
				<li class="active">Edit Profile Toko</li>
			</ul>
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title"> Profile Toko </h4>
					</div>
					<form v-on:submit.prevent="saveForm()" class="form-horizontal">
						<div class="form-group">
							<label for="nama_toko" class="col-md-2 control-label">Nama Toko</label>
							<div class="col-md-4">
								<input class="form-control" required autocomplete="on" placeholder="Nama Toko" type="text" v-model="profileToko.nama_toko" name="nama_toko"  autofocus="">
								<span v-if="errors.nama_toko" class="label label-danger">{{ errors.nama_toko[0] }}</span>
							</div>
						</div>
						<div class="form-group">
							<label for="nama_pemilik" class="col-md-2 control-label">Nama Pemilik</label>
							<div class="col-md-4">
								<input class="form-control" required autocomplete="off" placeholder="Nama Pemilik" type="text" v-model="profileToko.nama_pemilik" name="nama_pemilik"  autofocus="">
								<span v-if="errors.nama_pemilik" class="label label-danger">{{ errors.nama_pemilik[0] }}</span>
							</div>
						</div>
						<div class="form-group">
							<label for="email" class="col-md-2 control-label">Email</label>
							<div class="col-md-4">
								<input class="form-control" required autocomplete="off" placeholder="Email" type="email" v-model="profileToko.email" name="email"  autofocus="">
								<span v-if="errors.email" class="label label-danger">{{ errors.email[0] }}</span>
							</div>
						</div>
						<div class="form-group">
							<label for="no_telp" class="col-md-2 control-label">No. Telp</label>
							<div class="col-md-4">
								<input class="form-control" required autocomplete="off" placeholder="No. Telp" type="tel" v-model="profileToko.no_telp" name="no_telp"  autofocus="">
								<span v-if="errors.no_telp" class="label label-danger">{{ errors.no_telp[0] }}</span>
							</div>
						</div>
						<div class="form-group">
							<label for="alamat" class="col-md-2 control-label">Alamat</label>
							<div class="col-md-4">
								<textarea class="form-control" autocomplete="off" placeholder="Alamat" type="text" v-model="profileToko.alamat" name="alamat"  autofocus=""></textarea>
								<span v-if="errors.alamat" class="label label-danger">{{ errors.alamat [0] }}</span>
							</div>
						</div>
						<div class="form-group">
							<label for="logo" class="col-md-2 control-label">Logo</label>
							<div class="col-md-4">
								<input class="form-control" autocomplete="off" placeholder="Logo" type="text" v-model="profileToko.logo" name="logo"  autofocus="">
								<span v-if="errors.logo" class="label label-danger">{{ errors.logo[0] }}</span>
							</div>
						</div>
						<input class="form-control" autocomplete="off" placeholder="" type="hidden" v-model="profileToko.id" name="id"  autofocus="">
						<div class="form-group">
							<div class="col-md-4 col-md-offset-2">
								<button class="btn btn-primary" id="btnSimpanProfileToko" type="submit">Submit</button>
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
	},

	data: function () {
		return {
			errors: [],
			url : window.location.origin+(window.location.pathname).replace("home", "profile-toko"),
			profileToko: {
				id: '',
				nama_toko: '',
				nama_pemilik: '',
				email: '',
				no_telp: '',
				alamat: '',
				logo: '',
			},
			profileTokoId: null,
			message: ''
		}
	},
	methods: {
		saveForm() {
			var app = this;
			var newToko = app.profileToko;
			// var namaToko = app.profileToko.nama_toko;
			// var namaPemilik = app.profileToko.nama_pemilik;
			// var email = app.profileToko.email;
			// var no_telp = app.profileToko.no_telp;
			// var alamat = app.profileToko.alamat;
			// var logo = app.profileToko.logo;
			// var id = app.profileToko.id;
			// axios.get(app.url+'/edit?nama_toko='+namaToko+'&nama_pemilik='+namaPemilik+'&email='+email+'&no_telp='+no_telp+'&alamat='+alamat+'&logo='+logo+'&id='+id)
			axios.patch(app.url+'/' + app.profileTokoId, newToko)
			.then(function (resp) {
				app.message = 'Berhasil Merubah Profile Toko "'+app.profileToko.nama_pemilik+'"'
				app.alert(app.message);
				app.errors = '';
				app.$router.replace('/profile-toko');
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
			app.profileTokoId = id;

			axios.get(app.url+'/' + id + '/edit')
			.then(function (resp) {
				app.profileToko = resp.data;
			})
			.catch(function () {
				alert("Could not load your Profile Toko")
			});
		}

	}

}
</script>