<style scoped>
#box1{
	background-color: black;
	border-radius: 5px;
	height: 90px;
	color: red;
	padding: 15px;	
	border:solid 5px #DDDDDD;
	box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);

}
.cart-item {

	overflow: auto;
}
#pull-right{
	float:right;

}
#pull-left{
	float:left;

}
.button2:hover {background-color: #424EF7;}

.button3{
	background-color: black;
	color: white;
	border-radius:10px;
	width: 130px;
	height:60px;
	left: 20px;
	box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
.button3:hover {background-color: #424EF7;}

.button4 {
	background-color: green;
	color: white;
	border-radius:10px;
	width: 128px;
	height:60px;
	left:30px;
	box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}

.button4:hover {background-color: #424EF7;}

.button5{
	background-color: white;
	color: black;
	border: 1px solid #e7e7e7;
	border-radius: 5px;
	width:50px;
	height:30px;

}

.button5:hover {background-color: red;}
.buttonp{
	background-color: #31C2E5;
	color: black;
	border: 1px solid #e7e7e7;
	border-radius: 5px;
	width:200px;
	height:50px;
	padding:10px;
	margin: 10px;

}

.buttonp:hover {background-color:#31C2E3;}

/*.button6{
	background-color: white;
	color: black;
	border: 1px solid #e7e7e7;
	border-radius: 1px;
	width:200px;
	height:20px;

}

.button6:hover {background-color: red;}*/
#pencarian{
	position: relative;
	width: 360px;
	height: 40px;
	background-color: #F5F5F5;
	border: solid 1px #CCCCCC;

}
.table{
	overflow: scroll;
}
.body{
	float: right;
	width: 65%;
	height: 90px;
	box-shadow:2px 3px black;
	box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
.produk{
	background-color: #449D44;
	width: 100px;
	height: 50px;
	border-radius: 4px;
	text-align: center;
	float: right;
	border:solid 1px #F7FBFF;
	
}
#digital{
	background-color: black;
	border-radius: 3px;
	color:red;
	border:4px solid #F5F5F5;
}
.button1{
	background-color: black;
	color: white;
	border-radius:10px;
	width: 114px;
	height:60px;
	left: 10px;
	box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
	font-size: 15px;
}
.button1:hover {background-color: #424EF7;}

.button2{
	background-color: black;
	color: white;
	border-radius:10px;
	width: 114px;
	height:60px;
	left: 10px;
	box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
	font-size: 15px;
}
.button2:hover {background-color: #424EF7;}

.button3 {
	background-color: green;
	color: white;
	border-radius:10px;
	width: 114px;
	height:60px;
	left:30px;
	box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
	font-size: 15px;
}

.button3:hover {background-color: #424EF7;}

#tbs{
	height: 250px;
	overflow: auto;
}
#digital{
	box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
#kategori_shadow{
	box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
#modalPembayaran{
	width: 400px;
	height: 400px;
	border-radius:0px;
	color:#5E5E5E;
	display:block;
}
.splice{
	border-radius: 100%;
	background-color: red;
	width:25px;
	height:25px;
}
</style>

<template>
	<div class="container">

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

		<!-- Modal Pembayaran -->
		<div id="modalBayar" class="modal fade" role="dialog" tabindex="-1">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h3>Pembayaran</h3>
					</div>
					<div class="modal-body" id="modalPembayaran">
						<form v-on:submit.prevent="saveForm()" class="form-horizontal">
							<table>
								<tbody>
									<tr>
										<td><h2>Total</h2></td>
										<td><h2 style="width:40px;">:</h2></td>
										<td>
											<h2>{{ new Intl.NumberFormat().format(jumlahBayar) }}</h2>
										</td>
									</tr>
									<tr>
										<td>Total Item</td>
										<td style="40px;">:</td>
										<td>{{ tbs_penjualans.length }}</td>
									</tr>
								</tbody>
							</table>
							<div class="form-group">
								<label class="col-md-4 control-label">Tunai</label>
								<div class="col-md-6">
									<money class="form-control" style="width:400px;height:35px;" required autocomplete="off" placeholder="Jumlah" v-model="pembayaran.bayar" v-bind="money" name="bayar"  autofocus=""></money>
								</div>
							</div>
							<!-- v-model="pembayaran.bayar" -->
							<!-- style="width:400px;height:35px;"  -->
							<tr>
								<td>
									<h3>Kembalian</h3>
								</td>
								<td style="width:40px;">:</td>
								<td>{{ new Intl.NumberFormat().format(pembayaran.kembalian) }}</td>
							</tr>

							<hr style="width:550px;align:center;">

							<div class="form-group">
								<label class="col-md-4 control-label">Status Pesanan</label>
								<div class="col-md-6">
									<selectize-component>
										<option>Dine In</option>
										<option>Take Away</option>
										<option>Delivery</option>
									</selectize-component>	
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-4 control-label">Keterangan</label>
								<div class="col-md-6 keterangan">
									<textarea style="width:400px;"  v-model="penjualan.keterangan"></textarea>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-4 control-label">Pelanggan</label>
								<div class="col-md-6">
									<selectize-component v-model="penjualan.nama_pelanggan" :settings="setting_pelanggan"> 
										<option v-for="pelanggan in pelanggans" v-bind:value="pelanggan.id" >{{ pelanggan.nama_pelanggan }}</option>
									</selectize-component>
								</div>
							</div>

						</form>
					</div>
					<div class="modal-footer">
						<button class="btn btn-primary" type="button" data-dismiss="modal"v-on:click="saveForm()">Bayar</button>
						<button type="button" class="btn btn-default" data-dismiss="modal" >Tutup</button> 
					</div>
				</div>
			</div>
		</div>
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

	</style>
	<template>
		<div class="container">
			<!-- Button buka penjualan -->
			<tr>
				<td>Penjualan</td>|
				<td><a style="color:red;" href="#">Buka Penjualan</a></td>
			</tr>
			<!-- Modal Pembayaran -->
			<div id="modalBayar" class="modal fade" role="dialog" tabindex="-1">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h3>Pembayaran</h3>
						</div>
						<div class="modal-body" id="modalPembayaran">
							<form class="form-horizontal">
								<h2>Total Transaksi</h2>
								<tr>
									<td><b>Total Pembelian</b></td>
									<td align="center"> :</td>
								</tr>
								<div class="form-group">
									<label class="col-md-4 control-label">Tunai</label>
									<div class="col-md-6">
										<input style="width:400px;height:35px;" required autocomplete="off"  type="text" name="modalBayar"  autofocus="" class="form-control">
									</div>
								</div>

								<label class="col-md-2 control-label"><h3>Kembalian:</h3></label>

								<hr style="width:550px;align:center;">

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
			<div class="panel panel-default" id="kategori_shadow">
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

								<div class="form-group">
									<label class="col-md-4 control-label">Keterangan</label>
									<div class="col-md-6 keterangan">
										<textarea style="width:400px;"></textarea>
									</div>
								</div>

					
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

							</form>
						</div>
						<div class="modal-footer">
							<button class="btn btn-primary" type="button" data-dismiss="modal">Bayar</button>
							<button type="button" class="btn btn-default" data-dismiss="modal" >Tutup</button> 
						</div>
					</div>
				</div>
			</div>

			<!-- Modal Diskon Perfaktur -->

			<div id="modalDiskonPerfaktur" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<!-- <h4 class="modal-title">Diskon Penjualan Per Faktur</h4> -->
							<button class="btn btn-default" v-on:click="diskonFakturPersen">Diskon %</button>
							<button class="btn btn-default" v-on:click="diskonFakturRp">Diskon Rp</button>

		<div class="col-md-4" id="pull-left">
			
			<div class="panel panel-default" id="digital">
				<div class="panel-body">
					<div>
						<h3 style="float:right;padding:10px;font-family: 'Orbitron', sans-serif;" v-if="tbs_penjualans.total_bayar != undefined" class="total-bayar" v-model="jumlahBayar">{{ new Intl.NumberFormat().format(jumlahBayar) }}</h3>
						<h3 style="float:right;padding:10px;font-family: 'Orbitron', sans-serif;" v-else class="total-bayar"></h3>
					</div>
					<div id="digital2">
						<tr>
							<td>Sub Total </td>
							<td>:</td>
							<td align="right">{{ new Intl.NumberFormat().format(tbs_penjualans.total_bayar) }}</td>
						</tr>
						<tr>
							<td>Diskon</td>
							<td>:</td>
							<td align="right" >{{diskonPerfaktur.persen}} %</td>
						</tr>
						<tr>
							<td>Diskon</td>
							<td>:</td>
							<td align="right" >Rp. {{diskonPerfaktur.rupiah}}</td>
						</tr>
						<tr>
							<td>Pajak</td>
							<td>:</td>
							<td align="right">2,2%</td>
						</tr>
					</div>

				</div>
			</div>


			
			<div class="panel panel-default">
				<div class="panel-heading"></div>
				<div class="panel-body">

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

					<div class="table-responsive" id="tbs">
						<table class="table table-striped table-hover">
							<!-- <thead>
								<th>Barang</th>
								<th>Jml</th>
								<th>Total</th>
							</thead> -->
							<tbody v-if="tbs_penjualans.length > 0 && loadingTbs == false" class="data-ada">
								<tr v-for="tbs_penjualan, index in tbs_penjualans">
									<td>{{ tbs_penjualan.nama_produk}} <br>
										<a href="#modalDiskonPenjualanPerProduk" data-toggle="modal">@{{ new Intl.NumberFormat().format(tbs_penjualan.harga_produk) }}</a></td>
										<td>{{ tbs_penjualan.jumlah_produk }}</td>
										<td>{{ tbs_penjualan.subtotal }}</td>

										<td>
											<button class="fa fa-times fa-1x splice" v-on:click="deleteTbsPenjualan(tbs_penjualan.id_tbs_penjualan)" type="button">
											</button>
										</td>
									</tr>
								</tbody>
								<tbody v-else-if="loadingTbs == true" class="text-center">
									<li>Sedang Memuat Produk</li>
								</tbody>
								<tbody v-else class="text-center">
									Tidak Ada Produk
								</tbody>
							</table>
						</div>
					</div>
					<vue-simple-spinner v-if="loadingTbs"></vue-simple-spinner>
				</div>
				<button class="button button2">Simpan</button>
				<button class="button button1" data-toggle="modal" data-target="#modalDiskonPenjualan">Diskon</button>
				<button class="button button3" data-target="#modalBayar" data-toggle="modal">Bayar</button>
			</div>

			<table class="table">
				<thead>
					<th>Barang</th>
					<th></th>
					<th>Total</th>
				</thead>
				<tbody>
					<tr>
						<td>Es cream cappucino
							<br>
							<a href="#">@.10.000</a>
							<br>
							Es cream cappucino
							<br>
							<a href="#">@.10.000</a>
							<br>
						</td>
						<td>
							<button class="button button5">10</button><br><br>
							<button class="button button5">10</button><br><br>
						</td>
						<td><br>100.000.00 <br>
							<br>100.000.00 <br>
						</td>

					</tr>
				</tbody>
			</table>
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
				price:1,
				money: {
					decimal: ',',
					thousands: '.',
					precision: 0,
					masked: false
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

		diskonFakturRp(){
			this.diskonPerFakturPersen = 0
			this.diskonPerFakturRp = 1
		},
		diskonFakturPersen(){
			this.diskonPerFakturPersen = 1
			this.diskonPerFakturRp = 0
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
	}
}
</script>
