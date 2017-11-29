
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
						<label for="harga" class="col-md-2 control-label">Harga</label>
						<div class="col-md-2">
							<input class="form-control" required autocomplete="off" placeholder="Harga Beli" type="text" v-model="produk.harga_beli" name="harga_beli"  autofocus="">
							<span v-if="errors.harga_beli" class="label label-danger">{{ errors.harga_beli[0] }}</span>

						</div>
						<div class="col-md-2">
							<input class="form-control" required autocomplete="off" placeholder="Harga Jual" type="text" v-model="produk.harga_jual" name="harga_jual"  autofocus="">
							<span v-if="errors.harga_jual" class="label label-danger">{{ errors.harga_jual[0] }}</span>

						</div>
					</div> 
					<div class="form-group">
						<label for="satuans_id" class="col-md-2 control-label">Satuan</label>
						<div class="col-md-4">
							<selectize-component v-model="produk.satuans_id" :settings="settings"> 
								<option v-for="satuan in satuans" v-bind:value="satuan.id" >{{ satuan.nama_satuan }}</option>
							</selectize-component>
							<span v-if="errors.satuans_id" class="label label-danger">{{ errors.satuans_id[0] }}</span>

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
			satuans: [],
			url : window.location.origin + (window.location.pathname).replace("home", "produk"),
			produk: {
				kode_produk: '',		
				nama_produk: '',
				harga_jual: '',
				harga_beli: '',
				satuans_id: ''
			},
			message : '',
			settings: {
				placeholder: 'Pilih Satuan'
			}
		}
	},
	mounted() {
		var app = this;
		app.selected();

	},
	methods: {
		saveForm() {
			var app = this;
			var newProduk = app.produk;
			axios.post(app.url, newProduk)
			.then(function (resp) {
				app.message = 'Sukses : Berhasil Menambah produk '+ app.produk.nama_produk;
				app.alert(app.message);
				app.produk.kode_produk = '';
				app.produk.nama_produk = '';
				app.produk.harga_jual = '';
				app.produk.harga_beli = '';
				app.produk.satuans_id = '';
				app.errors = '';
				app.$router.replace('/produk');

			})
			.catch(function (resp) {
				app.success = false;
				app.errors = resp.response.data.errors;
			});
		},
		selected() {
			var app = this;
			axios.get(app.url+'/satuan')
			.then(function (resp) {
				app.satuans = resp.data;
			})
			.catch(function (resp) {
				alert("Could not load satuan");
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
