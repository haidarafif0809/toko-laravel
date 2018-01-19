<style scoped>
.kategori {
	color: red;
	font-weight: bold;
	text-align: center;
}
.cart-item {
	max-height: 170px;
	overflow-y: scroll;
}
#pull-right{
	float:right;
}
#pull-left{
	float:left;
}

.bayar{
	padding: 30px 20px;
	font-size: 35px;
}

.tombol{
	padding: 10px 20px;
	font-size: 15px;
}
.button{
	padding: 5px 15px;
	font-size: 10px;
}
.tombolBayar{
	padding: 10px 20px;
	font-size: 15px;
	width: 40%;
}

.tabInformasi{
	width: 50%;
}
#box{
	border:1px solid #F0F0F0;
	background-color:#F5F8FA;
	border-radius: 3px;
}
#box2{
	border:1px solid #F0F0F0;
}
.total-bayar{
	color: red;
	font-weight: bold;
	text-align: center;
}

</style>

<template>
	<div class="container">
		<!-- MODAL INPUT JUMLAH PRODUK -->
		<div id="modalJumlahProduk" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						Jumlah Produk
					</div>
					<div class="modal-body">
						<form class="form-horizontal">
							<input class="form-control" required autocomplete="off"  type="number" name="jumlahProduk"  autofocus="" v-model="dataTbs.jumlah">
						</form>
					</div>
					<div class="modal-footer">
						<button class="btn btn-primary" type="button" data-dismiss="modal" v-on:click="simpanJumlahProduk(dataTbs.jumlah)" >Simpan</button>
						<button type="button" class="btn btn-default" data-dismiss="modal" >Tutup</button> 
					</div>
				</div>
			</div>
		</div>

		<!-- Modal untuk Diskon per faktur -->
		<div id="modalDiskonPenjualan" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<!-- <h4 class="modal-title">Diskon Penjualan Per Faktur</h4> -->
						<button class="btn btn-default" v-on:click="diskonPenjualanFakturPersen">Diskon %</button>
						<button class="btn btn-default" v-on:click="diskonPenjualanFakturRp">Diskon Rp</button>

					</div>
					<div class="modal-body">
						<form v-on:submit.prevent="" class="form-horizontal">
							<input class="form-control" required autocomplete="off" placeholder="%" type="number" name="diskon_per_Faktur"  autofocus="" v-if="diskonFaktur == 1"  v-model="formDiskon.persen">
							<input class="form-control" required autocomplete="off" placeholder="Rp" type="number" name="diskon_per_Faktur"  autofocus="" v-if="diskonFakturRp == 1" v-model="formDiskon.rupiah">
							<br>
						</form>
					</div>
					<div class="modal-footer">
						<button class="btn btn-primary" type="button" data-dismiss="modal" v-on:click="simpanDiskonPerFaktur()" >Simpan</button>
						<button type="button" class="btn btn-default" data-dismiss="modal" >Tutup</button> 
					</div>
				</div>
			</div>
		</div>

		<!-- Modal untuk Diskon per Produk-->
		<div id="modalDiskonPenjualanPerProduk" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<!-- <h4 class="modal-title">Diskon Penjualan</h4> -->
						<button class="btn btn-default" v-on:click="diskonPenjualanProdukPersen">Diskon %</button>
						<button class="btn btn-default" v-on:click="diskonPenjualanProdukRp">Diskon Rp</button>

					</div>
					<div class="modal-body">
						<form v-on:submit.prevent="importPelanggan()" class="form-horizontal">
							<input class="form-control" required autocomplete="off" placeholder="%" type="number" name="diskon_per_produk"  autofocus="" v-if="diskonProduk == 1">
							<input class="form-control" required autocomplete="off" placeholder="Rp" type="number" name="diskon_per_produk"  autofocus="" v-if="diskonProdukRp == 1">
							<br>
						</form>
					</div>
					<div class="modal-footer">
						<input class="btn btn-primary" type="submit" value="Simpan">
						<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-8" id="pull-right">
			<div class="panel panel-default">
				<!-- KATEGORI PRODUK -->
				<div class="panel-heading">KATEGORI PRODUK</div>
				<div class="panel-body">
					<div class="row">
						<div v-if="kategori_produks.length > 0 && loading == false" class="data-ada">	
							<div class="col-md-12">
								<div v-if="kategori_produks.length == 1">
									<div v-for="kategori_produk , index in kategori_produks">
										<div class=" btn btn-success col-md-3 list-produk">
											<div class="caption"  @click="submitTbsPenjualan(produk)">
												<h4 v-if="kategori_produk.id.length > 15">
													<center>{{kategori_produk.nama_kategori_produk.slice(0, 15)}}...</center>
												</h4>
												<h4 v-else>
													<center>{{kategori_produk.nama_kategori_produk}}</center>
												</h4>
											</div>
										</div>
									</div>
								</div>
								<div v-else>
									<div v-for="kategori_produk , index in kategori_produks" >
										<div class=" btn btn-success col-md-3 list-produk">
											<div class="caption"  @click="submitTbsPenjualan(produk)">
												<h4 class="kategori" v-if="kategori_produk.nama_kategori_produk.length > 15">
													<center>{{kategori_produk.nama_kategori_produk.slice(0, 15)}}...</center>
												</h4>
												<h4 v-else>
													<center>{{kategori_produk.nama_kategori_produk}}</center>
												</h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<br>

					<!-- PRODUK PENJUALAN -->
					<div class="row">
						<div v-if="produksPenjualan.length > 0 && loading == false" class="data-ada">	
							<div class="col-md-12">
								<div v-if="produksPenjualan.length == 1">
									<div v-for="produksPenjualans , index in produksPenjualan" class="col-md-4 list-produk">
										<div class="thumbnail">
											<div class="caption"  @click="submitTbsPenjualan(produksPenjualans)">
												<h4 v-if="produksPenjualans.data_produk.nama_produk.length > 15">
													{{produksPenjualans.data_produk.nama_produk.slice(0, 15)}}...
												</h4>
												<h4 v-else>
													{{produksPenjualans.data_produk.nama_produk}}
												</h4>
												<p>Harga: {{produksPenjualans.data_produk.harga_jual}}</p>
											</div>
										</div>
									</div>
								</div>
								<div v-else>
									<div v-for="produksPenjualans , index in produksPenjualan" class="col-md-4 list-produk">
										<div class="thumbnail">
											<div class="caption"  @click="submitTbsPenjualan(produksPenjualans)">
												<h4 v-if="produksPenjualans.data_produk.nama_produk.length > 15">
													{{produksPenjualans.data_produk.nama_produk.slice(0, 15)}}...
												</h4>
												<h4 v-else>
													{{produksPenjualans.data_produk.nama_produk}}
												</h4>
												<p>Harga: {{produksPenjualans.data_produk.harga_jual}}</p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<vue-simple-spinner v-if="loading"></vue-simple-spinner>

				<div align="right">
					<pagination :data="dataProduksPenjualan" v-on:pagination-change-page="getProduksPenjualan" :limit="3"></pagination>
				</div>
				<div align="right">
				</div>
			</div>
		</div>

		<div class="col-md-4" id="pull-left">
			<div class="panel panel-default">
				<!-- PENCARIAN PRODUK PENJUALAN -->
				<div class="row">
					<div class="col-md-12 pencarian">
						<div class="input-group">
							<input type="text" class="form-control" name="search" placeholder="Pencarian Produk"  v-model="search" >
							<div class="input-group-addon">
								<i class="fa fa-search" aria-hidden="true"></i>
							</div>
						</div>
					</div>
				</div>
				<!-- PESANAN/ITEM PENJUALAN -->
				<div class="panel-heading">Pesanan</div>
				<ul class="list-group cart-item">
					<!-- <li class="list-group-item list-group-item-warning">Tidak ada item</li> -->
					<div v-if="tbs_penjualans.length > 0 && loadingTbs == false" class="data-ada">	
						<li class="list-group-item" track-by="id" v-for="tbs_penjualan, index in tbs_penjualans">
							<div>
								<span class="large" v-if="tbs_penjualan.nama_produk.length > 15">
									{{ tbs_penjualan.nama_produk.slice(0, 15) }}... <br>
									<button class="btn btn-xs btn-danger btn-floating" type="button" data-id="id_tbs_penjualan">
										<span data-toggle="modal" data-target="#modalDiskonPenjualanPerProduk">
											<i class="fa fa-percent" aria-hidden="true"></i>
										</span>
									</button>
								</span>
								<span class="large" v-else>
									{{ tbs_penjualan.nama_produk}}<br>
									<button class="btn btn-xs btn-danger btn-floating" type="button" data-id="id_tbs_penjualan">
										<span data-toggle="modal" data-target="#modalDiskonPenjualanPerProduk">
											<i class="fa fa-percent" aria-hidden="true"></i>
										</span>
									</button>
									test
								</span>
								<span class="large" style="float: right;">					
									( {{ tbs_penjualan.harga_produk }} X 
									<span @click="getDataTbs(tbs_penjualan.id_tbs_penjualan, tbs_penjualan.subtotal, tbs_penjualan.harga_produk, tbs_penjualan.jumlah_produk)" class="btn btn-default button" data-toggle="modal" data-target="#modalJumlahProduk">
										{{ tbs_penjualan.jumlah_produk }} 
									</span> )
									: <b>{{ tbs_penjualan.subtotal }}</b> 
									<button v-on:click="deleteTbsPenjualan(tbs_penjualan.id_tbs_penjualan)" type="button" class="btn btn-xs btn-danger btn-floating">
										<i class="fa fa-trash-o" aria-hidden="true"></i>
									</button>
								</span>
							</div>
						</li>
					</div>
					<div v-else-if="loadingTbs == true" class="text-center">
						<li>Sedang Memuat Produk</li>
					</div>
					<div v-else class="list-group-item list-group-item-warning">
						Tidak Ada Produk
					</div>
					<vue-simple-spinner v-if="loadingTbs"></vue-simple-spinner>
				</ul>
				<div class="panel-footer">
					Total Item: {{ tbs_penjualans.length }}
					<span class="pull-right">
						<!-- <i class="glyphicon glyphicon-refresh cart-item-action" v-on:click="clearCart()"></i> -->
					</span>
				</div>
			</div>

			<div class="panel panel-default">
				<div class="panel-body">
					<form v-on:submit.prevent="saveForm()" class="form-horizontal">
						<div class="form-group">
							<table>
								<tbody>
									<tr>
										<td>Sub Total </td>
										<td width="25%" align="center"> :</td>
										<td align="right">{{ tbs_penjualans.total_bayar }}</td>
									</tr>
									<tr>
										<td>Diskon</td>
										<td width="25%" align="center">:</td>
										<td align="right" >{{diskonPerfaktur.persen}} %</td>
									</tr>
									<tr>
										<td>Diskon</td>
										<td width="25%" align="center">:</td>
										<td align="right" >Rp. {{diskonPerfaktur.rupiah}}</td>
									</tr>
									<tr>
										<td>Pajak</td>
										<td width="25%" align="center">:</td>
										<td align="right">2,2%</td>
									</tr>
								</tbody>
							</table>
							<!-- <h6>Sub total  : {{ tbs_penjualans.total_bayar }} </h6>
							<h6>Diskon     : </h6>
							<h6>Pajak      :</h6> -->
							<div class="form-group">
								<div class="col-md-12">
									<label class="control-label">Total Bayar</label>
									<h1 v-if="tbs_penjualans.total_bayar != undefined" class="total-bayar" v-model="jumlahBayar">Rp. {{ jumlahBayar }}<hr></h1>
									<h1 v-else class="total-bayar"><hr></h1>
								</div>
							</div>
							
							<label class="control-label"> Nama Pelanggan:</label>
							<selectize-component v-model="penjualan.nama_pelanggan" :settings="setting_pelanggan"> 
								<option v-for="pelanggan in pelanggans" v-bind:value="pelanggan.id" >{{ pelanggan.nama_pelanggan }}</option>
							</selectize-component>
							<label>Cara Bayar : </label>
							<div>
								<ul class="nav nav-tabs">
									<li class="tabInformasi active">
										<a data-toggle="tab"  v-on:click="tunai"><font color="#000000">Tunai</font></a>
									</li>

									<li class="tabInformasi">
										<a data-toggle="tab"  v-on:click="kartu"><font color="#000000">Kartu</font></a>
									</li>
								</ul>								
							</div>
							<div v-if="formTunai == 1" v-model="penjualan.cara_bayar">
								<br>
								<div>
									<input type="number" class="form-control bayar" placeholder="PEMBAYARAN" v-model="pembayaran.bayar"> 
								</div>
								<div>
									<label class="control-label" font-size="50px"><h6><b>KEMBALIAN :</b></h6></label>
									<hr><h3><span>{{pembayaran.kembalian}}</span></h3><hr>
								</div>

							</div>
							<div v-if="formKartu == 1" v-model="penjualan.cara_bayar">
								<selectize-component  :settings="settingss"> 
									<option value="1"  >BNI</option>
									<option value="2"  >BRI</option>
									<option value="3"  >BCA</option>
								</selectize-component>
								<!-- <span v-if="errors.jenis_kelamin" class="label label-danger">{{ errors.jenis_kelamin[0] }}</span> -->
							</div>
							<div>
								<label class="control-label">Keterangan</label>
								<textarea class="form-control" v-model="penjualan.keterangan"></textarea>
							</div> 
							<br>
							<div>
								<button class="btn btn-success tombol">Simpan</button>

								<span class="btn btn-success tombol" data-toggle="modal" data-target="#modalDiskonPenjualan">
									Diskon
								</span>

								<!-- <button class="btn btn-success tombol">Diskon</button> -->
								<button class="btn btn-success tombolBayar">Bayar</button>
							</div>
							<br>
							<h2 class="form-control-static text-warning"></h2>
						</div>

						<div  class="form-group">
						</div>

						<div class="form-group">
						</div>

					</form>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	data: function () {
		return {
			formJumlahProduk: '',
			jumlahBayar: '',
			diskonPerfaktur: {
				persen: '',
				rupiah: '',
			},
			formDiskon: {
				persen: '',
				rupiah: '',
			},
			pembayaran:{
				bayar: '',
				kembalian: '',
			},
			kategori_produks: [],
			penjualan: {
				nama_pelanggan: '',
				cara_bayar: '',
				diskon: '',
				subtotal: '',
				total_bayar: '',
				keterangan: '',

			},
			pelanggans:[],
			produksPenjualan: [],
			tbs_penjualans: [],
			dataProduksPenjualan:{},
			inputTbsPenjualan: {
				satuan:'',
				produk_id:'',
				jumlah: '',
				harga:'',
				total_bayar: '',
			},
			deleteProdukTbsPenjualan: {
				produk_id: ''
			},
			dataTbs: {
				id: '',
				jumlah: '',
				subtotal: '',
				harga: ''
			},
			search: '',
			formTunai: 1,
			diskonProduk: 1,
			diskonProdukRp: 0,
			diskonFaktur: 1,
			diskonFakturRp: 0,
			formKartu: 0,
			url : window.location.origin + (window.location.pathname).replace("home", "penjualan"),
			urlTambahTbs : window.location.origin + (window.location.pathname).replace("home", "proses-tbs-penjualan"),
			urlUpdateTbs : window.location.origin + (window.location.pathname).replace("home", "update-tbs-penjualan"),
			urlHapusTbs : window.location.origin + (window.location.pathname).replace("home", "penjualan/hapus-tbs-penjualan"),
			loading : true,
			loadingTbs : true,

			setting_pelanggan:{
				placeholder: 'Pilih Pelanggan'
			},
			settingss:{
				placeholder: 'Pilih Bank'
			},
		}
	},
	mounted() {
		var app = this;
		app.loading = true
		app.loadingTbs = true
		app.getKategoriProduk();
		app.getProduksPenjualan();
		app.getTbsPenjualan();
		app.selectPelanggans();
	},

	watch: {
	    // whenever question changes, this function will run
	    search: function (newQuestion) {
	    	this.getHasilPencarian()
	    },
	    'pembayaran.bayar': function (newQuestion){
	    	this.getHasilKembalian()
	    }
	},
	methods: {
		getDataTbs(id, subtotal, harga, jumlah) {
			this.dataTbs.id = id;
			this.dataTbs.subtotal = subtotal;
			this.dataTbs.harga = harga;
			this.dataTbs.jumlah = jumlah;
		},
		getHasilKembalian(){
			var app = this;
			var kembalian = app.pembayaran.bayar - app.jumlahBayar

			if (app.pembayaran.bayar === 0 || app.pembayaran.bayar === '') {
				return app.pembayaran.kembalian = 0;
			}
			else {

				app.pembayaran.kembalian = kembalian;

			}
		},
		simpanDiskonPerFaktur(){
			var app = this;
			
			if(app.formDiskon.persen > 0 ){
				app.diskonPerfaktur.persen = app.formDiskon.persen;
				app.diskonPerfaktur.rupiah = (app.tbs_penjualans.total_bayar / 100) * app.formDiskon.persen;
			}
			else if(app.formDiskon.rupiah > 0 ){
				app.diskonPerfaktur.rupiah = app.formDiskon.rupiah;
				app.diskonPerfaktur.persen = (app.formDiskon.rupiah * 100) / app.tbs_penjualans.total_bayar;
			}
			else {
				app.diskonPerfaktur.persen = 0;
				app.diskonPerfaktur.rupiah = 0;
			}
			app.jumlahBayar = app.tbs_penjualans.total_bayar - app.diskonPerfaktur.rupiah;
			console.log(app.tbs_penjualans.total_bayar);
			$('#modalDiskonPenjualan').hide();
		},
		
		getKategoriProduk(page){
			var app = this;
			if (typeof page === 'undefined') {
				page = 1;
			}
			axios.get(app.url+'/kategori-produk')
			.then(function (resp) {
				app.loading = false;
				app.kategori_produks = resp.data;
			})
			.catch(function(resp) {
				alert("Could not load produksPenjualan");
				app.loading = false;
			});
		},
		getProduksPenjualan(page) {
			var app = this;
			if (typeof page === 'undefined') {
				page = 1;
			}

			axios.get(app.url+'/view?page='+page)
			.then(function (resp) {
				app.loading = false;
				app.produksPenjualan = resp.data.data;
				app.dataProduksPenjualan = resp.data;

			})
			.catch(function (resp) {
				alert("Could not load produksPenjualan");
				app.loading = false
			});
		},
		getTbsPenjualan() {
			var app = this;
			axios.get(app.url +'/tbs-penjualan')
			.then(function (resp) {
				if (resp.data.data != undefined) {

					app.tbs_penjualans = resp.data.data;
					app.tbs_penjualans.total_bayar = resp.data.total_bayar;
					app.jumlahBayar = resp.data.total_bayar;
					app.loadingTbs = false;
					console.log(resp);
				}
				app.loadingTbs = false;
				// else {
					
				// 	app.tbs_penjualans = resp.data;
				// 	app.loadingTbs = false;
				// }
				// app.tbs_penjualans.total_item = 
				
			})	
			.catch(function () {
				alert("Could not load tbs penjualan");
			});

		},

		selectPelanggans() {
			var app = this;
			axios.get(app.url+'/pelanggan')
			.then(function (resp) {
				app.pelanggans = resp.data;
			})
			.catch(function (resp) {
				alert("Could not load pelanggan");
			});
		},

		tunai(){
			this.formTunai = 1
			this.formKartu = 0
		},

		diskonPenjualanProdukPersen(){
			this.diskonProduk = 1
			this.diskonProdukRp = 0
		},

		diskonPenjualanProdukRp(){
			this.diskonProduk = 0
			this.diskonProdukRp = 1
		},

		diskonPenjualanFakturPersen(){
			this.diskonFaktur = 1
			this.diskonFakturRp = 0
		},

		diskonPenjualanFakturRp(){
			this.diskonFaktur = 0
			this.diskonFakturRp = 1
		},
		kartu(){
			this.formTunai = 0
			// this.formKartu = 1
			this.$swal({
				title: "GAGAL!",
				text: "Fitur ini sedang dalam pengembangan",
				icon: "warning",
			});
		},
		saveForm(){
			var app = this;
			app.penjualan.total_bayar = app.jumlahBayar;
			app.penjualan.subtotal = app.tbs_penjualans.total_bayar;
			app.penjualan.cara_bayar = 'Tunai';
			app.penjualan.diskon = app.diskonPerfaktur.rupiah;
			app.penjualan.keterangan = app.penjualan.keterangan;
			app.penjualan.pelanggan_id = app.penjualan.nama_pelanggan;
			var Penjualan = app.penjualan;
			console.log(app.penjualan.subtotal)
			axios.post(app.url, Penjualan)
			.then(function(resp){
				app.alert('berhasil');
				app.getKategoriProduk();
				app.getProduksPenjualan();
				app.getTbsPenjualan();
				app.selectPelanggans();
				app.tbs_penjualans = '';
				app.pelanggans = '';
				app.diskonPerfaktur.rupiah = '';
				app.diskonPerfaktur.persen = '';
				app.pembayaran.bayar = '';
				app.pembayaran.kembalian = 0;
				app.penjualan.keterangan = '';
				// app.getPenjualans();
			})
			.catch(function (resp) {
				app.alert('gagal')
			})

		},
		getHasilPencarian(page) {
			var app = this;
			app.loading = true;
			if (typeof page === 'undefined') {
				page = 1;
			}

			axios.get(app.url+'/pencarian?search='+app.search+'&page='+page)
			.then(function (resp) {
				app.loading = false    
				app.produksPenjualan = resp.data;
				app.dataProduksPenjualan = resp;
				console.log(resp.data);
			})
			.catch(function (resp) {
				alert("Tidak dapat memuat produk..");
				app.loading = false;
			});
		},
		submitTbsPenjualan(produksPenjualans){
			var app = this;
			app.inputTbsPenjualan.produk_id = produksPenjualans.data_produk.produk_id;
			app.inputTbsPenjualan.harga = produksPenjualans.data_produk.harga_jual;
			app.inputTbsPenjualan.satuan = produksPenjualans.data_produk.satuans_id;
			app.inputTbsPenjualan.jumlah = 1;
			var newTbs = app.inputTbsPenjualan;

			axios.post(app.urlTambahTbs, newTbs)
			.then(function (resp) {
				// app.message = 'Sukses : Berhasil Menambah "'+ produk.data_produk.nama_produk+'" ke Pemesanan';
				// app.alert(app.message);
				app.$router.replace('/penjualan');
				app.getTbsPenjualan();
				// app.$swal.close();
			})
			.catch(function (resp) {
				console.log(resp)

				app.success = false;
				app.errors = resp.response.data.errors;
			});
		},

		simpanJumlahProduk(jumlah){
			var app = this;
			var newJumlah = app.dataTbs;
			axios.post(app.urlUpdateTbs, newJumlah)
			.then(function (resp) {
				app.inputTbsPenjualan.jumlah = ''	
				app.$router.replace('/penjualan');
				app.getTbsPenjualan();
			})
			.catch(function (resp) {
				app.errors = resp.response.data.errors;
			});		
		},

		deleteTbsPenjualan(id_tbs_penjualan) {
			swal({
				title: "Hapus?", 
				text: "Yakin Ingin Menghapus ?", 
				type: "warning",
				showCancelButton: true,
				cancelButtonColor: '#3085d6',
				confirmButtonColor: '#d33',
				confirmButtonText: 'Hapus',
				cancelButtonText: 'Batal',
				reverseButtons: true
			})
			.then((result) => {
				if (result.value) {
					var app = this;
					axios.delete(app.urlHapusTbs+ '/'+id_tbs_penjualan)
					.then(function (resp) {
						app.getTbsPenjualan();
						swal({
							title: 'Berhasil!',
							type: 'success',
							text: 'Berhasil menghapus '
						});
						// app.$router.replace('/penjualan');
					})
					.catch(function (resp) {
						app.$router.replace('/penjualan');
						swal({
							title: 'Gagal!',
							type: 'warning',
							text: 'Tidak dapat menghapus produk!'
						})
					});
				}
				else {
					return;
				}
				this.tbs_penjualans = '',
				this.$router.replace('/penjualan');
			});
		},
	// deleteEntry(id, index,nama_produk) {
	// 	if (confirm("Yakin Ingin Menghapus produk "+nama_produk+" ?")) {
	// 		var app = this;
	// 		axios.delete(app.url+'/' + id)
	// 		.then(function (resp) {
	// 			app.getProduks();
	// 			app.alert("Berhasil Menghapus produk "+nama_produk)
	// 		})
	// 		.catch(function (resp) {
	// 			alert("Tidak dapat menghapus produk!");
	// 		});
	// 	}
	// },
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
