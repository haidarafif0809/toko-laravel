<template>
	<div class="container">
		<ol class="breadcrumb">
			<li><router-link :to="{name: 'indexDashboard'}">Home</router-link></li>
			<li class="active">Pelanggan</li>
		</ol>

		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">Filter Pelanggan</div>
			</div>
		</div>

		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-body">
					<div data-role="page">
						<div data-role="main" class="ui-content">
							<form method="post" action="/action_page_post.php">
								<div data-role="rangeslider">
									<label for="price-min">Price:</label>
									<input type="range" name="price-min" id="price-min" value="200" min="0" max="1000">
									<label for="price-max">Price:</label>
									<input type="range" name="price-max" id="price-max" value="800" min="0" max="1000">
								</div>
							</form>
						</div>
					</div> 
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="panel-body">
				<div class="panel panel-default">
					<div class="panel-heading">
						<button class="btn btn-success">import</button>
						<button class="btn btn-primary">unduh</button>
						<span><router-link :to="{name: 'createPelanggan'}" type="button" class="btn btn-primary">
						Tambah</router-link></span>
						<!-- <button class="btn btn-primary">tambah</button> -->
					</div>
					<ul class="list-group cart-item">
					</ul>
				</div>
			</div>

			<div class="panel-body">
				<div class="panel-default">
					<div class="panel-heading"> Menemukan : {{ pelanggans.length }} Pelanggan </div>
					<div v-for="pelanggan ,index in pelanggans">
						<div class="row">
							<div class="col-md-12 list-pelanggan">
								<div class="thumbnail">
									<font>{{pelanggan.nama_pelanggan}}</font>										

									<p>{{pelanggan.nomor_telepon}}</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-8">
			<div class="panel panel-default">
				<div class="panel-heading">INFORMASI PELANGGAN</div>
			</div>
			<div class="panel panel-default">
				<table border="3px">
					<th>  TENTANG PELANGGAN  </th>
					<th>  RIWAYAT TRANSAKSI  </th>
					<th>   PERILAKU    </th>
				</table>
			</div>

			<div class="panel panel-default">
				<div class="panel-body">
					<form >
						<div class="row">
							<div class="form-group">
								<label class="col-md-4">Kolom bertanda <font size="5px" color="red">*</font> wajib diisi.</label>
							</div>
						</div>

						<div class="row">
							<div class="form-group">
								<label for="kode_pelanggan" class="col-md-3 control-label">Kode<font size="5px" color="red">*</font></label>
								<div class="col-md-8">
									<input class="form-control" required autocomplete="off" placeholder="Kode Pelanggan" type="text" autofocus="">
								</div>
							</div>
						</div>

						<div class="row"> 
							<div class="form-group">
								<label class="col-md-3 control-label">Nama<font size="5px" color="red">*</font></label>
								<div class="col-md-8">
									<input class="form-control" required autocomplete="off" placeholder="Nama Pelanggan" type="text" autofocus="">
								</div>
							</div>
						</div>

						<div class="row">
							<div class="form-group">
								<label for="jenis_kelamin'" class="col-md-3 control-label">Jenis Kelamin <font size="5px" color="red">*</font></label>
								<div class="col-md-8">
									<selectize-component placeholder="jenis kelamin"> 
										<option value="1"  >laki-laki</option>
										<option value="2"  >perempuan</option>
									</selectize-component>
									<!-- <span v-if="errors.jenis_kelamin" class="label label-danger">{{ errors.jenis_kelamin[0] }}</span> -->
								</div>
							</div>
						</div>

						<div class="row">
							<div class="form-group">
								<label for="tanggal_lahir" class="col-md-3 control-label">Tanggal Lahir</label>
								<div class="col-md-8">
									<input class="form-control" autocomplete="off" placeholder="YYYY-MM-DD" type="date"  autofocus="">
									<!-- <span v-if="errors.tanggal_lahir" class="label label-danger">{{ errors.tanggal_lahir[0] }}</span> -->
								</div>
							</div>
						</div>

						<div class="row">
							<div class="form-group">
								<label for="nomor_telepon" class="col-md-3 control-label">Nomor Telepon <font size="5px" color="red">*</font></label>
								<div class="col-md-8">
									<input class="form-control" required autocomplete="off" placeholder="Nomor Telepon" type="number"autofocus="">
									<!-- <span v-if="errors.nomor_telepon" class="label label-danger">{{ errors.nomor_telepon[0] }}</span> -->
								</div>
							</div>
						</div>

						<div class="row">
							<div class="form-group">
								<label for="email" class="col-md-3 control-label">Email</label>
								<div class="col-md-8">
									<input class="form-control" autocomplete="off" placeholder="Email" type="email"  autofocus="">
									<!-- <span v-if="errors.email" id="email_error" class="label label-danger">{{ errors.email[0] }}</span> -->
								</div>
							</div>
						</div>

						<div class="row">
							<div class="form-group">
								<label for="kota" class="col-md-3 control-label">Kota</label>
								<div class="col-md-8">
									<input class="form-control" autocomplete="off" placeholder="Kota" type="text" autofocus="">
									<!-- <span v-if="errors.kota" id="email_error" class="label label-danger">{{ errors.kota[0] }}</span> -->
								</div>
							</div>
						</div>

						<div class="row">
							<div class="form-group">
								<label for="alamat" class="col-md-3 control-label">Alamat</label>
								<div class="col-md-8">
									<input class="form-control" autocomplete="off" placeholder="Alamat" type="text"  autofocus="">
									<!-- <span v-if="errors.alamat" class="label label-danger">{{ errors.alamat[0] }}</span> -->
								</div>
							</div>
						</div>

						<div class="row">
							<div class="form-group">
								<label for="kode_pos" class="col-md-3 control-label">Kode Pos</label>
								<div class="col-md-8">
									<input class="form-control" autocomplete="off" placeholder="Kode Pos" type="number"  autofocus="" >
									<!-- <span v-if="errors.kode_pos" id="email_error" class="label label-danger">{{ errors.kode_pos[0] }}</span> -->
								</div>
							</div>
						</div>

						<div class="row">
							<div class="form-group">
								<label for="email" class="col-md-3 control-label">Catatan</label>
								<div class="col-md-8">
									<textarea class="form-control" autocomplete="off" placeholder="Catatan" autofocus=""></textarea>
									<!-- <span v-if="errors.email" id="email_error" class="label label-danger">{{ errors.email[0] }}</span> -->
								</div>
							</div>
						</div>

						<div class="row">
							<div class="form-group">
								<div class="col-md-4 col-md-offset-2">
									<button class="btn btn-primary" id="btnSimpanPelanggan" type="submit">Submit</button>
								</div>
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
	data: function () {
		return {
			pelanggans: [],
			pelanggansData: {},
			url : window.location.origin+(window.location.pathname).replace("home","pelanggan"),
			search : '',
			loading : true

		}
	},
	mounted() {
		var app = this;
		app.loading = true
		app.getPelanggans();	

	},
	watch: {
        // whenever question changes, this function will run
        search: function (newQuestion) {
        	this.getHasilPencarian();  
        }
    },
    methods: {
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


    	deleteEntry(id, index,nama_pelanggan) {
    		swal({
    			title: "Konfirmasi Hapus",
    			text : "Anda Yakin Ingin Menghapus "+nama_pelanggan+" ?",
    			icon : "warning",
    			buttons: true,
    			dangerMode: true,
    		})
    		.then((willDelete) => {
    			if (willDelete) {
    				var app = this;
    				axios.delete(app.url+'/' + id)
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
    			this.$router.replace('/pelanggan/');
    		});
    	},
    }
}
</script>

