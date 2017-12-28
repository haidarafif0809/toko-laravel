<style scoped>
.margin-atas {
	margin-top: 5px;
}
.shadow {
	box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
</style>
<template>
	<div class="container">
		<ol class="breadcrumb">
			<li><router-link :to="{name: 'indexDashboard'}" >Dashboard</router-link></li>
			<li><router-link :to="{name: 'indexProduk'}" >Produk</router-link></li>
			<li class="active" >Tambah Produk</li>    
		</ol>
		<div class="panel panel-default">
			<div class="panel-heading">Tambah Produk</div>
			<div class="panel-body">

				<form v-on:submit.prevent="saveForm()" class="form-horizontal"> 
					<div class="form-group">
						<label for="kode_produk" class="col-md-2 control-label">Kode Produk</label>
						<div class="col-md-4">
							<input class="form-control" required autocomplete="off" placeholder="Kode Produk" type="text" v-model="produk.kode_produk" name="kode_produk"  autofocus="">
							<span v-if="errors.kode_produk" class="label label-danger">{{ errors.kode_produk[0] }}</span>

						</div>
					</div> 
					<div class="form-group">
						<label for="nama_produk" class="col-md-2 control-label">Nama</label>
						<div class="col-md-4">
							<input class="form-control" required autocomplete="off" placeholder="Nama produk" type="text" v-model="produk.nama_produk" name="nama_produk"  autofocus="">
							<span v-if="errors.nama_produk" class="label label-danger">{{ errors.nama_produk[0] }}</span>

						</div>
					</div> 
					<div class="form-group">
						<label for="kategori_produks_id" class="col-md-2 control-label">Kategori Produk</label>
						<div class="col-md-4">
							<table width="100%">
								<tbody>
									<tr>
										<td width="80%" style="vertical-align: middle;">
											<selectize-component v-model="produk.kategori_produks_id" :settings="setting_kategori_produk"> 
												<option v-for="kategori_produk in kategori_produks_id" v-bind:value="kategori_produk.id" >{{ kategori_produk.nama_kategori_produk }}</option>
											</selectize-component> 
										</td>
										<td width="20%" style="vertical-align: top; text-align: center;">
											<span @click="tambahKategori()" class="glyphicon glyphicon-plus btn btn-sm btn-default">Tambah</span>	
										</td>
									</tr>
								</tbody>
							</table>


							<span v-if="errors.kategori_produks_id" class="label label-danger">{{ errors.kategori_produks_id[0] }}</span>

						</div>
					</div>
					<div class="form-group">
						<label for="harga" class="col-md-2 control-label">Harga Beli</label>
						<div class="col-md-2">
							<input class="form-control" required autocomplete="off" placeholder="Harga Beli" type="text" v-model="produk.harga_beli" name="harga_beli"  autofocus="">
							<span v-if="errors.harga_beli" class="label label-danger">{{ errors.harga_beli[0] }}</span>

						</div>
					</div>
					<div class="form-group">
						<label for="harga" class="col-md-2 control-label">Harga Jual</label>
						<div class="col-md-2">
							<input class="form-control" required autocomplete="off" placeholder="Harga Jual" type="text" v-model="produk.harga_jual" name="harga_jual"  autofocus="">
							<span v-if="errors.harga_jual" class="label label-danger">{{ errors.harga_jual[0] }}</span>

						</div>
					</div> 
					<div class="form-group">
						<label for="status_jual" class="col-md-2 control-label">Bisa Dijual</label>
						<div class="col-md-4 margin-atas">
							<div class="col-md-6">
								<label>
									<input type="radio" name="status_jual" v-model="produk.status_jual" value="1"> Ya
								</label>
							</div>
							<div class="col-md-6">
								<label>
									<input type="radio" name="status_jual" v-model="produk.status_jual" value="0"> Tidak
								</label>
								<span v-if="errors.status_jual" class="label label-danger">{{ errors.status_jual[0] }}</span>
							</div>
						</div>
					</div> 
					<div v-if="produk.foto != ''" class="form-group">
						<label for="pratinjau_foto_produk" class="col-md-2 control-label">Pratinjau Foto</label>
						<div v-if="produk.foto != null" class="col-md-4">
							<img :src="produk.foto" class="img-responsive thumbnail shadow">
						</div>
						<div v-else class="col-md-4">
							<img :src="broken_file" title="File yang Anda masukkan tidak didukung" class="img-responsive thumbnail shadow">
						</div>
					</div>
					<div class="form-group">
						<label for="foto" class="col-md-2 control-label">Foto</label>
						<div class="col-md-4">
							<input class="form-control" type="file" name="foto" v-on:change="onFileChange">
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-4 col-md-offset-2">
							<button class="btn btn-primary" id="btnSimpanproduk" type="submit">Submit</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</template>
<script>
export default {
	data: function () {
		return {
			errors: [],
			kategori_produks_id: [],
			url : window.location.origin + (window.location.pathname).replace("home", "produk"),
			url_foto_produk: window.location.origin + (window.location.pathname).replace("home", "foto_produk"),
			broken_file : window.location.origin + (window.location.pathname).replace("home", "broken-image.png"),
			url_newKategoriProduk : window.location.origin+(window.location.pathname).replace("home", "kategoriProduk"),
			produk: {
				kode_produk: '',		
				nama_produk: '',
				harga_jual: '',
				harga_beli: '',
				satuans_id: '',
				kategori_produks_id: '',
				status_jual: '',
				foto: ''
			},
			newKategoriProduk: {
				nama_kategori_produk: ''
			},
			message : '',
			setting_satuan: {
				placeholder: 'Pilih Satuan'
			},
			setting_kategori_produk: {
				placeholder: 'Pilih Kategori Produk',
			},
		}
	},
	mounted() {
		var app = this;
		app.selectedKategoriProduksId();

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
			let foto = this;
			let ekstensiOk = /(\.jpg|\.jpeg|\.png)/i;
			console.log(file);

			if(!file.name.match(ekstensiOk)) {
				foto.produk.foto = null;
				this.$swal({
					title: "File tidak didukung!",
					text: "Tolong pilih file gambar dengan format .jpg, .jpeg, atau .png.",
					icon: "warning",
					buttons: "Saya mengerti",
				});
			}
			else {
				reader.onload = (e) => {
					foto.produk.foto = e.target.result;
				};
			}
			reader.readAsDataURL(file);
		},
		saveForm() {
			var app = this;
			var newProduk = app.produk;
			console.log(newProduk);
			axios.post(app.url, newProduk)
			.then(function (resp) {
				app.message = 'Sukses : Berhasil Menambah produk '+ app.produk.nama_produk;
				app.alert(app.message);
				app.produk.kode_produk = '';
				app.produk.nama_produk = '';
				app.produk.harga_jual = '';
				app.produk.harga_beli = '';
				app.produk.kategori_produks_id = '';
				app.produk.status_jual = '';
				app.produk.foto = '';
				app.errors = '';
				app.$router.replace('/produk');

			})
			.catch(function (resp) {
				app.success = false;
				app.errors = resp.response.data.errors;
			});
		},
		selectedKategoriProduksId() {
			var app = this;
			axios.get(app.url+'/kategori_produks_id')
			.then(function (resp) {
				app.kategori_produks_id = resp.data;
			})
			.catch(function (resp) {
				alert("Could not load kategori produk");
			});
		},
		tambahKategori() {
			var app = this;
			swal({
				text: 'Masukkan nama kategori baru',
				content: "input",
				button: {
					text: "Buat",
					closeModal: false,
				},
			})
			.then(name => {
				if (!name) throw null;
				app.newKategoriProduk.nama_kategori_produk = name;
				var newNamaKategori = app.newKategoriProduk;

				axios.post(app.url_newKategoriProduk, newNamaKategori)
				.then(function (resp) {
					app.selectedKategoriProduksId();	
					swal({
						title: "Berhasil!",
						text: 'Berhasil menambahkan "'+ name +'" ke kategori produk.',
						icon: 'success',
					});
				})
				.catch(function (resp) {
					console.log()
					swal({
						title: "Berhasil!",
						text: 'Berhasil menambahkan "'+ name +'" ke kategori produk.',
						icon: 'warning',
					});
				});

			})
			.catch(err => {
				if (err) {
					swal("Oh noes!", "The AJAX request failed!", "error");
				} else {
					swal.stopLoading();
					swal.close();
				}
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
