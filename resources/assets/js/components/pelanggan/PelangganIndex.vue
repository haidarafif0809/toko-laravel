<style scoped>
.cart-item {
	max-height: 160px;
	overflow-y: scroll;
}
</style>

<template>
	<div class="container">
		<!-- <ol class="breadcrumb">
			<li><router-link :to="{name: 'indexDashboard'}">Home</router-link></li>
			<li class="active">Pelanggan</li>
		</ol> -->

		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">MANAJEMEN PELANGGAN</div>
			</div>
		</div>

		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">Filter Pelanggan</div>
				<div class="panel-body">
					<div data-role="page">
						<div data-role="main" class="ui-content">
							<form method="post" action="/action_page_post.php">
								<div data-role="rangeslider">
									<label for="price-min">Pelanggan:</label>
									<input type="range" name="price-min" id="price-min" value="200" min="0" max="1000">
									<label for="price-max">Pelanggan:</label>
									<input type="range" name="price-max" id="price-max" value="800" min="0" max="1000">
								</div>
							</form>
						</div>
					</div> 
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<button class="btn btn-success">
						<i class="fa fa-arrow-circle-o-up" aria-hidden="true"></i>
						import
					</button>
					<button class="btn btn-primary">
						<i class="fa fa-arrow-circle-o-down" aria-hidden="true"></i>
						unduh
					</button>
					<button class="btn btn-primary" v-on:click="tambahPelanggan">
						<i class="fa fa-plus" aria-hidden="true"></i>
						Tambah
					</button>
					<!-- <span><router-link :to="{name: 'createPelanggan'}" type="button" class="btn btn-primary"> -->
						<!-- Tambah</router-link></span> -->
						<!-- <button class="btn btn-primary">tambah</button> -->
					</div>
					<div class="panel-body">
						<div class="panel-heading"> Menemukan : {{ pelanggans.length }} Pelanggan </div>
						<div class="row">
							<div class="col-md-12 pencarian">
								<input type="text" class="form-control" name="search" placeholder="Pencarian Pelanggan"  v-model="search" >
								<!-- <p>Pencarian berdasarkan kode, nama, nomor telepon</p> -->
							</div>
						</div>	

						<ul class="list-group cart-item">
							<div v-for="pelanggan ,index in pelanggans">
								<div class="row">
									<div class="col-md-11 list-pelanggan" >
										<div class="thumbnail" v-on:click="detailPelanggan(pelanggan.id, pelanggan.kode_pelanggan, pelanggan.nama_pelanggan, pelanggan.jenis_kelamin, pelanggan.tanggal_lahir, pelanggan.nomor_telepon, pelanggan.email, pelanggan.kota, pelanggan.alamat, pelanggan.kode_pos, pelanggan.catatan)">
											<p>
												<i class="fa fa-user-circle-o" aria-hidden="true"></i>	
												<span><b>{{pelanggan.nama_pelanggan}}</b></span>
											</p>
											<p>{{pelanggan.kode_pelanggan}}</p>
											<p>
												<i class="fa fa-mobile" aria-hidden="true"></i>
												<span>{{pelanggan.nomor_telepon}}</span>
											</p>
											<p>
												<i class="fa fa-envelope-o" aria-hidden="true"></i>
												<span>{{pelanggan.email}}</span>
											</p>
										</div>
									</div>
								</div>
							</div>
						</ul>
					</div>
				</div>
			</div>

			<div class="col-md-8">
				<div class="panel panel-default">
					<div class="panel-heading">INFORMASI PELANGGAN</div>

					<div class="panel panel-default">
						<ul class="nav nav-tabs">
							<li class="col-sm-4  active">
								<a data-toggle="tab" v-on:click="tentangPelanggan">TENTANG PELANGGAN</a>
							</li>

							<li class="col-sm-4">
								<a data-toggle="tab"  v-on:click="riwayatTransaksi">RIWAYAT TRANSAKSI</a>
							</li>

							<li class="col-sm-4">
								<a data-toggle="tab"  v-on:click="perilaku">PERILAKU</a>
							</li>
						</ul>
					</div>


					<div class="row-fluid" v-if="formPelanggan == 1">
						<form v-on:submit.prevent="saveForm()" class="form-horizontal">
							<div class="col-md-12 form-info">
								<div class="form-group">
									<label class="col-md-4">Kolom bertanda <font size="5px" color="red">*</font> wajib diisi.</label>
								</div>
							</div>

							<div class="row">
								<div class="form-group">
									<label for="kode_pelanggan" class="col-md-3 control-label">Kode<font size="5px" color="red">*</font></label>
									<div class="col-md-8">
										<input class="form-control" required autocomplete="off" placeholder="Kode Pelanggan" type="text" v-model="pelanggan.kode_pelanggan" name="kode_pelanggan"  autofocus="" :disabled="disable == 1">
										<span v-if="errors.kode_pelanggan" class="label label-danger">{{ errors.kode_pelanggan[0] }}</span>
									</div>
								</div>
							</div>

							<div class="row"> 
								<div class="form-group">
									<label for="nama_pelanggan" class="col-md-3 control-label">Nama<font size="5px" color="red">*</font></label>
									<div class="col-md-8">
										<input class="form-control" required autocomplete="off" placeholder="Nama Pelanggan" type="text" v-model="pelanggan.nama_pelanggan" name="nama_pelanggan"  autofocus="" :disabled="disable == 1">
										<span v-if="errors.nama_pelanggan" class="label label-danger">{{ errors.nama_pelanggan[0] }}</span>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="form-group">
									<label for="jenis_kelamin'" class="col-md-3 control-label">Jenis Kelamin <font size="5px" color="red">*</font></label>
									<div class="col-md-8">
										<selectize-component v-model="pelanggan.jenis_kelamin" :settings="settings" :disabled="disable == 1"> 
											<option value="1"  >laki-laki</option>
											<option value="2"  >perempuan</option>
										</selectize-component>
										<span v-if="errors.jenis_kelamin" class="label label-danger">{{ errors.jenis_kelamin[0] }}</span>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="form-group">
									<label for="tanggal_lahir" class="col-md-3 control-label">Tanggal Lahir</label>
									<div class="col-md-8">
										<input class="form-control" autocomplete="off" placeholder="YYYY-MM-DD" type="date" v-model="pelanggan.tanggal_lahir" name="tanggal_lahir"  autofocus="" :disabled="disable == 1">
										<span v-if="errors.tanggal_lahir" class="label label-danger">{{ errors.tanggal_lahir[0] }}</span>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="form-group">
									<label for="nomor_telepon" class="col-md-3 control-label">Nomor Telepon <font size="5px" color="red">*</font></label>
									<div class="col-md-8">
										<input class="form-control" required autocomplete="off" placeholder="Nomor Telepon" type="number" v-model.phone="pelanggan.nomor_telepon" name="nomor_telepon"  autofocus="" :disabled="disable == 1">
										<span v-if="errors.nomor_telepon" class="label label-danger">{{ errors.nomor_telepon[0] }}</span>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="form-group">
									<label for="email" class="col-md-3 control-label">Email</label>
									<div class="col-md-8">
										<input class="form-control" autocomplete="off" placeholder="Email" type="email" v-model="pelanggan.email" name="email" autofocus="" :disabled="disable == 1 ">
										<span v-if="errors.email" id="email_error" class="label label-danger">{{ errors.email[0] }}</span>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="form-group">
									<label for="alamat" class="col-md-3 control-label">Alamat</label>
									<div class="col-md-8">
										<input class="form-control" autocomplete="off" placeholder="Alamat" type="text" v-model="pelanggan.alamat" name="alamat" autofocus="" :disabled="disable == 1">
										<span v-if="errors.alamat" class="label label-danger">{{ errors.alamat[0] }}</span>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="form-group">
									<label for="kota" class="col-md-3 control-label">Kota</label>
									<div class="col-md-8">
										<input class="form-control" autocomplete="off" placeholder="Kota" type="text" v-model="pelanggan.kota" name="kota" autofocus="" :disabled="disable == 1">
										<span v-if="errors.kota" id="email_error" class="label label-danger">{{ errors.kota[0] }}</span>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="form-group">
									<label for="kode_pos" class="col-md-3 control-label">Kode Pos</label>
									<div class="col-md-8">
										<input class="form-control" autocomplete="off" placeholder="Kode Pos" type="number" v-model="pelanggan.kode_pos" name="kode_pos" autofocus="" :disabled="disable == 1">
										<span v-if="errors.kode_pos" id="email_error" class="label label-danger">{{ errors.kode_pos[0] }}</span>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="form-group">
									<label for="catatan" class="col-md-3 control-label">Catatan</label>
									<div class="col-md-8">
										<textarea class="form-control" autocomplete="off" placeholder="Catatan" v-model="pelanggan.catatan" name="catatan"  autofocus="" :disabled="disable == 1"></textarea>
										<span v-if="errors.catatan" id="email_error" class="label label-danger">{{ errors.catatan[0] }}</span>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="form-group">
									<div class="col-md-12 col-md-offset-8">

										<button v-if="disable == 0" class="btn btn-warning" id="btnSimpanPelanggan" type="submit">
											<i class="fa fa-floppy-o" aria-hidden="true"></i>
											Simpan 
										</button>

										<button v-if="disable == 0" class="btn btn-default" @click="onDisable">
											<i class="fa fa-times" aria-hidden="true"></i>
											Batal
										</button>

										<button v-if="edit == 1" type="button" class="btn btn-primary" v-on:click="editPelanggan">
											<i class="fa fa-pencil" aria-hidden="true"></i>
											Edit
										</button>

										<button v-if="disable == 2" class="btn btn-warning" type="button" v-on:click="saveFormEdit">
											<i class="fa fa-floppy-o" aria-hidden="true"></i>
											Simpan
										</button>

										<button v-if="disable == 2" class="btn btn-default" type="button" @click="batalEdit">
											<i class="fa fa-times" aria-hidden="true"></i>
											Batal
										</button>

										<button v-if="edit == 1" class="btn btn-danger" type="button" v-on:click="deleteEntry">
											<i class="fa fa-trash-o" aria-hidden="true"></i>
											Hapus
										</button>
									</div>
								</div>
							</div>
						</form>
					</div>

					<div class="row-fluid" v-if="riwayatBelanja == 1">
						<div class="panel-heading">
							<div class="btn-group">
								<button class="btn btn-xs btn-default active">Mingguan</button>	
								<button class="btn btn-xs btn-default">Bulanan</button>
								<button class="btn btn-xs btn-default">Tahunan</button>
								<button class="btn btn-xs btn-default">Rentang Waktu</button>
							</div>
						</div>
						<div class="panel panel-body">
							<input type="text">

							<select > 
								<option value="1"  >Jan</option>
								<option value="2"  >Feb</option>
								<option value="3"  >Mar</option>
								<option value="4"  >Apr</option>
								<option value="5"  >Mei</option>
								<option value="6"  >Jun</option>
								<option value="7"  >Jul</option>
								<option value="8"  >Agt</option>
								<option value="9"  >Sep</option>
								<option value="10" >Okt</option>
								<option value="11" >Nov</option>
								<option value="12" >Des</option>
							</select>

							<select > 
								<option value="2016"  >2016</option>
								<option value="2017"  >2017</option>
								<option value="2018"  >2018</option>
							</select>
							<button class="btn btn-success">
								<i class="fa fa-download" aria-hidden="true"></i>
								Excel
							</button>
						</div>
						<table border="2">
							<thead>
								<th class="col-md-2">Tanggal</th>
								<th class="col-md-4">Produk</th>
								<th class="col-md-3">Jumlah Produk</th>
								<th class="col-md-3">Total Transaksi</th>
							</thead>
							<tbody>
								<td>05 Dec 2017 / 11:49</td>
								<td>kentang goreng x1.000</td>
								<td>10</td>
								<td>126,000</td>
							</tbody>
						</table>
					</div>

					<div class="row-fluid" v-if="perilakuPelanggan == 1">
						<div class="panel-body">
							<div class="table-responsive">
								<table class="table table-striped table-hover">
									<tbody>	
										<tr>
											<td>Jumlah Order</td>
											<td>9</td>
										</tr>
										<tr>
											<td>Total Belanja</td>
											<td>Rp 617.800,00</td>
										</tr>
										<tr>
											<td>Rata-rata Belanja</td>
											<td>Rp 68.644,44</td>
										</tr>
										<tr>
											<td>Terakhir Datang</td>
											<td>1 minggu yang lalu</td>						
										</tr>
										<tr>
											<td>Rata-rata Kedatangan</td>
											<td>setiap 3 hari</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	data: function () {
		return {
			pelanggans: [],
			pelanggansData: {},
			url : window.location.origin+(window.location.pathname).replace("home","pelanggan"),
			search : '',
			loading : true,
			errors: [],
			pelanggan: {
				id: '',
				kode_pelanggan: '',
				nama_pelanggan: '',
				jenis_kelamin: '',
				tanggal_lahir: '',
				nomor_telepon: '',
				email: '',
				kota: '',
				alamat: '',
				kode_pos: '',
				catatan: '',
			},
			pelangganId: null,
			message: '',
			disable: 1,
			edit: 0,
			formPelanggan: 1,
			riwayatBelanja: 0,
			perilakuPelanggan:0,
			settings: {
				placeholder: 'Pilih Jenis Kelamin'
			} 
		}
	},
	mounted() {
		var app = this;
		app.loading = true
		app.getPelanggans();	
		// app.getPelanggan();
	},
	watch: {
        // whenever question changes, this function will run
        search: function (newQuestion) {
        	this.getHasilPencarian();  
        }
    },
    methods: {
    	tentangPelanggan(){
    		this.formPelanggan = 1
    		this.riwayatBelanja = 0
    		this.perilakuPelanggan = 0
    	},

    	riwayatTransaksi(){
    		this.formPelanggan = 0
    		this.riwayatBelanja = 1
    		this.perilakuPelanggan = 0
    	},

    	perilaku(){
    		this.formPelanggan = 0
    		this.riwayatBelanja = 0
    		this.perilakuPelanggan = 1
    	},

    	tambahPelanggan(){
    		this.pelanggan.kode_pelanggan = ''
    		this.pelanggan.nama_pelanggan = ''
    		this.pelanggan.jenis_kelamin = ''
    		this.pelanggan.tanggal_lahir = ''
    		this.pelanggan.nomor_telepon = ''
    		this.pelanggan.email = ''
    		this.pelanggan.kota = ''
    		this.pelanggan.alamat = ''
    		this.pelanggan.kode_pos = ''
    		this.pelanggan.catatan = ''
    		this.$router.replace('/pelanggan');
    		this.disable = 0
    		this.formPelanggan = 1
    	},

    	onDisable(){
    		this.disable = 1
    	},

    	batalEdit(){
    		this.disable = 1
    		this.edit = 1
    	},

    	detailPelanggan(id, kode_pelanggan, nama_pelanggan, jenis_kelamin, tanggal_lahir, nomor_telepon, email, kota, alamat, kode_pos, catatan){
    		this.pelanggan.id = id
    		this.pelanggan.kode_pelanggan = kode_pelanggan
    		this.pelanggan.nama_pelanggan = nama_pelanggan
    		this.pelanggan.jenis_kelamin = jenis_kelamin
    		this.pelanggan.tanggal_lahir = tanggal_lahir
    		this.pelanggan.nomor_telepon = nomor_telepon
    		this.pelanggan.email = email
    		this.pelanggan.kota = kota
    		this.pelanggan.alamat = alamat
    		this.pelanggan.kode_pos = kode_pos
    		this.pelanggan.catatan = catatan
    		this.disable = 1
    		this.edit = 1
    		this.formPelanggan = 1
    	},
    	editPelanggan(){
    		this.disable = 2
    		this.edit = 0
    		// this.pelanggan.id = id
    	},

    	getPelanggans(page) {
    		var app = this;
    		if (typeof page === 'undefined') {
    			page = 1;
    		}
    		axios.get(app.url+'/view?page='+page)
    		.then(function (resp) {
    			app.loading = false
    			app.pelanggans = resp.data.data;
    			app.pelanggansData = resp.data

    		})
    		.catch(function (resp) {
    			alert("Could not load pelanggans");
    		});
    	},
    	getHasilPencarian(page){
    		var app = this;
    		app.loading = true;
    		if (typeof page === 'undefined') {
    			page = 1;
    		}
    		axios.get(app.url+'/pencarian?search='+app.search+'&page='+page)
    		.then(function (resp) {
    			app.loading = false
    			app.pelanggans = resp.data.data;
    			app.pelanggansData = resp.data;
    		})
    		.catch(function (resp) {
    			console.log(resp);
    			app.loading = false
    			alert("Could not load pelanggans");
    		});
    	},

    	saveForm() {
    		var app = this;
    		var Pelanggan = app.pelanggan;
    		axios.post(app.url, Pelanggan)
    		.then(function (resp) {
    			app.alert();

    			app.getPelanggans();
    			app.pelanggan.kode_pelanggan = ''
    			app.pelanggan.nama_pelanggan = ''
    			app.pelanggan.jenis_kelamin = ''
    			app.pelanggan.tanggal_lahir = ''
    			app.pelanggan.nomor_telepon = ''
    			app.pelanggan.email = ''
    			app.pelanggan.kota = ''
    			app.pelanggan.alamat = ''
    			app.pelanggan.kode_pos = ''
    			app.pelanggan.catatan = ''
    			app.disable = 1
    			app.edit = 0
    			app.$router.replace('/pelanggan');

    		})
    		.catch(function (resp) {
    			app.errors = resp.response.data.errors;
    		});
    	},
    	alert() {
    		this.$swal({
    			title: "Berhasil!",
    			text: "Berhasil Menambahkan Pelanggan",
    			icon: "success",
    		});
    	},

    	saveFormEdit() {
    		var app = this;
    		var newPelanggan = app.pelanggan;
    		axios.patch(app.url+'/' + app.pelanggan.id, newPelanggan)
    		.then(function (resp) {
    			app.message = 'Berhasil Merubah Pelanggan "'+app.pelanggan.nama_pelanggan+'"'
    			app.alertt(app.message);
    			app.getPelanggans();
    			app.pelanggan.kode_pelanggan = ''
    			app.pelanggan.nama_pelanggan = ''
    			app.pelanggan.jenis_kelamin = ''
    			app.pelanggan.tanggal_lahir = ''
    			app.pelanggan.nomor_telepon = ''
    			app.pelanggan.email = ''
    			app.pelanggan.kota = ''
    			app.pelanggan.alamat = ''
    			app.pelanggan.kode_pos = ''
    			app.pelanggan.catatan = ''
    			app.$router.replace('/pelanggan');
    			app.disable = 1

    		})
    		.catch(function (resp) {
    			app.errors = resp.response.data.errors;
    		});
    	},
    	alertt(pesanEdit) {
    		this.$swal({
    			title: "Berhasil!",
    			text: pesanEdit,
    			icon: "success",
    		});
    	},

    	deleteEntry() {
    		swal({
    			title: "Konfirmasi Hapus",
    			text : "Anda Yakin Ingin Menghapus " + this.pelanggan.nama_pelanggan +" ?",
    			icon : "warning",
    			buttons: true,
    			dangerMode: true,
    		})
    		.then((willDelete) => {
    			if (willDelete) {
    				var app = this;
    				axios.delete(app.url+'/' + app.pelanggan.id)
    				.then(function (resp) {
    					app.getPelanggans();
    					swal("Pelanggan Berhasil Dihapus!  ", {
    						icon: "success",
    					});
    				})
    				.catch(function (resp) {
    					app.$router.replace('/pelanggan/');
    					swal("Gagal Menghapus Pelanggan!", {
    						icon: "warning",
    					});
    				});
    			}
    			this.pelanggan.kode_pelanggan = ''
    			this.pelanggan.nama_pelanggan = ''
    			this.pelanggan.jenis_kelamin = ''
    			this.pelanggan.tanggal_lahir = ''
    			this.pelanggan.nomor_telepon = ''
    			this.pelanggan.email = ''
    			this.pelanggan.kota = ''
    			this.pelanggan.alamat = ''
    			this.pelanggan.kode_pos = ''
    			this.pelanggan.catatan = ''
    			this.disable = 1
    			this.$router.replace('/pelanggan/');
    		});
    	},
    }
}
</script>

