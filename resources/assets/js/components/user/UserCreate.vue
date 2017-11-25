<template>
	<div class="container">
		<ul class="breadcrumb">
			<li><router-link :to="{name: 'indexDashboard'}">Home</router-link></li>
			<li><router-link :to="{name: 'indexUser'}">User</router-link></li>
			<li class="active">Tambah User</li>
		</ul>
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<div class="panel panel-default">
					<div class="panel-heading">
						<p class="panel-title">Tambah User</p>
					</div>
					<div class="panel-body">
						<form v-on:submit.prevent="saveForm()" class="form-horizontal"> 
							<div class="form-group">
								<label for="name" class="col-md-2 control-label">
									Nama User
								</label>
								<div class="col-md-4">
									<input class="form-control" required autocomplete="off" placeholder="Nama User" type="text" v-model="user.name" name="name"  autofocus="">
									<span v-if="errors.name" id="name_error" class="label label-danger">
										{{ errors.name[0] }}
									</span>
								</div>
							</div>

							<div class="form-group">
								<label for="name" class="col-md-2 control-label">
									Email
								</label>
								<div class="col-md-4">
									<input class="form-control" required autocomplete="off" placeholder="Email User" type="text" v-model="user.email" name="email" autofocus="">
									<span v-if="errors.email" id="email_error" class="label label-danger">{{ errors.email[0] }}
									</span>
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-4 col-md-offset-2">
									<button class="btn btn-primary" id="btnSimpanUser" type="submit"> 
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
			url : window.location.origin+(window.location.pathname).replace("home", "user"),
			user: {
				name: '',
				email: ''
			},
			message : ''
		}

	},
	methods: {
		saveForm() {
			var app = this;
			var newuser = app.user;
			axios.post(app.url, newuser)
			.then(function (resp) {
				app.message = 'Sukses : Berhasil Menambah User '+ app.user.name;
				app.alert(app.message);
				app.user.name = ''
				app.user.email = ''
				app.errors = '';
				app.$router.replace('/user');
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
		}

	}
}
</script>

