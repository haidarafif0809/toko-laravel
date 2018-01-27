<style scoped>
.shadow {
	box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
img {
	width: 70%;
}
</style>
<template>
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<h4 class="panel-heading" style="color: red;"> <i class="fa fa-info-circle" aria-hidden="true"></i> <i>Lengkapilah Profile Toko Anda dengan benar !</i></h4>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">Lengkapi Profile Toko </h4>
					</div>
					<br> 
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
							<label for="provinsi" class="col-md-2 control-label">Provinsi</label>
							<div class="col-md-4">
								<selectize-component required v-model="profileToko.provinsi" :settings="setting_provinsi">
									<option v-for="provinsis in provinsi" v-bind:value="provinsis.id" >{{ provinsis.name }}</option>
								</selectize-component>
								<span v-if="errors.provinsi" class="label label-danger">{{ errors.provinsi[0] }}</span>
							</div>
						</div>
						<div class="form-group">
							<label for="kabupaten" class="col-md-2 control-label">Kabupaten </label>
							<div class="col-md-4">
								<selectize-component required v-model="profileToko.kabupaten" :settings="setting_kabupaten">
									<option v-for="kabupatens in kabupaten" v-bind:value="kabupatens.id" >{{ kabupatens.name }}</option>
								</selectize-component>
								<span v-if="errors.kabupaten" class="label label-danger">{{ errors.kabupaten[0] }}</span>
							</div>
						</div>
						<div class="form-group">
							<label for="alamat" class="col-md-2 control-label">Alamat Lengkap </label>
							<div class="col-md-4">
								<textarea class="form-control" type="text" name="alamat" v-model="profileToko.alamat" required placeholder="Lengkapi Alamat Anda"></textarea> 
								<span v-if="errors.kabupaten" class="label label-danger">{{ errors.kabupaten[0] }}</span>
							</div>
						</div>

						<div class="form-group">
							<label for="prefix_member_id" class="col-md-2 control-label">Prefix Member Id</label>
							<div class="col-md-4">
								<input class="form-control" autocomplete="on" placeholder="Prefix Member Id" type="text" v-model="profileToko.prefix_member_id" name="prefix_member_id"  autofocus="">
								<span v-if="errors.prefix_member_id" class="label label-danger">{{ errors.prefix_member_id[0] }}</span>
							</div>
						</div>

						<div v-if="profileToko.foto != ''" class="form-group">
							<label for="foto" class="col-md-2 control-label">Logo</label>
							<div v-if="profileToko.foto != null" class="col-md-4">		
								<div v-if="profileToko.foto.length > 100">
									<img :src="profileToko.foto" class="img-responsive thumbnail shadow">
								</div>		
								<div v-else>
									<img :src="url_img + profileToko.foto" class="img-responsive thumbnail shadow">
								</div>
							</div>
							<div v-else class="col-md-4">
								<img :src="broken_file" title="File yang Anda masukkan tidak didukung" class="img-responsive thumbnail shadow">
							</div>
						</div>

						<div class="form-group">
							<label for="foto" class="col-md-2 control-label"></label>
							<div class="col-md-4">
								<input class="form-control" type="file" name="foto" v-on:change="onFileChange" id="image" >
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
		this.dataProvinsi();
		this.dataKabupaten();
	},

	data: function () {
		return {
			provinsi: [],
			kabupaten: [],
			errors: [],
			url : window.location.origin+(window.location.pathname).replace("home", "profile-toko"),
			url_img : window.location.origin+(window.location.pathname).replace("home", "logo/"),
			broken_file : window.location.origin + (window.location.pathname).replace("home", "broken-image.png"),
			profileToko: {
				id: '',
				nama_toko: '',
				nama_pemilik: '',
				email: '',
				no_telp: '',
				provinsi: '',
				kabupaten: '',
				alamat: '',
				prefix_member_id:'',
				foto: '',
			},
			setting_provinsi: {
				placeholder:"Pilih Provinsi"
			},
			setting_kabupaten: {
				placeholder:"Pilih Kabupaten"
			},

			profileTokoId: null,
			message: ''
		}
	},
	methods: {
		onFileChange(e) {
			let files = e.target.files || e.dataTransfer.files;
			if (!files.length)
				return null;
			this.createImage(files[0]);
		},
		createImage(file) {
			let reader = new FileReader();
			let app = this;
			let ekstensi = /(\.jpg|\.jpeg|\.png)/i;

			if(!file.name.match(ekstensi)) {
				app.profileToko.foto = null;
				this.$swal({
					title: "File tidak didukung!",
					text: "Tolong pilih file gambar dengan format .jpg, .jpeg, atau .png.",
					icon: "warning",
					buttons: "Saya mengerti",
				});
			}
			else {
				reader.onload = (e) => {
					app.profileToko.foto = e.target.result;
				};
				reader.readAsDataURL(file);
			}
		},
		saveForm() {
			var app = this;
			var newProfileToko = app.profileToko;
			var image = document.getElementById('image');

			if (image.value == '') {
				newProfileToko.foto = null;
			}
			axios.patch(app.url+'/' + app.profileTokoId, newProfileToko)
			.then(function (resp) {
				app.message = 'Berhasil Merubah Profile Toko "'+app.profileToko.nama_pemilik+'"'
				app.alert(app.message);
				app.profileToko.nama_toko=''
				app.profileToko.nama_pemilik=''
				app.profileToko.email=''
				app.profileToko.no_telp=''
				app.profileToko.alamat=''
				app.profileToko.prefix_member_id=''
				app.profileToko.foto=''
				app.errors = '';
				app.$router.replace('/profile-toko');
				console.log(resp)
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
				console.log(resp.data.foto);
			})
			.catch(function () {
				alert("Could not load your Profile Toko")
			});
		},
		dataProvinsi() {
			let app = this;
			axios.get(app.url+'/provinsi')
			.then(function(resp) {
				app.provinsi = resp.data;
			})
			.catch(function(resp) {
				alert("Could not load your Provinsi")
			});
		},
		dataKabupaten(provinsi_id) {
			let app = this;
			var type = 'kabupaten';
			axios.get(app.url+'/kabupaten/'+provinsi_id+'/'+type)
			.then(function(resp) {
				app.kabupaten = resp.data;
			})
			.catch(function(resp) {
				alert("Could not load your Kabupaten")
			});
		}

	},
	watch: {
		'profileToko.provinsi': function (newVal, oldVal) {
			if (newVal !== " ") {
				this.dataKabupaten(newVal);
			}
		}
	}

			// var namaToko = app.profileToko.nama_toko;
			// var namaPemilik = app.profileToko.nama_pemilik;
			// var email = app.profileToko.email;
			// var no_telp = app.profileToko.no_telp;
			// var alamat = app.profileToko.alamat;
			// var logo = app.profileToko.logo;
			// var id = app.profileToko.id;
			// axios.get(app.url+'/edit?nama_toko='+namaToko+'&nama_pemilik='+namaPemilik+'&email='+email+'&no_telp='+no_telp+'&alamat='+alamat+'&logo='+logo+'&id='+id)
		}
		</script>