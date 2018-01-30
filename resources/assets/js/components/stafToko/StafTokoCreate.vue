<template>
	<div class="container">
		<ul class="breadcrumb">
			<li><router-link :to="{name: 'indexDashboard'}">Home</router-link></li>
			<li><router-link :to="{name: 'indexStafToko'}">Staff Toko</router-link></li>
			<li class="active">Tambah Staff Toko</li>
		</ul>
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<div class="panel panel-default">
					<div class="panel-heading">
						<p class="panel-title">Tambah Staff Toko</p>
					</div>
					<div class="panel-body">
						<form v-on:submit.prevent="saveForm()" class="form-horizontal" name="emailku"> 
							<div class="form-group">
								<label for="nama_pemilik" class="col-md-2 control-label">
									Nama Staff
								</label>
								<div class="col-md-4">
									<input id="nama_staff" class="form-control"  autocomplete="off" placeholder="Isi Nama Staff" type="text" v-model="user.nama_pemilik" name="nama_pemilik"  autofocus="">
									<span v-if="errors.nama_pemilik" id="nama_pemilik_error" class="label label-danger">
										{{ errors.nama_pemilik[0] }}
									</span>
								</div>
							</div>

							<div class="form-group">
								<label for="email" class="col-md-2 control-label">
									Email
								</label>
								<div class="col-md-4">
									<input id="email" class="form-control"  autocomplete="off" placeholder="Isi Email" type="email" v-model="user.email" name="email" autofocus="">
									<span v-if="errors.email" id="email_error" class="label label-danger">{{ errors.email[0] }}
									</span>
								</div>
							</div>

							<div class="form-group">
								<label for="no_telp" class="col-md-2 control-label">
									No Telp
								</label>
								<div class="col-md-4">
									<input id="no_telp" class="form-control"  autocomplete="off" placeholder="Isi No. telp" type="tel" v-model="user.no_telp" name="no_telp" autofocus="">
									<span v-if="errors.no_telp" id="no_telp_error" class="label label-danger">{{ errors.no_telp[0] }}
									</span>
								</div>
							</div>

							<div class="form-group">
								<label for="password" class="col-md-2 control-label">Password</label>
								<div class="col-md-4">
									<tr>
										<td>
											<input type="password" class="form-control" name="password" v-model="user.password"   	v-show="!showPass" placeholder="Isi Password" >
											<input type="text" class="form-control" name="password" v-model="user.password"   	v-show="showPass" >
										</td>
										<td>
											<button class="btn btn-secondary m-t-1" type="button" v-on:click="showPass = !showPass">
												<span v-show="!showPass"><i class="fa fa-eye" aria-hidden="true"></i></span>
												<span v-show="showPass"><i class="fa fa-eye-slash" aria-hidden="true"></i></span>
											</button>
										</td>
										<span v-if="errors.password" id="password" class="label label-danger">{{ errors.password[0] }}
										</span>
									</tr>
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-4 col-md-offset-2">
									<button class="btn btn-primary" value="simpan" type="submit" @click="klikUndang(user.nama_pemilik, user.email, user.no_telp, user.password)">
										<span v-model="undangs.true" v-show="undang">Undang</i></span>
										<span v-model="undangs.false" v-show="!undang">Loading . . .</i></span>
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
			url : window.location.origin+(window.location.pathname).replace("home", "staf-toko"),
			user: {
				nama_pemilik: '',
				email: '',
				no_telp: '',
				password: ''
			},
			validasi: {
				nama_staff: '',
				email: '',
				no_telp: ''
			},
			message : '',
			showPass: false,
			undang: true,
			undangs: {
				true: '',
				false: '',
			},
		}

	},
	methods: {
		klikUndang(nama_pemilik, email, no_telp, password) {
			var emails = document.forms['emailku']['email'].value;
			var atpos = emails.indexOf("@");
			var dotpos = emails.lastIndexOf(".");
			if (atpos < 1 || dotpos < atpos + 2 || dotpos+2 >= emails.length || !nama_pemilik || !email || !no_telp || !password) {
				return;
			}
			else {
				swal({
					title: "Memproses...",
					text: "Mohon tunggu",
					imageUrl: "images/ajaxloader.gif",
					showConfirmButton: false,
					allowOutsideClick: false,
					allowEscapeKey: false
				});
			// 	this.undang = false;

			// // using setTimeout to simulate ajax request
			// setTimeout(() => {
			// 	window.swal({
			// 		title: "Finished!",
			// 		showConfirmButton: false,
			// 		timer: 1000
			// 	});
			// }, 2000);

		}
	},
	saveForm() {

		var app = this;
		var newuser = app.user;
		axios.post(app.url, newuser)
		.then(function (resp) {
			swal({
				title: 'Berhasil!',
				type: 'success',
				text: 'Berhasil mengundang ' + app.user.email + ' sebagai staff baru. Email undangan telah terkirim.',
				showConfirmButton: false,
				timer: 2300
			})
			app.user.nama_pemilik = ''
			app.user.email = ''
			app.user.no_telp = ''
			app.user.password = ''
			app.errors = '';
			app.$router.replace('/staf-toko');
		})
		.catch(function (resp) {
			app.success = false;
			app.errors = resp.response.data.errors;
		});
	},
}
}
</script>

