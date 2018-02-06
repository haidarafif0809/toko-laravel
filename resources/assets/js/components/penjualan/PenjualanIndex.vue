<style scoped>
.kategori {
	color: red;
	font-weight: bold;
	text-align: center;
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
#digital{
	background-color: black;
	border-radius: 3px;
	color:#FF0000;
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
/*	width: 400px;
height: 400px;*/
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
.trash{
	width: 45px;
	height: 25px;
	background-color: white;
	border-radius: 4px;
}
.trash:hover {background-color: red;}

#items{
	box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
.focus:focus{
	background-color: #EFF0F1;
}
.button5:focus{
	color: red;
}

.box-produk {
	height: 250px;
	width: 180px;
	/*background-color: powderblue;*/
}
.box-dalam-produk {
	height: 230px;
	width: 170px;
	/*background-color: powderblue;*/
}

</style>

<template>
	<div class="container">
		<!-- modal jumlah item -->
		<div id="modalJumlahItem" class="modal fade" role="dialog">
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
						<button class="btn btn-default" v-on:click="diskonPenjualanFakturPersen"
						onclick="document.getElementById('myInput').focus();return false;">Diskon %</button>
						<button onclick="document.getElementById('myInput2').focus();return false;" class="btn btn-default" v-on:click="diskonPenjualanFakturRp">Diskon Rp</button>

					</div>
					<div class="modal-body">
						<form v-on:submit.prevent="" class="form-horizontal">
							<input id="myInput" class="form-control" required autocomplete="off" placeholder="%" name="diskon_per_Faktur"  autofocus="" v-if="diskonFaktur == 1"  v-model="formDiskon.persen">
							<money id="myInput2" v-bind="money" class="form-control" required autocomplete="off" placeholder="Rp" name="diskon_per_Faktur"  autofocus="" v-if="diskonFakturRp == 1" v-model="formDiskon.rupiah"></money>
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
						<form  v-on:submit.prevent="saveForm()">
							<table width="100%">
								<tbody>
									<tr width="100%">
										<td width="10%"><h2>Total</h2></td>
										<td width="10%"><h2>:</h2></td>
										<td width="80%"><h2 style="text-align:right;">{{jumlahBayar|pemisahTitik}}</h2></td>
									</tr>
									<tr width="100%">
										<td>Total Penjualan</td>
										<td>:</td>
										<td>{{ tbs_penjualans.length }}</td>
									</tr>
									<br>
									<tr width="100%">
										<td width="20%">Tunai</td>
										<td width="10%">:</td>
										<td><money class="form-control" required autocomplete="off" placeholder="Jumlah" v-model="pembayaran.bayar" v-bind="money" name="bayar" style="text-align:right;" ref="tunai"></money></td>
									</tr>
									<tr width="100%">
										<td width="10%"></td>
										<td width="10%"></td>
										<td width="80%"></td>
									</tr>
									<tr width="100%">
										<td width="10%">Kembalian</td>
										<td width="10%">:</td>
										<td width="80%"><h2 style="text-align:right;">{{pembayaran.kembalian|pemisahTitik}}</h2></td>
									</tr>
									<tr width="100%">
										<td>Status Pesanan</td>
										<td>:</td>
										<td>
											<selectize-component v-model="penjualan.status_pemesanan"  id="status_pemesanan" ref="status_pemesanan"> 
												<option v-bind:value="0">Dine In </option>
												<option v-bind:value="1" >Take Away </option>
												<option v-bind:value="2" >Delivery </option>
											</selectize-component>
										</td>
									</tr>
									<tr width="100%">
										<td>Keterangan</td>
										<td>:</td>
										<td>
											<textarea style="width:400px;"  v-model="penjualan.keterangan"></textarea>
										</td>
									</tr>
									<tr width="100%">
										<td>Pelanggan</td>
										<td>:</td>
										<td>
											<selectize-component v-model="penjualan.nama_pelanggan" :settings="setting_pelanggan"> 
												<option v-for="pelanggan in pelanggans" v-bind:value="pelanggan.id" >{{ pelanggan.nama_pelanggan }}</option>
											</selectize-component>
										</td>
									</tr>
								</tbody>
							</table>
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
						<form v-on:submit.prevent="" class="form-horizontal">
							<input class="form-control" required autocomplete="off" placeholder="%" type="number" name="diskon_per_produk"  autofocus="" v-if="diskonProduk == 1" v-model="formDiskonProduk.persen">
							<money v-bind="money" class="form-control" required autocomplete="off" placeholder="Rp"  name="diskon_per_produk"  autofocus="" v-if="diskonProdukRp == 1" v-model="formDiskonProduk.rupiah"></money>
							<br>
						</form>
					</div>
					<div class="modal-footer">
						<button id="btnDiskon" class="btn btn-primary" type="button" data-dismiss="modal" v-on:click="simpanDiskonPerProduk(tbs_penjualans.harga_produk)" >Simpan</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
					</div>
				</div>
			</div>
		</div>

		<!-- MODAL SIMPAN PENJUALAN -->
		<div id="modalSimpanPenjualan" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">

						<div class="modal-body">

							<form class="form-horizontal">

								<!-- Form Name -->
								<legend>Simpan</legend>

								<!-- Text input-->
								<div class="form-group">
									<label class="col-md-4 control-label" for="textinput">No Meja</label>  
									<div class="col-md-8">
										<input v-model="bukaPenjualan.nomor_meja" id="textinput" name="textinput" type="text" placeholder="placeholder" class="form-control input-md">
										<span class="help-block"></span>  
									</div>
								</div>

								<!-- Textarea -->
								<div class="form-group">
									<label class="col-md-4 control-label" for="textarea">Catatan</label>
									<div class="col-md-8">                     
										<textarea v-model="bukaPenjualan.catatan" class="form-control" id="textarea" name="textarea"></textarea>
									</div>
								</div>

							</form>

						</div>
						
					</div>
					<div class="modal-footer">
						<button v-on:click="simpanPenjualan()" class="btn btn-primary" type="button" data-dismiss="modal">Simpan</button>
						<button type="button" class="btn btn-default" data-dismiss="modal" >Tutup</button> 
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
										<div class=" btn btn-success col-md-3">
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
										<div class=" btn btn-success col-md-3">
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
									<div v-for="produksPenjualans , index in produksPenjualan" class="box-produk">
										<div class="thumbnail box-dalam-produk">
											<img :src="urlFotoProduk + '/' + produksPenjualans.data_produk.foto">
											<div class="caption"  @click="submitTbsPenjualan(produksPenjualans)">
												<h6 v-if="produksPenjualans.data_produk.nama_produk.length > 15">
													{{produksPenjualans.data_produk.nama_produk.slice(0, 15)}}...
												</h6>
												<h6 v-else>
													{{produksPenjualans.data_produk.nama_produk}}
												</h6>
												<p>Harga: {{produksPenjualans.data_produk.harga_jual|pemisahTitik}}</p>

											</div>
										</div>
									</div>
								</div>
								<div v-else>
									<div v-for="produksPenjualans , index in produksPenjualan" class="col-md-3 box-produk">
										<div class="thumbnail box-dalam-produk">
											<img :src="urlFotoProduk + '/' + produksPenjualans.data_produk.foto" width="150px" height="80px">
											<div class="caption"  @click="submitTbsPenjualan(produksPenjualans)">
												<h6 v-if="produksPenjualans.data_produk.nama_produk.length > 15">
													{{produksPenjualans.data_produk.nama_produk.slice(0, 15)}}...
												</h6>
												<h6 v-else>
													{{produksPenjualans.data_produk.nama_produk}}
												</h6>
												<p class="font-harga">Harga: {{produksPenjualans.data_produk.harga_jual|pemisahTitik}}</p>
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
			<div class="panel panel-default" id="digital">
				<div class="panel-body" width="100%" style="size:100%;">

					<div width="80%" style="float:right;size:95%;">
						<h3 style="text-align:right;font-family: 'Orbitron', sans-serif;" v-if="tbs_penjualans.total_bayar != undefined" class="total-bayar" v-model="jumlahBayar">{{ jumlahBayar|pemisahTitik }}</h3>
						<h3 style="text-align:right;font-family: 'Orbitron', sans-serif;" v-else class="total-bayar"></h3>
					</div>

					<div width="5%" style="float:left;size:5%;">
						<tr>
							<td>Subtotal</td>
							<td>:</td>
							<td v-if="tbs_penjualans.total_bayar === undefined">{{0}}</td>
							<td v-else>{{tbs_penjualans.total_bayar|pemisahTitik}}</td>
						</tr>
						<tr>
							<td>Diskon</td>
							<td>:</td>
							<td>{{diskonPerfaktur.persen}} %</td>
						</tr>
						<tr>
							<td>Diskon</td>
							<td>:</td>
							<td>{{diskonPerfaktur.rupiah}}</td>
						</tr>
						<tr>
							<td>Pajak</td>
							<td>:</td>
							<td>2,2%</td>
						</tr>
					</div>

				</div>
			</div>

			<div class="panel panel-default" id="items">
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
										<a href="#modalDiskonPenjualanPerProduk" data-toggle="modal">@{{tbs_penjualan.harga_produk|pemisahTitik}}</a><br>
										
										<p>Disc. {{diskonPerproduk.persen}}% ({{diskonPerproduk.rupiah | pemisahTitik}})</p>
									</td>
									<td>
										<button class="button trash" data-toggle="modal" data-target="#modalJumlahItem" @click="getDataTbs(tbs_penjualan.id_tbs_penjualan, tbs_penjualan.subtotal, tbs_penjualan.harga_produk, tbs_penjualan.jumlah_produk)">
											{{ tbs_penjualan.jumlah_produk }}
										</button>
									</td>
									<td>
									{{tbs_penjualan.subtotal|pemisahTitik}}</td>
									<td>
										<button class="fa fa-times fa-1x splice" v-on:click="deleteTbsPenjualan(tbs_penjualan.id_tbs_penjualan)" type="button">
										</button>
									</td>
								</tr>
							</tbody>
							<tbody v-else-if="loadingTbs == true" class="text-center">
								<li>Sedang Memuat Item</li>
							</tbody>
							<tbody v-else class="text-center">
								Tidak Ada Item
							</tbody>
						</table>
					</div>
				</div>
				<vue-simple-spinner v-if="loadingTbs"></vue-simple-spinner>
			</div>
			<button class="button button2" data-toggle="modal" data-target="#modalSimpanPenjualan">Simpan</button>
			<button class="button button1" data-toggle="modal" data-target="#modalDiskonPenjualan">Diskon</button>
			
			<button class="button button3" data-target="#modalBayar" data-toggle="modal">Bayar</button>
		</div>
	</div>
</template>

<script>
export default {
	data: function () {
		return {
			bukaPenjualan: {
				nomor_meja: '',
				catatan: '',
			},
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
			diskonPerproduk:{
				persen: '',
				rupiah: '',
			},
			formDiskonProduk:{
				persen: '',
			},	rupiah: '',
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
				status_pemesanan: 0,
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
			urlBukaPenjualan: window.location.origin + (window.location.pathname).replace("home","buka-penjualan"),
			url : window.location.origin + (window.location.pathname).replace("home", "penjualan"),
			urlTambahTbs : window.location.origin + (window.location.pathname).replace("home", "proses-tbs-penjualan"),
			urlUpdateTbs : window.location.origin + (window.location.pathname).replace("home", "update-tbs-penjualan"),
			urlHapusTbs : window.location.origin + (window.location.pathname).replace("home", "penjualan/hapus-tbs-penjualan"),
			urlFotoProduk : window.location.origin + (window.location.pathname).replace("home", "foto_produk"),
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

	filters: {
		pemisahTitik: function (value) {
			var angka = [value];
			var numberFormat = new Intl.NumberFormat('es-ES');
			var formatted = angka.map(numberFormat.format);
			return formatted.join('; ');
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
				app.diskonPerfaktur.persen = '';
				app.diskonPerfaktur.rupiah = '';
			}
			app.jumlahBayar = app.tbs_penjualans.total_bayar - app.diskonPerfaktur.rupiah;
			
			console.log(app.tbs_penjualans.total_bayar);
			$('#modalDiskonPenjualan').hide();

		},

		simpanDiskonPerProduk(){
			var app = this;
			if(app.formDiskonProduk.persen > 0){
				app.diskonPerproduk.persen = app.formDiskonProduk.persen;
				app.diskonPerproduk.rupiah = (app.tbs_penjualans.total_bayar * app.diskonPerproduk.persen) / 100;

			}else if(app.formDiskonProduk.rupiah > 0){
				app.diskonPerproduk.rupiah = app.formDiskonProduk.rupiah;
				app.diskonPerproduk.persen = (app.diskonPerproduk.rupiah / app.tbs_penjualans.total_bayar) * 100;

			}
			else{
				app.diskonPerproduk.persen = '';
				app.diskonPerproduk.rupiah = '';
			}
			app.jumlahBayar = app.tbs_penjualans.total_bayar - app.diskonPerproduk.rupiah;

			console.log(app.tbs_penjualans.total_bayar);
			$('#modalDiskonPenjualanPerProduk').hide();
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
				console.log(app.urlFotoProduk);
				console.log(app.produksPenjualan)

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
			app.penjualan.status_pemesanan = app.penjualan.status_pemesanan;
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
				app.penjualan.status_pemesanan = '';
				// app.getPenjualans();
			})
			.catch(function (resp) {
				app.alert('gagal')
			})

		},
		simpanPenjualan() {
			var app = this;

			axios.post(app.urlBukaPenjualan, app.bukaPenjualan)
			.then(function (resp) {
				console.log(resp);
				app.alert('Berhasil');
			})
			.catch(function (resp) {
				console.log(resp);
				app.alert('Gagal');
			});

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
