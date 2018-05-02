<style scoped>

.row .control-label {
	text-align: left;
}

.form-info {
	padding: 15px;
}

.tabInformasi{
	width: 33%;
	/*margin-bottom: 20px;*/
}

.tabKecil{
	width: 33%;
}

.scroll-panel-list-result {
	position: relative;
	height: 400px;
	overflow: auto;
	left: 5px;
}

.rata{
	margin-left: 10px;
}

.star{
	color: #ff0000;
}

.box{
	/*width: 300px;*/
	/*height:60px;*/
	margin-left: 10px;
	background-color: #FCF8E3;
	text-align: center;
	padding: 5px;
	border:1px solid #ffafaf;
}

.nav.nav-tabs li {
	border-right: 1px solid #eee;
}
.pawoon-result .nav-tabs {
	margin-bottom: 20px;
}

.nav-tabs {
	margin-bottom: 0px;
	border-bottom: none;
	background: #fff;
	box-shadow: 0 0 1px #eee;
}

.nav li {
	font-size: 14px;
}

.nav-tabs > li {
	margin-bottom: -1px;
}

div > ul > li[class=tabInformasi] a {
	color: #000000;
}
div > ul > li[class="tabInformasi active"] a {
	color: #F7AD36;
}
div > ul > li[class="tabInformasi active"] {
	border-bottom: 3px solid #F7AD36;
}

.test{
	background-color: white;
	margin-left: 20px;
	margin-top: -20px;
}
.mencoba{
	margin-top: 10px;
}

.head{
	background-color: #80ffe5;
	padding-bottom: 10px;
	padding-top: 10px;
}
.head-info{
	background-color: #80ffe5;
	padding-bottom: 10px;
	padding-top: 10px;
	padding-left: 20px;
}
.padding-detail{
	padding-left: 20px;
}
ul :hover {background: #ffd11a;}
.pointer {cursor: pointer;}
.not-allowed {cursor: not-allowed;}
.tablePenjelasan, .tableContoh {
	font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
	margin-bottom: 30px;
}

.tablePenjelasan td {
	padding-right: 5.5px;
	padding-bottom: 10px;
}
.bold {
	font-weight: bold;
}
.tableContoh {
	width: 95%;
}

.tableContoh th, .tableCdontoh td {
	padding: 2.5px 6px 2.5px 6px;
	border: 1px groove #eee;
}
</style>

<template>
	<div class="container">
		<div class="row">
			<div class="test" >
				<h4>MANAJEMEN PELANGGAN</h4>
			</div>


			<!-- Modal untuk import pelanggan -->
			<div id="modalImportPelanggan" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">Import Pelanggan</h4>
						</div>
						<div class="modal-body">
							<form v-on:submit.prevent="importPelanggan()" class="form-horizontal">

								<div class="form-group">
									<label for="template" class="col-md-2 control-label">Template</label>
									<div class="col-md-6">
										Gunakan <a name="template" :href="url_template_import_pelanggan">Template</a> untuk Import Pelanggan. Lihat <a style="color: blue;" data-toggle="modal" data-target="#modalCaraPengisianExcel" href="#">cara pengisian</a> untuk lebih detail.
									</div>
								</div>

								<div class="form-group">
									<label for="excel" class="col-md-2 control-label">Pilih file</label>
									<div class="col-md-4">
										<input name="excel" type="file" id="excel">
									</div>
								</div>

								<div class="form-group">
									<div class="col-md-4 col-md-offset-2">
										<input class="btn btn-primary" type="submit" value="Simpan">
									</div>
								</div>
							</form>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
						</div>
					</div>

				</div>
			</div>

			<!-- Modal Cara Pengisian Excel -->
			<div id="modalCaraPengisianExcel" class="modal animated fadeIn" role="dialog">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<h4>Cara Pengisian</h4>
						</div>
						<div class="modal-body">
							<div class="container">
								<table class="tablePenjelasan">
									<tbody>
										<tr>
											<td class="bold">Nama Pelanggan</td>
											<td>:</td>
											<td>Nama Pelanggan Anda.</td>
										</tr>
										<tr>
											<td class="bold">Jenis Kelamin</td>
											<td>:</td>
											<td>Jenis kelamin diisi laki-laki atau perempuan</td>
										</tr>
										<tr>
											<td class="bold">Tanggal Lahir</td>
											<td>:</td>
											<td>Tanggal Lahir diisi dengan format Tanggal/Bulan/Tahun/ (dd/mm/yyyy)</td>
										</tr>
										<tr>
											<td class="bold">Nomor Telepon</td>
											<td>:</td>
											<td>Nomor telepon diisi dengan maksimal 13 karakter, dan setiap pelanggan nomor teleponnya berbeda</td>
										</tr>
										<tr>
											<td class="bold">email</td>
											<td>:</td>
											<td>email diisi menggunakan format email(example@example.example)</td>
										</tr>
										<tr>
											<td class="bold">Alamat</td>
											<td>:</td>
											<td>Alamat diisi sesuai dengan alamat pelanggan</td>
										</tr>
										<tr>
											<td class="bold">Kota</td>
											<td>:</td>
											<td>Kota diisi sesuai dengan alamat pelanggan</td>
										</tr>
										<tr>
											<td class="bold">Kode Pos</td>
											<td>:</td>
											<td>Kode Pos diisi dengan maksimal 5 karakter</td>
										</tr>
										<tr>
											<td class="bold">Catatan</td>
											<td>:</td>
											<td>Catatan diisi apabila pelanggan ada catatan khusus</td>
										</tr>
									</tbody>
								</table>
								<div class="row">
									<div class="col-md-12">Contoh seperti tabel di bawah:</div>
								</div>
								<br>
								<div align="center">
									<table class="tableContoh" border="1px">
										<thead>
											<th><b>Nama Pelanggan</b></th>
											<th><b>Jenis Kelamin</b></th>
											<th><b>Tanggal Lahir</b></th>
											<th><b>Nomor Telepon</b></th>
											<th><b>Email</b></th>
											<th><b>Alamat</b></th>
											<th><b>Kota</b></th>
											<th><b>Kode Pos</b></th>
											<th><b>Catatan</b></th>
										</thead>
										<tbody>
											<tr>
												<td>Adi</td>
												<td align="right">laki-laki	</td>
												<td align="right">17/12/1997</td>
												<td align="right">08764537255</td>
												<td>adi@gmail.com</td>
												<td>Kedaton</td>
												<td>Bandar Lampung</td>
												<td>12345</td>
												<td>test pelanggan</td>
											</tr>
											<tr>
												<td>Galang</td>
												<td align="right">laki-laki	</td>
												<td align="right">14/10/1998</td>
												<td align="right">08776537255</td>
												<td>galang@gmail.com</td>
												<td>Kemiling</td>
												<td>Bandar Lampung</td>
												<td>12345</td>
												<td>Coba Pelanggan</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
						</div>
					</div>
				</div>
			</div>


		<!-- <div class="col-md-12">
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
		</div> -->

		<div class="mencoba">
			<div class="col-md-4">
				<div class="panel panel-default ">
					<div class="head" align="center">
						<span class="btn btn-success" data-toggle="modal" data-target="#modalImportPelanggan">
							<i class="fa fa-arrow-circle-o-up" aria-hidden="true"></i>
							Import
						</span>
						<a :href="url_export_pelanggan" class="btn btn-primary">
							<i class="fa fa-arrow-circle-o-down" aria-hidden="true"></i>
							Unduh
						</a>
						<button class="btn btn-primary" v-on:click="tambahPelanggan">
							<i class="fa fa-plus" aria-hidden="true"></i>
							Tambah
						</button>
					</div>
				</div>
				<div class="panel panel-default" border="1px">
					<div class="panel-body">
						<div class="panel-heading"> Menemukan : {{ pelanggans.length }} Pelanggan </div>
						<div class="row">
							<div class="col-md-12 pencarian">
								<input type="text" class="form-control" name="search" placeholder="Pencarian Pelanggan"  v-model="search" >
							</div>
						</div>	
					</div>	

					<ul class="scroll-panel-list-result">
						<li class="pointer" v-for="pelanggan ,index in pelanggans">
							<ul>
								<li class="detail_pelanggan"  v-on:click="detailPelanggan(pelanggan.id, pelanggan.kode_pelanggan, pelanggan.nama_pelanggan, pelanggan.jenis_kelamin, pelanggan.tanggal_lahir, pelanggan.nomor_telepon, pelanggan.email, pelanggan.kota, pelanggan.alamat, pelanggan.kode_pos, pelanggan.catatan)">
									<p>
										<br>
										<div class="col-md-3" v-if="pelanggan.jenis_kelamin == 1">
											<img :src="url_img_man" width="50px" height="60px"> 
										</div>
										<div class="col-md-3" v-else>
											<img :src="url_img_women" v-if="jenis_kelamin = 2" width="50px" height="60px">
										</div>												
										<span><font size="3px"><b>{{pelanggan.nama_pelanggan}}</b></font></span><br>
										<span><h5>{{pelanggan.kode_pelanggan}}</h5></span>
									</p> <br>
									<p class="padding-detail">
										<i class="fa fa-phone" aria-hidden="true"></i>
										<span>{{pelanggan.nomor_telepon}}</span>
										<br>
										<i class="fa fa-envelope-o" aria-hidden="true"></i>
										<span>{{pelanggan.email}}</span>
									</p>
								</li>
								<hr>
							</ul>
						</li>
					</ul>
				</div>

			</div>
		</div>


		<div class="col-md-8">
			<div class="panel panel-default">
				<div class="head-info">INFORMASI PELANGGAN</div>
			</div>
			<div class="panel panel-default">
				<ul class="nav nav-tabs" >
					<li id="nav_tentang_pelanggan" class="tabInformasi active">
						<a data-toggle="tab" v-on:click="tentangPelanggan">TENTANG PELANGGAN</a>
					</li>

					<li id="nav_riwayat_transaksi" class="tabInformasi">
						<a data-toggle="tab" v-on:click="riwayatTransaksi">RIWAYAT TRANSAKSI</a>
					</li>

					<li id="nav_perilaku" class="tabInformasi">
						<a data-toggle="tab" v-on:click="perilaku">PERILAKU</a>
					</li>
				</ul>

				<div class="panel-default" border="1px">
					<div class="row-fluid" v-if="formPelanggan == 1">

						<div class="col-md-12 form-info form-group">
							<div class="row">
								<span class="label box" >
									<font color="#000000">Kolom bertanda</font>
									<font size="2px" color="red">*</font>
									<font color="#000000">wajib diisi.</font>
								</span>
							</div>
						</div>

						<form v-on:submit.prevent="saveForm()" class="form-horizontal" >
							<div class="form-group" v-if="memberPelanggan == 1">
								<label for="kode_pelanggan" class="col-md-3 control-label rata">Member Id</label>
								<div class="col-md-8">
									<input class="form-control not-allowed" required autocomplete="off" placeholder="Member Id" type="text" v-model="pelanggan.kode_pelanggan" name="kode_pelanggan"  autofocus="" readonly>
									<span v-if="errors.kode_pelanggan" class="label label-danger">{{ errors.kode_pelanggan[0] }}</span>
								</div>
							</div>

							<div class="form-group">
								<label for="nama_pelanggan" class="col-md-3 control-label rata">Nama<font size="2px" color="red">*</font></label>
								<div class="col-md-8">
									<input class="form-control" required autocomplete="off" placeholder="Nama Pelanggan" type="text" v-model="pelanggan.nama_pelanggan" name="nama_pelanggan"  autofocus="" :disabled="disable == 1">
									<span v-if="errors.nama_pelanggan" class="label label-danger">{{ errors.nama_pelanggan[0] }}</span>
								</div>
							</div>

							<div class="form-group">
								<label for="jenis_kelamin'" class="col-md-3 control-label rata">Jenis Kelamin <font size="2px" color="red">*</font></label>
								<div class="col-md-8">
									<selectize-component v-model="pelanggan.jenis_kelamin" :settings="settings" :disabled="disable == 1"> 
										<option value="1"  >laki-laki</option>
										<option value="2"  >perempuan</option>
									</selectize-component>
									<span v-if="errors.jenis_kelamin" class="label label-danger">{{ errors.jenis_kelamin[0] }}</span>
								</div>
							</div>

							<!-- <div class="form-group">
								<label for="tanggal_lahir" class="col-md-3 control-label rata">Tanggal Lahir</label>
								<div class="col-md-8">
									<input class="form-control" autocomplete="off" placeholder="YYYY-MM-DD" type="date" v-model="pelanggan.tanggal_lahir" name="tanggal_lahir"  autofocus="" :disabled="disable == 1">
									<span v-if="errors.tanggal_lahir" class="label label-danger">{{ errors.tanggal_lahir[0] }}</span>
								</div>
							</div> -->

							<div class="form-group">
								<label for="tanggal_lahir" class="col-md-3 control-label rata">Tanggal Lahir</label>
								<div class="col-md-8">
									<!-- <input class="form-control" autocomplete="off" placeholder="YYYY-MM-DD" type="date" v-model="pelanggan.tanggal_lahir" name="tanggal_lahir"  autofocus="" :disabled="disable == 1"> -->
									<datepicker :input-class="'form-control'" placeholder="Tanggal Lahir" v-model="pelanggan.tanggal_lahir" name="tanggal_lahir" :disabled="disable == 1"></datepicker>
									<span v-if="errors.tanggal_lahir" class="label label-danger">{{ errors.tanggal_lahir[0] }}</span>
								</div>
							</div>

							<div class="form-group">
								<label for="nomor_telepon" class="col-md-3 control-label rata">Nomor Telepon <font size="2px" color="red">*</font></label>
								<div class="col-md-8">
									<input class="form-control" required autocomplete="off" placeholder="Nomor Telepon" type="number" v-model.phone="pelanggan.nomor_telepon" name="nomor_telepon"  autofocus="" :disabled="disable == 1">
									<span v-if="errors.nomor_telepon" class="label label-danger">{{ errors.nomor_telepon[0] }}</span>
								</div>
							</div>

							<div class="form-group">
								<label for="email" class="col-md-3 control-label rata">Email</label>
								<div class="col-md-8">
									<input class="form-control" autocomplete="off" placeholder="Email" type="email" v-model="pelanggan.email" name="email" autofocus="" :disabled="disable == 1 ">
									<span v-if="errors.email" id="email_error" class="label label-danger">{{ errors.email[0] }}</span>
								</div>
							</div>

							<div class="form-group">
								<label for="alamat" class="col-md-3 control-label rata">Alamat</label>
								<div class="col-md-8">
									<input class="form-control" autocomplete="off" placeholder="Alamat" type="text" v-model="pelanggan.alamat" name="alamat" autofocus="" :disabled="disable == 1">
									<span v-if="errors.alamat" class="label label-danger">{{ errors.alamat[0] }}</span>
								</div>
							</div>

							<div class="form-group">
								<label for="kota" class="col-md-3 control-label rata">Kota</label>
								<div class="col-md-8">
									<input class="form-control" autocomplete="off" placeholder="Kota" type="text" v-model="pelanggan.kota" name="kota" autofocus="" :disabled="disable == 1">
									<span v-if="errors.kota" id="email_error" class="label label-danger">{{ errors.kota[0] }}</span>
								</div>
							</div>

							<div class="form-group">
								<label for="catatan" class="col-md-3 control-label rata">Catatan</label>
								<div class="col-md-8">
									<textarea class="form-control" autocomplete="off" placeholder="Catatan" v-model="pelanggan.catatan" name="catatan"  autofocus="" :disabled="disable == 1"></textarea>
									<span v-if="errors.catatan" id="email_error" class="label label-danger">{{ errors.catatan[0] }}</span>
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-10 col-md-offset-1">

									<button v-if="tambah == 0" class="btn btn-warning" id="btnSimpanPelanggan" type="submit">
										<i class="fa fa-floppy-o" aria-hidden="true"></i>
										Simpan 
									</button>

									<button v-if="tambah == 0" class="btn btn-default" @click="onDisable">
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
						</form>
					</div>
				</div>

				<div class="row-fluid" v-if="riwayatBelanja == 1">
					<div class="panel-heading">
						<div class="form-group col-md-3 ">
							<selectize-component class="form-control" v-model="filter.priode" :settings="placeholder_priode" id="pilih_priode"> 
								<option v-bind:value=0>Semua</option>									
								<option v-bind:value=1>Hari ini</option>
								<option v-bind:value=2>7 hari terakhir</option>
								<option v-bind:value=3>30 hari terakhir</option>
								<option v-bind:value=4>1 tahun terakhir</option>
							</selectize-component>
						</div>
						<button class="btn btn-sm btn-default" @click="rentangWaktu()">Rentang Waktu</button>
					</div>
					<div class="panel panel-body">
						<div class="row">
							<div class="form-group col-md-3" id="rentang_waktu" style="display:none">
								<datepicker :input-class="'form-control'" placeholder="Dari Tanggal" v-model="filter.dari_tanggal" name="dari_tanggal" v-bind:id="'dari_tanggal'"></datepicker>			
							</div>
							<div class="col-xs-1" id="rentang_waktu2" style="display:none">s/d</div>
							<div class="form-group col-md-3" id="rentang_waktu3" style="display:none">
								<datepicker :input-class="'form-control'" placeholder="Sampai Tanggal" v-model="filter.sampai_tanggal" name="sampai_tanggal" v-bind:id="'sampai_tanggal'"></datepicker>
							</div>
							<div class="form-group col-md-1" id="rentang_waktu4" style="display:none">
								<button class="btn btn-primary" id="btnSubmit" type="submit" style="margin: 0px 0px;" @click="submitPostRiwayatTransaksi()"> Cari</button>
							</div>
							<div class="form-group col-md-2">
								<button class="btn btn-success">
									<i class="fa fa-download" aria-hidden="true"></i>
									Excel
								</button>
							</div>
						</div>
					</div>
					<table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
						<thead table table-striped table-hover>
							<tr>								
								<th class="col-md-2">Tanggal</th>
								<th class="col-md-4">Produk</th>
								<th class="col-md-3 text-right">Jumlah Produk</th>
								<th class="col-md-3 text-right">Total Transaksi</th>
							</tr>
						</thead>
						<tbody v-if="riwayat_transaksi.length > 0 && loading == false" class="data-ada">
							<tr v-for="riwayat_transaksis, index in riwayat_transaksi">								
								<td>{{riwayat_transaksis.riwayat_pelanggan.waktu | tanggal}}</td>
								<td>
									<ul>
										<li v-for="item in riwayat_transaksis.data_produk">
											{{ item.nama_produk  }}   X {{item.jumlah_produk }}
										</li>
									</ul>
								</td>								
								<td align="right">
									{{riwayat_transaksis.kwantitas.kwantitas | pemisahTitik}}
								</td>								
								<td align="right">
									{{riwayat_transaksis.riwayat_pelanggan.total_bayar | pemisahTitik}}
								</td>
							</tr>
							<tr>
								<td style="color: red; font-weight: bold">TOTAL</td>
								<td></td>
								<td align="right" style="color: red; font-weight: bold">{{total_riwayat_transaksi.jumlah_produks | pemisahTitik}}</td>
								<td align="right" style="color: red; font-weight: bold">{{total_riwayat_transaksi.total | pemisahTitik}}</td>
							</tr>
						</tbody>
						<tbody v-else-if="loading == true" class="data-ada" >
							<tr >
								<td colspan="4"  class="text-center">
									Sedang Memuat Data
								</td>
							</tr>
						</tbody>
						<tbody v-else class="tidak-ada-data">
							<tr>
								<td colspan="4"  class="text-center">
									Tidak Ada Data
								</td>
							</tr>
						</tbody>
					</table>
					<vue-simple-spinner v-if="loading"></vue-simple-spinner>
					<div align="right"><pagination :data="riwayatPelanggansData" v-on:pagination-change-page="getRiwayatTransaksi" :limit="3"></pagination></div>
				</div>

				<div class="row-fluid" v-if="perilakuPelanggan == 1">
					<div class="panel-body">
						<div class="table-responsive">
							<table class="table table-striped table-hover">
								<tbody>	
									<tr>
										<td>Jumlah Order</td>
										<td>{{perilaku_pelanggan.jumlah_order | pemisahTitik}}</td>
									</tr>
									<tr>
										<td>Total Belanja</td>
										<td>{{perilaku_pelanggan.total_belanja.total_bayars | pemisahTitik}}</td>
									</tr>
									<tr>
										<td>Rata-rata Belanja</td>
										<td>{{perilaku_pelanggan.rata_rata_belanja | pemisahTitik}}</td>
									</tr>
									<tr>
										<td>Terakhir Datang</td>
										<td v-if="perilaku_pelanggan.terakhir_datang == null">Tidak Ada</td>
										<td v-else>{{perilaku_pelanggan.terakhir_datang.created_at }}</td>						
									</tr>
									<tr>
										<td>Rata-rata Kedatangan</td>
										<td v-if="perilaku_pelanggan.terakhir_datang == null">Tidak Ada</td>
										<td v-else>Sebulan {{perilaku_pelanggan.rata_rata_datang}}x</td>
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
			id_pelanggan:'',
			pelanggans: [],
			data_produk: [],
			perilaku_pelanggan:{},
			riwayat_transaksi:[],
			riwayatPelanggansData:{},
			total_riwayat_transaksi:{},
			import_pelanggan: {
				excel: '',
			},
			export_pelanggan: {
				excel: '',
			},
			pelanggansData: {},
			url : window.location.origin+(window.location.pathname).replace("home","pelanggan"),
			url_img_man : window.location.origin+(window.location.pathname).replace("home","/images/man.png"),
			url_img_women : window.location.origin+(window.location.pathname).replace("home","/images/woman.png"),
			url_template_import_pelanggan : window.location.origin + (window.location.pathname).replace("home", "pelanggan/template_import"),
			url_import_pelanggan : window.location.origin + (window.location.pathname).replace("home", "pelanggan/import_pelanggan"),
			url_export_pelanggan : window.location.origin + (window.location.pathname).replace("home", "pelanggan/export_pelanggan"),
			search : '',
			loading : true,
			errors: [],
			pelanggan: {
				id: '',
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
			tambah: 1,
			formPelanggan: 1,
			memberPelanggan: 0,
			riwayatBelanja: 0,
			perilakuPelanggan:0,
			settings: {
				placeholder: 'Pilih Jenis Kelamin'
			},
			placeholder_priode: {
				placeholder: 'Pilih Priode'
			},
			filter: {
				id: '', //id pelanggan
				priode: '',
				dari_tanggal: '',
				sampai_tanggal: ''
			}
		}
	},
	
	mounted() {
		var app = this;
		app.loading = true
		app.getPelanggans();
	},

	filters: {
		pemisahTitik: function (value) {
			var angka = [value];
			var numberFormat = new Intl.NumberFormat('es-ES');
			var formatted = angka.map(numberFormat.format);
			return formatted.join('; ');
		},
		tanggal: function (value) {

			if (value){
				return moment(String(value)).format('MM/DD/YYYY hh:mm');
			}
		}
	},

	watch: {
        // whenever question changes, this function will run
        search: function (newQuestion) {
        	this.getHasilPencarian();  
        },
        'filter.priode': function(value) {
        	this.submitPriode();
        }
    },

    methods: {
    	submitPriode(){
    		this.filter.dari_tanggal = '';
    		this.filter.sampai_tanggal = '';
    		var newFilter = this.filter;
    		this.postRiwayatTransaksi();
    		this.postTotalRiwayatTransaksi();
    	},
    	rentangWaktu(){
    		var awal_tanggal = new Date();
    		awal_tanggal.setDate(1);
    		this.filter.dari_tanggal = awal_tanggal;
    		this.filter.sampai_tanggal = new Date();
    		$('#rentang_waktu').toggle();
    		$('#rentang_waktu2').toggle();
    		$('#rentang_waktu3').toggle();
    		$('#rentang_waktu4').toggle();
    	},

    	customFormatter(date) {
    		return moment(date).format('MMMM Do YYYY');
    	},

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
    		// this.pelanggan.kode_pelanggan = ''
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
    		this.tambah = 0
    		this.edit = 0
    		this.formPelanggan = 1
    		this.riwayatBelanja = 0
    		this.perilakuPelanggan = 0
    		this.memberPelanggan = 0
    	},

    	onDisable(){
    		this.disable = 1
    		this.tambah = 1
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
    		this.tambah = 1
    		this.edit = 1
    		this.formPelanggan = 1
    		this.riwayatBelanja = 0
    		this.perilakuPelanggan = 0
    		this.memberPelanggan =1

    		$(".detail_pelanggan").click(function () {
    			$("#nav_riwayat_transaksi").removeClass("active");
    			$("#nav_perilaku").removeClass("active");
    			$("#nav_tentang_pelanggan").addClass("active");
    		});

    		this.getPerilaku(id);
    		this.id_pelanggan = id;
    		this.filter.id = id;
    		this.getRiwayatTransaksi();
    		this.getTotalRiwayatTransaksi();
    	},
    	editPelanggan(){
    		this.disable = 2
    		this.edit = 0
    		this.tambah = 1
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
    			app.loading = false
    			alert("Could not load pelanggans");
    		});
    	},
    	getPerilaku(id){
    		var app = this;

    		axios.get(app.url+'/perilaku/'+id)
    		.then(function (resp) {
    			app.loading = false
    			app.perilaku_pelanggan = resp.data;
    		})
    		.catch(function (resp) {
    			app.loading = false;
    			alert("Could not load perilaku")
    		})
    	},
    	getRiwayatTransaksi(page){
    		var app = this;
    		var id = app.id_pelanggan;
    		app.loading = true;
    		if (typeof page === 'undefined') {
    			page = 1;
    		}
    		axios.get(app.url+'/riwayat_transaksi?id='+id+'&page='+page)
    		.then(function (resp) {
    			app.loading = false;
    			app.riwayat_transaksi = resp.data.data;
    			app.riwayatPelanggansData = resp.data;
    			console.log(resp.data.data)
    			// $.each(app.riwayat_transaksi, function(key, data) {
    			// 	axios.get(app.url+'/data_produk_per_tgl/'+app.riwayat_transaksi[key].created_at)
    			// 	.then(function (resp) {
    			// 		app.data_produk = resp.data;
    			// 		console.log(app.data_produk)
    			// 		console.log(app.data_produk)
    			// 	})
    			// 	.catch(function (resp) {
    			// 		app.loading = false;
    			// 		alert("Could not load data produk")
    			// 	})
    			// });   
    		})
    		.catch(function (resp) {
    			app.loading = false;
    			alert("Could not load riwayat transaksi")
    		})
    	},
    	getTotalRiwayatTransaksi(){
    		var app = this;
    		var id = app.id_pelanggan;
    		var newFilter = app.filter;
    		axios.get(app.url+'/total_riwayat_transaksi?id='+id)
    		.then(function (resp) {
    			app.loading = false;
    			app.total_riwayat_transaksi = resp.data;
    		})
    		.catch(function (resp) {
    			app.loading = false;
    			alert("Could not load total riwayat transaksi")
    		})
    	},
    	submitPostRiwayatTransaksi(page){
    		let app = this;
    		app.postRiwayatTransaksi();
    		app.postTotalRiwayatTransaksi();
    	},
    	postRiwayatTransaksi(page){
    		var app = this;
    		var newFilter = app.filter;
    		app.loading = true;
    		if (typeof page === 'undefined') {
    			page = 1;
    		}
    		axios.post(app.url+'/post_riwayat_transaksi', newFilter)
    		.then(function (resp) {
    			app.loading = false;
    			app.riwayat_transaksi = resp.data.data;
    			app.riwayatPelanggansData = resp.data;
    			console.log(resp.data.data)
    		})
    		.catch(function (resp) {
    			app.loading = false;
    			alert("Could not load post riwayat transaksi")
    		})
    	},
    	postTotalRiwayatTransaksi(){
    		var app = this;
    		var newFilter = app.filter;
    		axios.post(app.url+'/post_total_riwayat_transaksi', newFilter)
    		.then(function (resp) {
    			app.loading = false;
    			app.total_riwayat_transaksi = resp.data;
    		})
    		.catch(function (resp) {
    			app.loading = false;
    			alert("Could not load total riwayat transaksi")
    		})
    	},

    	saveForm() {
    		var app = this;
    		var Pelanggan = app.pelanggan;
    		axios.post(app.url, Pelanggan)
    		.then(function (resp) {
    			app.alerttt();

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
    			app.tambah = 1
    			memberPelanggan: 0,
    			app.$router.replace('/pelanggan');

    		})
    		.catch(function (resp) {
    			app.errors = resp.response.data.errors;
    		});
    	},
    	alerttt() {
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
    			app.memberPelanggan = 0

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
    			type : "warning",
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
    				axios.delete(app.url+'/' + app.pelanggan.id)
    				.then(function (resp) {
    					app.getPelanggans();
    					// swal({
    					// 	title: 'Berhasil!',
    					// 	type: 'success',
    					// 	text: 'Berhasil menghapus '+ app.pelanggan.nama_pelanggan
    					// })

    					if (resp.data.error == 1){
                            swal({
                                title: 'Gagal!',
                                type: 'warning',
                                text: 'Pelanggan sudah melakukan transaksi '
                            });
                        }else{
                            swal({
                                title: 'Berhasil!',
                                type: 'success',
                                text: 'Berhasil menghapus '+ app.pelanggan.nama_pelanggan
                            })
                        }
    				})
    				.catch(function (resp) {
    					app.$router.replace('/pelanggan/');
    					swal({
    						title: 'Gagal!',
    						type: 'warning',
    						text: 'Tidak dapat menghapus pelanggan!'
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
    			this.edit = 0

    			this.memberPelanggan = 0
    			this.$router.replace('/pelanggan/');
    		});
    	},

    	importPelanggan() {
    		var app = this;
    		let newPelanggan = new FormData();
    		let file = document.getElementById('excel').files[0];
    		if (file != undefined) {
    			newPelanggan.append('excel', file);
    		}
    		else {
    			// app.alert('Kosong!', 'Tolong masukkan file.', 'warning');
    			// return;
    			swal({
    				title: 'Kosong!',
    				type: 'warning',
    				text: 'Tolong masukkan file.'
    			})
    			return;
    		}

    		axios.post(app.url_import_pelanggan, newPelanggan)
    		.then(function (resp) {
    			// console.log(resp);
                // return;
                // Menampilkan pesan error jika nilai dari kolom Bisa Dijual
                // bukan bernilai ya atau tidak
                if (resp.data.errorMsg != undefined) {
                	// return app.alert('Gagal!', resp.data.pesan, 'warning');
                	return swal({
                		title: 'Gagal!',
                		type: 'warning',
                		html: '<div style="text-align: left; font-size: 14px;">'+ resp.data.errorMsg +'</div>',
                	});
                }

                swal({
                	title: 'Berhasil!',
                	type: 'success',
                	text: resp.data.jumlahPelanggan + ' Pelanggan berhasil diupload.'
                }),
                // app.alert('Berhasil!', 'Excel berhasil diupload.', 'success');
                app.getPelanggans();
                // app.$router.replace('/pelanggan/');
            })
    		.catch(function (resp) {
    			// console.log(resp.response)
    			if (resp.response.data.errors != undefined) {
    				app.errors = resp.response.data.errors.excel[0];
    			}

    			// app.alert('Gagal!', app.errors, 'warning');
    			else {
    				app.errors = "Ukuran file terlalu besar!";
    			}
    			return swal({
    				title: 'Gagal!',
    				type: 'warning',
    				text: app.errors,
    			})
    			// app.$router.replace('/pelanggan/');
    		});
    	}
    }
}
</script>

