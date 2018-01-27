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
#box2{
	height: 400px;
	background-color: white;
	border: solid 4px #DDDDDD;
	border-radius: 4px;
	overflow: auto;
	box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
/*.button1{
	background-color: black;
	color: black;
	border: 2px solid #e7e7e7;
	border-radius:4px;
	width: 92px;
	height:60px;
}
.button1:hover {background-color: #424EF7;}
*/
.button2{
	background-color: black;
	color: white;
	border-radius:10px;
	width: 130px;
	height:60px;
	left: 10px;
	box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
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
.kategori{
	background-color: green;
	width: 200px;
	height: 50px;
	margin: 20px;
	float: right;
	text-align: center;
	color: white;
	right: 20px;
}
#modalPembayaran{
	width: 400px;
	height: 390px;
	border-radius:0px;
	color:#5E5E5E;
	display:block;
}
#modalDiskonFaktur{

}
.items{
	background-color: #F5F5F5;
	width: 770px;
	height: 25px;
	border: solid 2px #F5F5F5;
	box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);

}
/*#diskonFakturPersen:active{
	background-color: #E4E4E4;
	}*/

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
										<textarea style="width:400px;"></textarea>
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-4 control-label">Pelanggan</label>
									<div class="col-md-6">
										<selectize-component>
											<option>Khoiruk</option>
											<option>Zamhar</option>
											<option>Rizal</option>
										</selectize-component>	
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

						</div>
						<div class="modal-body">
							<form v-on:submit.prevent="" class="form-horizontal">
								<input class="form-control" required autocomplete="off" placeholder="%" type="number" name="diskonFakturRp"  autofocus="" v-if="diskonPerFakturPersen == 1" >
								<input class="form-control" required autocomplete="off" placeholder="Rp" type="number" name="diskonFakturPersen"  autofocus="" v-if="diskonPerFakturRp == 1" >
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

			<div class="row">
				<div class="col-md-4" id="box1">

					<h1 style="float:right;position:relative;">100.000</h1>
					<tr>
						<td>Subtotal</td>
						<td style="width:25px;" align="center">:</td>
						<td>100.000</td>
					</tr>
					<tr>
						<td>Diskon</td>
						<td style="width:25px;" align="center">:</td>
					</tr>
					<tr>
						<td>Pajak</td>
						<td style="width:25px;" align="center">:</td>
					</tr>

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

							</div>
						</div>
					</div>
				</div>
			</div>
	<!-- <div class="produk">
		<p>Es cream cappucino</p>
	</div> -->


	<div class="row">
		<div class="col-md-4" id="box2">
			<br>
			<div class="input-group">
				<input type="text" id="pencarian" placeholder=" Cari Produk">
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
	</div>
	<br>

	<div class="row">
		<button class="button button2">Simpan</button>
		<button class="button button3" data-toggle="modal" data-target="#modalDiskonPerfaktur">Diskon</button>
		<button class="button button4" data-toggle="modal" data-target="#modalBayar" >Bayar</button>
	</div>

</div>
</template>
<script>
export default {
	data:function(){
		return {
			formBayar: '',

			diskonPerFakturPersen: 1,
			diskonPerFakturRp: 0,
			kategori_produks: [],
			url : window.location.origin + (window.location.pathname).replace("home", "penjualan"),
			loading: true,
		}
	},

	mounted(){
		var app = this;
		app.getKategoriProduk();
		app.loading = true
	},

	watch: {

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
