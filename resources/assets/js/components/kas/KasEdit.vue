 <template>
 	<div class="container">
 		<ul class="breadcrumb">
 			<li><router-link :to="{name: 'indexDashboard'}">Home</router-link></li>
 			<li><router-link :to="{name: 'indexKas'}">Kas</router-link></li>
 			<li class="active">Edit Kas</li>
 		</ul>
 		<div class="row">
 			<div class="col-md-2"></div>
 			<div class="col-md-8">
 				<div class="panel panel-default">
 					<div class="panel-heading">
 						<p class="panel-title">Edit Kas</p>
 					</div>
 					<div class="panel-body">
 						<form v-on:submit.prevent="saveForm()" class="form-horizontal"> 
 							<div class="form-group">
 								<label for="name" class="col-md-2 control-label">
 									Kode Kas
 								</label>
 								<div class="col-md-4">
 									<input class="form-control" required autocomplete="off" placeholder="Kode Kas" type="text" v-model="kas.kode_kas" name="name"  autofocus="">
 									<span v-if="errors.kode_kas" class="label label-danger">
 										{{ errors.kode_kas[0] }}
 									</span>
 								</div>
 							</div> 

 							<div class="form-group">
 								<label for="name" class="col-md-2 control-label">
 									Nama Kas
 								</label>
 								<div class="col-md-4">
 									<input class="form-control" required autocomplete="off" placeholder="Email" type="text" v-model="kas.nama_kas" name="email"  autofocus="">
 									<span v-if="errors.nama_kas" class="label label-danger">
 										{{ errors.nama_kas[0] }}
 									</span>
 								</div>
 							</div> 

 							<div class="form-group">
 								<div class="col-md-4 col-md-offset-2">
 									<button class="btn btn-primary" id="btnSimpanKas" type="submit">
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
 			kasId: null,
 			url : window.location.origin+(window.location.pathname).replace("home","kas"),
 			kas: {
 				kode_kas: '',
 				nama_kas: ''
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
 			var newKas = app.kas;
 			axios.patch(app.url+'/' + app.kasId, newKas)
 			.then(function (resp) {
 				app.message = 'Sukses : Berhasil Mengedit Kas '+ app.kas.nama_kas;
 				app.alert(app.message);
 				app.kas.kode_kas = ''
 				app.kas.nama_kas = ''
 				app.errors = '';
 				app.$router.replace('/kas');

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
 			app.kasId = id;

 			axios.get(app.url+'/' + id +'/edit')
 			.then(function (resp) {
 				app.kas = resp.data;
 			})
 			.catch(function () {
 				alert("Could not load your kas")
 			});
 		}

 	}
 }
 </script>
