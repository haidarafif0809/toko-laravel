<style scoped>
/*.kategori {
	color: red;
	font-weight: bold;
	text-align: center;
	}*/
	.thumbnail{
		box-shadow:0 1px 1px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.19);
		margin: 5px;
		height: 280px;
	}
	.cart-item {

		overflow: auto;
	}
	.head{
		/*background: linear-gradient(60deg, #29b6f6, #0288d1);*/
		background: #578ca9;
		color: white;
	}
	.link{
		color: white;
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
		/*background: linear-gradient(60deg, #29b6f6, #0288d1);*/
		background: #578ca9;
		color: white;
		border:4px solid #F5F5F5;
	}
	.button1{
		background-color: black;
		color: white;
		border-radius:8px;
		/*width: 114px;*/
		/*height:60px;*/
		/*left: 10px;*/
		box-shadow:0 1px 1px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.19);
		font-size: 15px;
	}
	.button1:hover {background-color: #424EF7;}

	.button2{
		background-color: black;
		color: white;
		border-radius:8px;
		/*width: 114px;*/
		/*height:60px;*/
		/*left: 10px;*/
		box-shadow:0 1px 1px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.19);
		font-size: 15px;
	}
	.button2:hover {background-color: #424EF7;}

	.button3 {
		background-color: green;
		color: white;
		border-radius:8px;
		/*width: 114px;*/
		/*height:60px;*/
		/*left:30px;*/
		box-shadow:0 1px 1px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.19);
		font-size: 15px;
	}

	.button3:hover {background-color: #424EF7;}

	#tbs{
		max-height:500px;
		overflow: auto;
	}
	#digital{
		box-shadow:0 1px 1px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.19);
	}
	#kategori_shadow{
		box-shadow:0 1px 1px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.19);
	}
	.modal{
		overflow:scroll;
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
		box-shadow:0 1px 1px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.19);
	}
	.focus:focus{
		background-color: #EFF0F1;
	}
	.button5:focus{
		color: red;
	}

	.box-produk {
/*	height: 200px;
width: 160px;*/
/*background-color: powderblue;*/
}
.box-dalam-produk {
	/*height: 190px;*/
	/*width: 150px;*/
	/*background-color: powderblue;*/
}

</style>

<template>
	<div class="container-fluid">
		<div class="row">
			<!-- small modal jumlah produk-->
			<div class="modal" id="modalJumlahProduk" role="dialog" aria-hidden="true" >
				<div class="modal-dialog modal-medium">
					<div class="modal-content">
						<form class="form-horizontal" v-on:submit.prevent="simpanJumlahProduk(dataTbs.jumlah,dataTbs.harga_produk)"> 
							<div class="modal-header">
								<label>Jumlah Produk</label>
								<button type="button" class="close"  v-on:click="closeModal()">&times;</button> 
							</div>
							<div class="modal-body">
								<input class="form-control" required  type="number" name="jumlahProduk" v-model="dataTbs.jumlah" ref="jumlah_produk">
							</div>

							<div class="modal-footer">
								<button type="button" class="btn btn-simple" v-on:click="closeModal()">Batal</button>
								<button type="submit" class="btn btn-info">Simpan</button>
							</div>
						</form>
					</div>
				</div>
			</div>

			<!-- modal modifier -->
			<div class="modal" id="modalModifier" role="dialog" aria-hidden="true" >
				<div class="modal-dialog modal-large">
					<div class="modal-content">
						<form class="form-horizontal" v-on:submit.prevent="submitTbsPenjualan2()"> 
							<div class="modal-header">
								<button type="button" class="close"  v-on:click="closeModal()">&times;</button> 
							</div>
							<div class="modal-body">
								<p>Pilih Modifier(Opsional)</p>
								<span v-for="modifiers, index in modifier.modifier">
									<button :id="modifiers.id" type="button" class="btn btn-primary btn-md" @click="getModifier(modifiers.id)">{{modifiers.nama_modifier}} | <br>{{modifiers.harga_modifier | pemisahTitik}}</button>
								</span>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-simple" v-on:click="closeModal()">Batal</button>
								<button type="submit" class="btn btn-info">Simpan</button>
							</div>
						</form>
					</div>
				</div>
			</div>

			<!-- Modal Pembayaran -->
			<div id="modalBayar" class="modal" role="dialog" tabindex="-1" aria-hidden="fade" >
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h4>Pembayaran</h4>
						</div>
						<form  v-on:submit.prevent="saveForm()">
							<div class="row modal-body">
								<span class="col-xs-4"><h3>Total Bayar</h3></span>  
								<span class="col-xs-8">
									<span style="text-align:right;"><h3> Rp. {{jumlahBayar|pemisahTitik}}</h3></span>
								</span>
								<span class=" col-xs-4">Total Item</span>
								<span class="col-xs-8">
									<span style="text-align:right;">: {{ tbs_penjualans.length }}</span>
								</span>
								<div class="form-group">
									<label class="col-xs-4 control-label" for="textarea">Tunai</label>
									<div class="col-xs-8">    
										<money id="bayar" class="form-control" required autocomplete="off" placeholder="Jumlah" v-model="penjualan.bayar" v-bind="money" name="bayar" style="text-align:right;" ref="tunai"></money>
									</div>
								</div>
								<div class="form-group">
									<label class="col-xs-12 control-label" style="text-align:right;">Kembalian</label>
									<div class="col-xs-12">    
										<h4 v-model="penjualan.kembalian"style="text-align:right;">{{penjualan.kembalian|pemisahTitik}}</h4>
									</div>
								</div>

								<div class="form-group">
									<label class="col-xs-12 control-label"></label>
								</div>
								<div class="form-group">
									<label class="col-xs-4 control-label">Pelanggan</label>
									<div class="col-xs-8">
										<selectize-component class="form-control" v-model="penjualan.nama_pelanggan" :settings="setting_pelanggan" ref="nama_pelanggan2"> 
											<option v-for="pelanggan in pelanggans" v-bind:value=0 >Umum</option>
											<option v-for="pelanggan in pelanggans" v-bind:value="pelanggan.id" >{{ pelanggan.nama_pelanggan }}</option>
										</selectize-component>
									</div>
								</div>
								<div class="form-group">
									<label class="col-xs-12 control-label"></label>
								</div>
								<div class="form-group">
									<label class="col-xs-4 control-label">Status pesanan</label>
									<div class="col-xs-8">
										<selectize-component class="form-control" v-model="penjualan.status_pemesanan"  id="status_pemesanan" ref="status_pemesanan"> 
											<option v-bind:value="0">Dine In </option>
											<option v-bind:value="1" >Take Away </option>
											<option v-bind:value="2" >Delivery </option>
										</selectize-component>
									</div>
								</div>
								<div class="form-group">
									<label class="col-xs-12 control-label"></label>
								</div>
								<div class="form-group">
									<label class="col-xs-4 control-label">Catatan</label>
									<div class="col-xs-8">
										<textarea class="form-control" v-model="penjualan.keterangan"></textarea>
									</div>
								</div>
								<div class="form-group">
									<label class="col-xs-12 control-label" for="textarea"></label>
								</div>
								<div class="form-group">
									<label class="col-xs-12 control-label" for="textarea"></label>
								</div>
							</div>
							<div class="modal-footer">
								<button class="btn btn-primary" id="btnBayar" type="submit">Bayar</button>
								<button class="btn btn-primary" @click="saveForm2()" type="button">Bayar & Cetak</button>
								<button type="button" class="btn btn-default" id="btnTutup" @click="closeModal()" >Tutup</button> 
							</div>
						</form>
					</div>
				</div>
			</div>

			<!-- Modal untuk Diskon per faktur -->
			<div id="modalDiskonPenjualan" class="modal" role="dialog" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<!-- <h4 class="modal-title">Diskon Penjualan Per Faktur</h4> -->
							<button class="btn btn-default" v-on:click="diskonPenjualanFakturPersen()">Diskon %</button>
							<button class="btn btn-default" v-on:click="diskonPenjualanFakturRp()">Diskon Rp</button>

						</div>
						<form v-on:submit.prevent="simpanDiskonPerFaktur()" class="form-horizontal">
							<div class="modal-body">
								<input v-if="diskonFaktur == 1" ref="persen" class="form-control" autocomplete="off" placeholder="%" type="number" name="diskon_per_Faktur"  autofocus  v-model="formDiskon.persen">
								<input v-if="diskonFakturRp == 1" ref="rupiah"class="form-control" autocomplete="off" placeholder="Rp" type="number" name="diskon_per_Faktur"  autofocus  v-model="formDiskon.rupiah">
								<br>
							</div>
							<div class="modal-footer">
								<button class="btn btn-primary" type="submit" >Simpan</button>
								<button type="button" class="btn btn-default" @click="closeModal()">Tutup</button> 
							</div>
						</form>
					</div>
				</div>
			</div>

			<!-- Modal untuk Diskon per Produk-->
			<div id="modalDiskonPenjualanPerProduk" class="modal" role="dialog" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<!-- <h4 class="modal-title">Diskon Penjualan</h4> -->
							<button class="btn btn-default" v-on:click="diskonPenjualanProdukPersen()">Diskon %</button>
							<button class="btn btn-default" v-on:click="diskonPenjualanProdukRp()">Diskon Rp</button>
						</div>
						<form class="form-horizontal" v-on:submit.prevent="simpanDiskonPerProduk(diskonPerproduk.harga_produk, diskonPerproduk.jumlah_produk)">
							<div class="modal-body">
								<input class="form-control"  autocomplete="off" placeholder="%" type="number" name="diskon_per_produk"  autofocus="" v-if="diskonProduk == 1" v-model="formDiskonProduk.persen" ref="diskon_persen">
								<money v-bind="money" class="form-control" required autocomplete="off" placeholder="Rp"  name="diskon_per_produk"  autofocus="" v-if="diskonProdukRp == 1" v-model="formDiskonProduk.rupiah" ref="diskon_rupiah"></money>
								<br>
							</div>
							<div class="modal-footer">
								<button id="btnDiskon" class="btn btn-primary" type="submit">Simpan</button>
								<button type="button" class="btn btn-default" @click="closeModal()">Tutup</button>
							</div>
						</form>
					</div>
				</div>
			</div>

			<!-- MODAL SIMPAN PENJUALAN -->
			<div id="modalSimpanPenjualan" class="modal" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content">
						<form class="form-horizontal" v-on:submit.prevent="simpanPenjualan()">
							<div class="modal-header">
								<div class="modal-body">
									<legend>Simpan</legend>
									<div class="form-group">
										<label class="col-xs-4 control-label" for="textinput">No Meja</label>  
										<div class="col-xs-8">
											<input v-model="penjualan.nomor_meja" id="textinput" name="textinput" type="number" placeholder="placeholder" class="form-control input-xs" ref="no_meja">
											<span class="help-block"></span>  
										</div>
									</div>

									<!-- Textarea -->
									<div class="form-group">
										<label class="col-xs-4 control-label" for="textarea">Catatan</label>
										<div class="col-xs-8">                     
											<textarea v-model="penjualan.catatan" class="form-control" id="textarea" name="textarea"></textarea>
										</div>
									</div>

									<div class="form-group">
										<label class="col-xs-4 control-label" for="textarea">Pelanggan</label>
										<div class="col-xs-8">    
											<selectize-component v-model="penjualan.nama_pelanggan" :settings="setting_pelanggan"> 
												<option v-for="pelanggan in pelanggans" v-bind:value="pelanggan.id" >{{ pelanggan.nama_pelanggan }}</option>
											</selectize-component>
										</div>
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<button class="btn btn-primary" type="submit">Simpan</button>
								<button class="btn btn-primary" @click="simpanPenjualan2()" type="button">Simpan & Cetak Pesanan</button>
								<button type="button" class="btn btn-default" @click="closeModal()">Tutup</button> 
							</div>
						</form>
					</div>
				</div>
			</div>

			<!-- .................................................................................................. -->
			<div class="col-md-4 col-sm-4" id="pull-left">
				<div class="panel head panel-heading">
					<span>
						<router-link :to="{name:'bukaPenjualan'}" id="tambah-kas"><a href="" class="link"><i class="fa fa-cart-plus "></i> Penjualan Tersimpan</a></router-link>
					</span>
				</div>
				<div class="panel panel-default" id="digital">
					<div class="panel-body" width="100%" style="size:100%;">

						<div width="80%" style="float:right;size:95%;">
							<h3 style="text-align:right;font-family: 'Fugaz One', sans-serif;" v-if="tbs_penjualans.total_bayar != undefined" class="total-bayar" v-model="jumlahBayar">{{ jumlahBayar|pemisahTitik }}</h3>
							<h3 style="text-align:right;font-family: 'Orbitron', sans-serif;" v-else class="total-bayar"></h3>
						</div>

						<div width="5%" style="float:left;size:5%;">
							<tr>
								<td>Subtotal</td>
								<td>&nbsp</td>
								<td> : </td>
								<td>&nbsp</td>
								<td v-if="tbs_penjualans.total_bayar === undefined">{{''}}</td>
								<td v-else>{{tbs_penjualans.total_bayar|pemisahTitik}}</td>
							</tr>
							<tr>
								<td>Diskon</td>
								<td>&nbsp</td>
								<td> : </td>
								<td>&nbsp</td>
								<td v-if="diskonPerfaktur.persen === '' && diskonPerfaktur.rupiah === '' ">{{''}}</td>
								<td v-else>{{Number.parseInt(diskonPerfaktur.persen)}} % ({{diskonPerfaktur.rupiah|pemisahTitik}})</td>
							</tr>
							<tr>
								<td>Pajak</td>
								<td>&nbsp</td>
								<td> : </td>
								<td>&nbsp</td>
								<td>{{''}}</td>
							</tr>
						</div>

					</div>
				</div>

				<div class="panel panel-default" id="items">
					<div class="head panel-heading"></div>
					<div class="panel-body">
						<!-- pencarian produk -->

						<!-- data item tbs_penjualan -->
						<div class="table-responsive" id="tbs">
							<table class="table table-striped table-hover">
								<tbody v-if="tbs_penjualans.length > 0 && loadingTbs == false" class="data-ada">
									<tr v-for="tbs_penjualan, index in tbs_penjualans">
										<td>{{ tbs_penjualan.nama_produk}} <br>
											<a href="#/penjualan" v-bind:title="message" @click="getDiskonProdukTbs(tbs_penjualan.id_tbs_penjualan, tbs_penjualan.subtotal, tbs_penjualan.harga_produk, tbs_penjualan.jumlah_produk)">@{{tbs_penjualan.harga_produk|pemisahTitik}}</a><br>

											<p v-if="tbs_penjualan.diskon_persen != undefined ">Disc.{{Number.parseInt(tbs_penjualan.diskon_persen)}}% ({{tbs_penjualan.diskon | pemisahTitik}})</p>
											<p v-else>Disc.0% (0)</p>
											<p v-if="tbs_penjualan.id_modifier != null">
												<span>Add: </span>
												<span v-for="modifier, index in tbs_penjualan.modifier" >
													{{modifier.nama_modifier}},
												</span>				
											</p>


										</td>
										<td>
											<button class="button trash" @click="getDataTbs(tbs_penjualan.id_tbs_penjualan, tbs_penjualan.subtotal, tbs_penjualan.jumlah_produk, tbs_penjualan.harga_produk)">
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

				<!-- button aksi: simpan, bayar, diskon -->
				<button v-bind:disabled="!isValid" class="button button2 btn-xs btn-md" @click="openModalSimpanPenjualan()"><i class="fa fa-bookmark"></i> Simpan</button>
				<button v-bind:disabled="!isValid" class="button button1 btn-xs btn-md" @click="modalDiskonFaktur()">Diskon Per Transaksi</button>
				<button v-bind:disabled="!validate" class="button button3 btn-xs btn-md" @click="openModal()">Bayar</button>
			</div>

			<div class="col-md-8 col-sm-8" id="pull-right">
				<div class="panel panel-default" id="kategori_shadow">
					<!-- KATEGORI PRODUK -->
					<div class="head panel-heading text-center " ><h3><b>DAFTAR MENU PENJUALAN</b></h3></div>
					<div class="panel-body">
						<div class="row">
							<div class="form-group col-md-4 ">
								<label>Pilih Kategori Produk</label>
								<selectize-component class="form-control" v-model="filter.kategori_produk" :settings="placeholder_kategori_produk" id="pilih_kasir"> 
									<option v-bind:value=0>Semua Kategori</option>									
									<option v-for="kategori_produk, index in kategori_produks" v-bind:value="kategori_produk.id">{{ kategori_produk.nama_kategori_produk }}</option>
								</selectize-component>
							</div>
							<div class="col-md-8 pencarian"> 
								<label style="color:white;">.</label>
								<div class="input-group">
									<input type="text" class="form-control" name="search" placeholder="Pencarian Produk"  v-model="search" >
									<div class="input-group-addon">
										<i class="fa fa-search" aria-hidden="true"></i>
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
										<div v-for="produksPenjualans , index in produksPenjualan" class="box-produk col-md-3 col-sm-4 col-xs-6 ">
											<div class="row">
												<div class="thumbnail box-dalam-produk">
													<img :src="urlFotoProduk + '/' + produksPenjualans.data_produk.foto" v-if="produksPenjualans.data_produk.produk_modifier_id.length != ''" @click="openModalModifier(produksPenjualans)">
													<img :src="urlFotoProduk + '/' + produksPenjualans.data_produk.foto" v-if="produksPenjualans.data_produk.produk_modifier_id.length == ''" @click="submitTbsPenjualan(produksPenjualans)">
													<div class="caption"  >
														<h6 v-if="produksPenjualans.data_produk.nama_produk.length > 15">
															{{produksPenjualans.data_produk.nama_produk.slice(0, 50)}}...
														</h6>
														<h6 v-else>
															{{produksPenjualans.data_produk.nama_produk}}
														</h6>
														<p>Harga: {{produksPenjualans.data_produk.harga_jual|pemisahTitik}}</p>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div v-else>
										<div v-for="produksPenjualans , index in produksPenjualan" class="col-md-3 col-sm-4 col-xs-6 box-produk">
											<div class="row">
												<div class="thumbnail box-dalam-produk" >
													<img :src="urlFotoProduk + '/' + produksPenjualans.data_produk.foto" v-if="produksPenjualans.data_produk.produk_modifier_id.length != ''" @click="openModalModifier(produksPenjualans)">
													<img :src="urlFotoProduk + '/' + produksPenjualans.data_produk.foto" v-if="produksPenjualans.data_produk.produk_modifier_id.length == ''" @click="submitTbsPenjualan(produksPenjualans)">
													<div class="caption"  >
														<h6 v-if="produksPenjualans.data_produk.nama_produk.length > 15">
															{{produksPenjualans.data_produk.nama_produk.slice(0, 50)}}...
														</h6>
														<h6 v-else>
															{{produksPenjualans.data_produk.nama_produk}}
														</h6>
														<h5 class="font-harga">Harga: {{produksPenjualans.data_produk.harga_jual|pemisahTitik}}</h5>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div v-else-if="loading == true" class="data-ada" >
								<ul >
									<li colspan="4"  class="text-center">
										Sedang Memuat Data
									</li>
								</ul>
							</div>
							<div v-else class="data-tidak-ada" >
								<ul >
									<li colspan="4"  class="text-center">
										Tidak Ada Data
									</li>
								</ul>
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
		</div>
	</div>
</template>

<script>
export default {
	data: function () {
		return {
			message: 'Input Diskon Per Produk',
			id_simpan_penjualan: '',
			modifier: [],
			data_modifier:[],
			kategori_produks: [],
			produksPenjualan: [],
				dataProduksPenjualan:{}, //paginations
				tbs_penjualans: [],
				pelanggans:[],
				filter: {
					kategori_produk: ''
				},
				formJumlahProduk: '',
				jumlahBayar: '',
				formDiskon: {
					persen: '',
					rupiah: '',
				},
				formDiskonProduk:{
					persen: '',
				},	rupiah: '',
				diskonPerfaktur: {
					persen: '',
					rupiah: '',
				},
				diskonPerproduk:{
					id: '',
					subtotal: '',
					harga_produk: '',
					jumlah_produk: '',
					persen: '',
					rupiah: '',
				},
				penjualan: {
					nomor_meja: '',
					id_simpan_penjualan: '',
					catatan: '',
					nama_pelanggan: 0,
					cara_bayar: '',
					diskon: '',
					subtotal: '',
					total_bayar: '',
					keterangan: '',
					bayar: '',
					kembalian: '',
					status_pemesanan: 0,
				},
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
					diskon: '',
					diskon_persen: '',
					id: '',
					jumlah: '',
					subtotal: '',
					harga_produk:'',
				},
				price:1,
				money: {
					decimal: ',',
					thousands: '.',
					precision: 0,
					masked: false
				},
				diskon_per_produk: {

				},
				search: '',
				formTunai: 1,
				diskonProduk: 1,
				diskonProdukRp: 0,
				diskonFaktur: 1,
				diskonFakturRp: 0,
				formKartu: 0,
				urlSimpanPenjualan: window.location.origin + (window.location.pathname).replace("home","simpan-penjualan"),
				url : window.location.origin + (window.location.pathname).replace("home", "penjualan"),
				urlTambahTbs : window.location.origin + (window.location.pathname).replace("home", "proses-tbs-penjualan"),
				urlUpdateTbs : window.location.origin + (window.location.pathname).replace("home", "update-tbs-penjualan"),
				urlUpdateDiskonTbs : window.location.origin + (window.location.pathname).replace("home", "update-diskon-tbs-penjualan"),
				urlHapusTbs : window.location.origin + (window.location.pathname).replace("home", "penjualan/hapus-tbs-penjualan"),
				urlHapusSimpanPenjualan : window.location.origin + (window.location.pathname).replace("home", "penjualan/hapus-simpan-penjualan"),
				urlFotoProduk : window.location.origin + (window.location.pathname).replace("home", "foto_produk"),
				loading : true,
				loadingTbs : true,

				setting_pelanggan:{
					placeholder: 'Pilih Pelanggan'
				},
				settingss:{
					placeholder: 'Pilih Bank'
				},				
				placeholder_kategori_produk:{
					placeholder: 'PILIH KATEGORI PRODUK'
				},
				setting_modifier:{
					placeholder: 'Pilih Tambahan',
					sortField: 'text',
					delimiter: ',',
					maxItems: null
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
			// apabila ada diskon perfaktur dari simpan penjualan
		},

		watch: {
	    // whenever question changes, this function will run
	    search: function (newQuestion) {
	    	this.getHasilPencarian()
	    },
	    'penjualan.bayar': function (newQuestion){
	    	this.getHasilKembalian()
	    },
	    'filter.kategori_produk': function (newQuestion){
	    	this.getProduksPenjualan();
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
	computed: {
		isValid: function () {
			return this.tbs_penjualans != '' 
		},
		validate: function(){
			return this.tbs_penjualans != ''
		},
	},
	methods: {
		getDiskonProdukTbs(id, subtotal, harga, jumlah) {
			let app = this;
			app.diskonPerproduk.id = id;
			app.diskonPerproduk.subtotal = subtotal;
			app.diskonPerproduk.harga_produk = harga;
			app.diskonPerproduk.jumlah_produk = jumlah;
			$('#modalDiskonPenjualanPerProduk').show();
			app.$refs.diskon_persen.focus();
		},
		getDataTbs(id, subtotal, jumlah, harga_produk) {
			this.dataTbs.id = id;
			this.dataTbs.subtotal = subtotal;
			this.dataTbs.jumlah = jumlah;
			this.dataTbs.harga_produk = harga_produk;
			this.editJumlahTbs();
		},
		editJumlahTbs(){

			$("#modalJumlahProduk").show();
			this.$refs.jumlah_produk.focus()
		},
		getHasilKembalian(){
			var app = this;
			var kembalian = app.penjualan.bayar - app.jumlahBayar

			if (app.penjualan.bayar === 0 || app.penjualan.bayar === '') {
				return app.penjualan.kembalian = 0;
			}
			else {

				app.penjualan.kembalian = kembalian;

			}
		},
		// create diskon per faktur
		simpanDiskonPerFaktur(){
			var app = this;
			if(app.formDiskon.persen > 0 ){
				app.diskonPerfaktur.persen = app.formDiskon.persen;
				app.diskonPerfaktur.rupiah = (app.tbs_penjualans.total_bayar / 100) * app.formDiskon.persen;
				app.formDiskon.persen = '';
				app.formDiskon.rupiah = '';
			}
			else if(app.formDiskon.rupiah > 0 ){
				app.diskonPerfaktur.rupiah = app.formDiskon.rupiah;
				app.diskonPerfaktur.persen = (app.formDiskon.rupiah * 100) / app.tbs_penjualans.total_bayar;
				app.formDiskon.persen = '';
				app.formDiskon.rupiah = '';
			}
			else {
				app.diskonPerfaktur.persen = '';
				app.diskonPerfaktur.rupiah = '';
			}
			app.jumlahBayar = app.tbs_penjualans.total_bayar - app.diskonPerfaktur.rupiah;
			
			$('#modalDiskonPenjualan').hide();

		},
		// create diskon per produk
		simpanDiskonPerProduk(harga, jumlah){
			var app = this;
			var subtotal = (harga * jumlah);
			if(app.formDiskonProduk.persen > 0){
				app.diskonPerproduk.persen = app.formDiskonProduk.persen;
				app.diskonPerproduk.rupiah = (subtotal * app.diskonPerproduk.persen) / 100;

			}else if(app.formDiskonProduk.rupiah > 0){
				app.diskonPerproduk.rupiah = app.formDiskonProduk.rupiah;
				app.diskonPerproduk.persen = (app.diskonPerproduk.rupiah / subtotal) * 100;

			}
			else{
				app.diskonPerproduk.persen = '';
				app.diskonPerproduk.rupiah = '';
			}
			app.jumlahBayar = app.tbs_penjualans.total_bayar - app.diskonPerproduk.rupiah;

			var newDiskon = app.diskonPerproduk;
			axios.post(app.urlUpdateDiskonTbs, newDiskon)
			.then(function (resp) {
				app.$router.replace('/penjualan');
				app.getTbsPenjualan();
				app.formDiskonProduk.persen = '';
				app.formDiskonProduk.rupiah = '';
				app.formDiskon.rupiah = '';
			})
			.catch(function (resp) {
				app.errors = resp.response.data.errors;
			});		

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
			var newFilter = app.filter;
			axios.post(app.url+'/view?page='+page, newFilter)
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
		// menampilakan tbs penjualan / pesanan
		getTbsPenjualan() {
			var app = this;
			axios.get(app.url +'/tbs-penjualan')
			.then(function (resp) {
				if (resp.data.data != undefined) {
					app.tbs_penjualans = resp.data.data;
					app.tbs_penjualans.total_bayar = resp.data.total_bayar;
					app.jumlahBayar = resp.data.total_bayar;
					app.id_simpan_penjualan = resp.data.id_simpan_penjualan;
					app.loadingTbs = false;
					app.getDiskonSimpanPenjualan();
					console.log(app.tbs_penjualans);
				}
				app.loadingTbs = false;
			})	
			.catch(function () {
				alert("Could not load tbs penjualan");
			});
		},
		// mengambil diskon perfaktur dari simpan_penjualan
		getDiskonSimpanPenjualan(){
			var app = this;
			if (app.id_simpan_penjualan != null ) {				
				axios.get(app.url+'/diskon-simpan-penjualan?id='+app.id_simpan_penjualan)
				.then(function(resp) {
					app.formDiskon.rupiah = resp.data.diskon;
					app.penjualan.nomor_meja = resp.data.nomor_meja
					app.penjualan.catatan = resp.data.catatan
					app.penjualan.nama_pelanggan = resp.data.pelanggan_id
					app.simpanDiskonPerFaktur();
					// console.log(app.formDiskon.rupiah);
				})
			}
		},

		selectPelanggans() {
			var app = this;
			axios.get(app.url+'/pelanggan')
			.then(function (resp) {
				app.pelanggans = resp.data;
				// console.log(resp.data);
			})
			.catch(function (resp) {
				alert("Could not load pelanggan");
			});
		},

		// ketika melakukan tombol bayar dan get ke methode store pada penjualanController
		saveForm(){
			var app = this;
			var total = app.penjualan.total_bayar;
			var Pembayaran = app.penjualan.bayar;
			
			app.penjualan.total_bayar = app.jumlahBayar;
			// app.penjualan.id_simpan_penjualan = app.id_simpan_penjualan;
			app.penjualan.bayar = app.penjualan.bayar;
			app.penjualan.kembalian = app.penjualan.kembalian;
			app.penjualan.subtotal = app.tbs_penjualans.total_bayar;
			app.penjualan.status_pemesanan = app.penjualan.status_pemesanan;
			app.penjualan.cara_bayar = 'Tunai';
			app.penjualan.diskon = app.diskonPerfaktur.rupiah;
			app.penjualan.keterangan = app.penjualan.keterangan;
			app.penjualan.pelanggan_id = app.penjualan.nama_pelanggan;
			var newPenjualan = app.penjualan;
			var validate = document.getElementById("bayar");
			var validates = document.getElementById("p");
			if (Pembayaran == 0 || Pembayaran == "") {
				app.$swal("Pembayaran tidak boleh kosong");
				// validate.style.boxShadow = '0 0 10px rgb(252, 107, 97)';
				// validates.innerHTML="Pembayaran tidak boleh kosong!!";
			}else if(app.penjualan.kembalian < 0){
				app.$swal("Jumlah pembayaran kurang!");
			}
			else{
				axios.post(app.url, newPenjualan)
				.then(function(resp){
					app.deleteSimpanPenjualan(app.id_simpan_penjualan);
					app.closeModal();
					swal({
						title: 'Berhasil!',
						type: 'success',
						text: 'Berhasil Melakukan Pembayaran ',
						showConfirmButton: false,
						timer: 2000,
					});
					app.getKategoriProduk();
					app.getProduksPenjualan();
					app.getTbsPenjualan();
					app.selectPelanggans();
					app.tbs_penjualans = '';
					app.pelanggans = '';
					app.diskonPerfaktur.rupiah = '';
					app.diskonPerfaktur.persen = '';
					app.penjualan.bayar = '';
					app.penjualan.kembalian = 0;
					app.penjualan.keterangan = '';
					app.penjualan.status_pemesanan = 0;
					app.penjualan.nama_pelanggan = 0;
					// console.log(resp.data.id_penjualan);
				})
				.catch(function (resp) {
					app.success = false;
					app.alert('Gagal');
				})
			}
		},
		saveForm2(){
			var app = this;
			var total = app.penjualan.total_bayar;
			var Pembayaran = app.penjualan.bayar;
			
			app.penjualan.total_bayar = app.jumlahBayar;
			// app.penjualan.id_simpan_penjualan = app.id_simpan_penjualan;
			app.penjualan.bayar = app.penjualan.bayar;
			app.penjualan.kembalian = app.penjualan.kembalian;
			app.penjualan.subtotal = app.tbs_penjualans.total_bayar;
			app.penjualan.status_pemesanan = app.penjualan.status_pemesanan;
			app.penjualan.cara_bayar = 'Tunai';
			app.penjualan.diskon = app.diskonPerfaktur.rupiah;
			app.penjualan.keterangan = app.penjualan.keterangan;
			app.penjualan.pelanggan_id = app.penjualan.nama_pelanggan;
			var newPenjualan = app.penjualan;
			var validate = document.getElementById("bayar");
			var validates = document.getElementById("p");
			if (Pembayaran == 0 || Pembayaran == "") {
				app.$swal("Pembayaran tidak boleh kosong");
				// validate.style.boxShadow = '0 0 10px rgb(252, 107, 97)';
				// validates.innerHTML="Pembayaran tidak boleh kosong!!";
			}else if(app.penjualan.kembalian < 0){
				app.$swal("Jumlah pembayaran kurang!");
			}
			else{
				axios.post(app.url, newPenjualan)
				.then(function(resp){
					app.deleteSimpanPenjualan(app.id_simpan_penjualan);
					app.closeModal();
					swal({
						title: 'Berhasil!',
						type: 'success',
						text: 'Berhasil Melakukan Pembayaran ',
						showConfirmButton: false,
						timer: 2000,
					});
					app.urlCetak(resp.data.id_penjualan);
					app.getKategoriProduk();
					app.getProduksPenjualan();
					app.getTbsPenjualan();
					app.selectPelanggans();
					app.tbs_penjualans = '';
					app.pelanggans = '';
					app.diskonPerfaktur.rupiah = '';
					app.diskonPerfaktur.persen = '';
					app.penjualan.bayar = '';
					app.penjualan.kembalian = 0;
					app.penjualan.keterangan = '';
					app.penjualan.status_pemesanan = 0;
					app.penjualan.nama_pelanggan = 0;
					// console.log(resp.data.id_penjualan);
				})
				.catch(function (resp) {
					app.success = false;
					app.alert('Gagal');
				})
			}
		},

		// create table simpan_penjualan dan simpan_detail_penjualan
		simpanPenjualan() {
			var app = this;
			app.penjualan.total_bayar = app.jumlahBayar;
			app.penjualan.id_simpan_penjualan = app.id_simpan_penjualan;
			app.penjualan.subtotal = app.tbs_penjualans.total_bayar;
			app.penjualan.cara_bayar = 'Tunai';
			app.penjualan.diskon = app.diskonPerfaktur.rupiah;
			app.penjualan.pelanggan_id = app.penjualan.nama_pelanggan;
			app.penjualan.nomor_meja = app.penjualan.nomor_meja;
			app.penjualan.catatan = app.penjualan.catatan;
			var newPenjualan = app.penjualan;
			axios.post(app.urlSimpanPenjualan, newPenjualan)
			.then(function (resp) {
				app.getKategoriProduk();
				app.getProduksPenjualan();
				app.getTbsPenjualan();
				app.selectPelanggans();
				app.tbs_penjualans = '';
				app.pelanggans = '';
				app.diskonPerfaktur.rupiah = '';
				app.diskonPerfaktur.persen = '';
				app.penjualan.bayar = '';
				app.penjualan.kembalian = 0;
				app.penjualan.keterangan = '';
				app.penjualan.id_simpan_penjualan = '';
				app.penjualan.nomor_meja = '';
				app.penjualan.catatan = '';
				app.penjualan.nama_pelanggan = '';
				// app.id_simpan_penjualan = '';
				app.penjualan.status_pemesanan = 0;
				app.alert('Berhasil disimpan');
				$('#modalSimpanPenjualan').hide();
				// console.log(app.id_simpan_penjualan);
			})
			.catch(function (resp) {
				app.alert('Gagal');
			});

		},
		// create table simpan_penjualan dan simpan_detail_penjualan
		simpanPenjualan2() {
			var app = this;
			app.penjualan.total_bayar = app.jumlahBayar;
			app.penjualan.id_simpan_penjualan = app.id_simpan_penjualan;
			app.penjualan.subtotal = app.tbs_penjualans.total_bayar;
			app.penjualan.cara_bayar = 'Tunai';
			app.penjualan.diskon = app.diskonPerfaktur.rupiah;
			app.penjualan.pelanggan_id = app.penjualan.nama_pelanggan;
			app.penjualan.nomor_meja = app.penjualan.nomor_meja;
			app.penjualan.catatan = app.penjualan.catatan;
			var newPenjualan = app.penjualan;
			axios.post(app.urlSimpanPenjualan, newPenjualan)
			.then(function (resp) {
				app.urlCetakPesanan(resp.data.id_penjualan);
				app.getKategoriProduk();
				app.getProduksPenjualan();
				app.getTbsPenjualan();
				app.selectPelanggans();
				app.tbs_penjualans = '';
				app.pelanggans = '';
				app.diskonPerfaktur.rupiah = '';
				app.diskonPerfaktur.persen = '';
				app.penjualan.bayar = '';
				app.penjualan.kembalian = 0;
				app.penjualan.keterangan = '';
				app.penjualan.id_simpan_penjualan = '';
				app.penjualan.nomor_meja = '';
				app.penjualan.catatan = '';
				app.penjualan.nama_pelanggan = '';
				// app.id_simpan_penjualan = '';
				app.penjualan.status_pemesanan = 0;
				app.alert('Berhasil disimpan');
				$('#modalSimpanPenjualan').hide();
				// console.log(app.id_simpan_penjualan);
			})
			.catch(function (resp) {
				app.alert('Gagal');
			});

		},

		// create or update tbs_penjulan / klik gambar produk
		submitTbsPenjualan(produksPenjualans){
			var app = this;
			app.inputTbsPenjualan.produk_id = produksPenjualans.data_produk.produk_id;
			app.inputTbsPenjualan.harga = produksPenjualans.data_produk.harga_jual;
			app.inputTbsPenjualan.satuan = produksPenjualans.data_produk.satuan;
			app.inputTbsPenjualan.jumlah = 1;
			var newTbs = app.inputTbsPenjualan;
			axios.post(app.urlTambahTbs, newTbs)
			.then(function (resp) {
				app.$router.replace('/penjualan');
				app.getTbsPenjualan();
				app.formDiskon.rupiah = '';
				app.diskonPerfaktur.persen = '';
				app.diskonPerfaktur.rupiah = '';
			})
			.catch(function (resp) {
				// console.log(resp)

				app.success = false;
				app.errors = resp.response.data.errors;
			});
		},

		openModalModifier(produksPenjualans){
			var app = this;
			app.getdataModifier(produksPenjualans.data_produk.produk_id);
			if (app.data_modifier.length > 0) {
				app.data_modifier.forEach(function (value, key) {
					$('#'+ value).addClass('btn-primary');
					$('#'+ value).removeClass('btn-default');
				});
				app.data_modifier = [];				
			}
			// console.log(app.data_modifier);
			app.inputTbsPenjualan.produk_id = produksPenjualans.data_produk.produk_id;
			app.inputTbsPenjualan.harga = produksPenjualans.data_produk.harga_jual;
			app.inputTbsPenjualan.satuan = produksPenjualans.data_produk.satuan;
			app.inputTbsPenjualan.jumlah = 1;
			$('#modalModifier').show();
			// console.log(app.inputTbsPenjualan.modifier);
		},
		// create or update tbs_penjulan if produk have modifier/ klik gambar produk
		submitTbsPenjualan2(){
			var app = this;
			app.inputTbsPenjualan.id_modifier = app.data_modifier;
			console.log('simpan:',app.inputTbsPenjualan.id_modifier);
			var newTbs = app.inputTbsPenjualan;
			axios.post(app.urlTambahTbs, newTbs)
			.then(function (resp) {
				app.$router.replace('/penjualan');
				app.inputTbsPenjualan.jumlah = '';
				app.getTbsPenjualan();
				app.formDiskon.rupiah = '';
				app.diskonPerfaktur.persen = '';
				app.diskonPerfaktur.rupiah = '';

			})
			.catch(function (resp) {
				app.success = false;
				app.errors = resp.response.data.errors;
			});
			$('#modalModifier').hide();
		},

		// klik button daftar modifier 
		getModifier(id_modifier) {
			let app = this;
			let indexModifier = app.data_modifier.indexOf(id_modifier);
			// console.log(app.data_modifier);
			if (indexModifier == -1) {
				app.data_modifier.push(id_modifier);
				$('#' + id_modifier).addClass('btn-default');
				$('#' + id_modifier).removeClass('btn-primary');
			}
			if (indexModifier != -1) {
				app.data_modifier.splice(indexModifier, 1);
				$('#' + id_modifier).addClass('btn-primary');
				$('#' + id_modifier).removeClass('btn-default');
			}
		},

		// data modifier per produk
		getdataModifier(id_produk){
			var app = this;
			axios.get(app.url + '/data-modifier/' + id_produk)
			.then(function(resp){
				app.modifier = resp.data;
				// console.log(resp.data)
			})
		},

		// tambah / kurang kwantitas produk pada tbs_penjualan
		simpanJumlahProduk(jumlah, harga_produk){
			var app = this;
			var subtotal = (jumlah * harga_produk);
			if (app.diskonPerproduk.persen > 0) {
				app.diskonPerproduk.rupiah = (subtotal * app.diskonPerproduk.persen) / 100;
				app.dataTbs.diskon =  app.diskonPerproduk.rupiah;
				app.dataTbs.diskon_persen =  app.diskonPerproduk.persen;
			}
			var newJumlah = app.dataTbs;
			axios.post(app.urlUpdateTbs, newJumlah)
			.then(function (resp) {
				app.inputTbsPenjualan.jumlah = ''	
				app.getTbsPenjualan();
				app.diskonPerfaktur.persen = '';
				app.diskonPerfaktur.rupiah = '';
				$("#modalJumlahProduk").hide();
			})
			.catch(function (resp) {
				app.errors = resp.response.data.errors;
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
				// console.log(resp.data);
			})
			.catch(function (resp) {
				alert("Tidak dapat memuat produk..");
				app.loading = false;
			});
		},

		deleteTbsPenjualan(id_tbs_penjualan) {
			var app = this;
			axios.delete(app.urlHapusTbs+ '/'+id_tbs_penjualan)
			.then(function (resp) {
				app.getTbsPenjualan();
				swal({
					title: 'Berhasil!',
					type: 'success',
					text: 'Berhasil menghapus',
					showConfirmButton: false,
					timer: 1000,
				});
			})
			.catch(function (resp) {
				app.$router.replace('/penjualan');
				swal({
					title: 'Gagal!',
					type: 'warning',
					text: 'Tidak dapat menghapus produk!'
				})
			});
			this.tbs_penjualans = '',
			this.diskonPerfaktur.rupiah = '',
			this.diskonPerfaktur.persen = '',
			this.diskonPerproduk.rupiah = '',
			this.diskonPerproduk.persen = '',
			this.$router.replace('/penjualan');
		},
		deleteSimpanPenjualan(id_simpan_penjualan) {
			var app = this;
			axios.delete(app.urlHapusSimpanPenjualan+ '/'+id_simpan_penjualan)
		},
		openModal(){
			$("#modalBayar").show();
			this.$refs.tunai.$el.focus();
		},
		openModalSimpanPenjualan(){
			$('#modalSimpanPenjualan').show();
			this.$refs.no_meja.focus();
		},
		modalDiskonFaktur(){
			$("#modalDiskonPenjualan").show();
			this.$refs.persen.focus(); 	
		},
		closeModal(){  
			$("#modalJumlahProduk").hide();
			$("#modalBayar").hide();
			$("#modalDiskonPenjualan").hide();
			$("#modalDiskonPenjualanPerProduk").hide();
			$("#modalSimpanPenjualan").hide();
			$("#modalModifier").hide();
		},

		tunai(){
			this.formTunai = 1
			this.formKartu = 0
		},
		
		diskonPenjualanProdukPersen(){
			this.diskonProduk = 1
			this.diskonProdukRp = 0
			this.$refs.diskon_persen.focus();
		},

		diskonPenjualanProdukRp(){
			this.diskonProduk = 0
			this.diskonProdukRp = 1
			this.$refs.diskon_rupiah.$el.focus();
		},

		diskonPenjualanFakturPersen(){
			this.diskonFaktur = 1
			this.diskonFakturRp = 0
			this.$refs.persen.focus()
		},

		diskonPenjualanFakturRp(){
			this.diskonFaktur = 0
			this.diskonFakturRp = 1
			this.$refs.rupiah.focus()
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

		alert(pesan) {
			this.$swal({
				title: "Berhasil!",
				text: pesan,
				icon: "success",
			});
		},
		urlCetak(id_penjualan){
			window.open('penjualan/cetak-penjualan?id_penjualan='+id_penjualan,'_blank');
		},
		urlCetakPesanan(id_penjualan){
			window.open('penjualan/cetak-pesanan?id_penjualan='+id_penjualan,'_blank');
		},
	}
}
</script>
