<style scoped>
span{
	border-top: 1px dotted black;
}
.pencarian {
	color: red;

	float: right;
	padding-bottom: 50px;
}
.waktu{
	margin: 1px;
}
</style>

<template>  
	<div class="container">
		<!-- modal  -->
		<div class="modal" id="modalDetail" role="dialog" aria-hidden="true" >
			<div class="modal-dialog modal-medium">
				<div class="modal-content">
					<form class="form-horizontal" v-on:submit.prevent="">
						<div class="data" v-for ="detail_penjualans, index in detail_penjualan">
							<div class="modal-header">
								<label>Detai Penjualan</label>
								<button type="button" class="close"  v-on:click="closeModal()">&times;</button> 
							</div>
							<div class="modal-body"  >
								<span class="col-xs-4">No. Pesanan</span>  
								<span class="col-xs-8">

									<span>: #{{detail_penjualans.penjualan.id}}</span>

								</span>
								<span class="col-xs-4">Tanggal</span>  
								<span class="col-xs-8">

									<span>: {{detail_penjualans.penjualan.created_at | tanggal}}</span>

								</span>
								<span class="col-xs-4">Kasir</span>  
								<span class="col-xs-8">

									<span>: {{detail_penjualans.penjualan.nama_pemilik }}</span>

								</span>
								<span class="col-xs-4">Pesanan</span>  
								<span class="col-xs-8">
									<div  v-for="data, index in detail_penjualans.detail_penjualan">
										<tr>- {{data.nama_produk}} x {{data.jumlah_produk}}</tr>
										<tr v-if="data.id_modifier != null">
											<span v-for="datas, index in data.nama_modifier">+ {{datas.nama_modifier}}, </span>
										</tr>
										<p></p>
									</div>

								</span>
								<span class="col-xs-4">Total</span>  
								<span class="col-xs-8">

									<span>: {{detail_penjualans.penjualan.total_bayar | pemisahTitik }}</span>

								</span>
								<div class="form-group">
									<label class="col-xs-12 control-label"></label>
								</div>

							</div>

							<div class="modal-footer">
								<button type="button" class="btn btn-simple" v-on:click="closeModal()">Keluar</button>
								<button type="submit" class="btn btn-info" @click="urlCetak(detail_penjualans.penjualan.id)">Cetak Struk</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<!-- _____________________________________________________________________________________________________________________ -->
		<ul class="breadcrumb">
			<li><router-link :to="{name: 'indexDashboard'}">Home</router-link></li>
			<li class="active">Riwayat Penjualan</li>
		</ul>
		<div class="panel panel-default">
			<div class="panel-heading"><i class="fa fa-bookmark"></i> Riwayat Penjualan</div>
			<div class="panel-body">
				<div class="form-group col-md-2 ">
					<selectize-component class="form-control" v-model="filter.priode" :settings="placeholder_priode" id="pilih_priode"> 
						<option v-bind:value=0>Semua</option>									
						<option v-bind:value=1>Hari ini</option>
						<option v-bind:value=2>7 hari terakhir</option>
						<option v-bind:value=3>30 hari terakhir</option>
						<option v-bind:value=4>1 tahun terakhir</option>
					</selectize-component>
				</div>
				<button class="btn btn-md btn-primary" @click="rentangWaktu()">Rentang Waktu</button>
				<div class="table-responsive table">
					<div class="waktu">
						<div class="form-group col-md-2" id="rentang_waktu1" style="display:none">
							<datepicker :input-class="'form-control'" placeholder="Dari Tanggal" v-model="filter.dari_tanggal" name="dari_tanggal" v-bind:id="'dari_tanggal'"></datepicker>			
						</div>
						<div class="form-group col-md-2" id="rentang_waktu2" style="display:none">
							<datepicker :input-class="'form-control'" placeholder="Sampai Tanggal" v-model="filter.sampai_tanggal" name="sampai_tanggal" v-bind:id="'sampai_tanggal'"></datepicker>
						</div>
						<div class="form-group col-md-1" id="rentang_waktu3" style="display:none">
							<button class="btn btn-primary" id="btnSubmit" type="submit" style="margin: 0px 0px;" @click="submitPostRiwayatTransaksi()"> Cari</button>
						</div>
					</div>        
					<div class="pencarian">
						<input type="text" class="form-control" name="search"placeholder="Pencarian"  v-model="search" >
					</div>
					<table class="table table-striped table-no-bordered">
						<thead class="thead-dark">
							<th class="">Tanggal / Waktu</th>
							<th class="">Status</th>
							<th class="text-right">Diskon</th>
							<th class="text-right">Tunai</th>
						</thead>
						<tbody v-if="riwayat_penjualan.length > 0 && loading == false" class="data-ada">
							<tr v-for="riwayat_penjualans ,index in riwayat_penjualan">
								<td>{{ riwayat_penjualans.data_riwayat_penjualan.waktu | tanggal}}</td>
								<td>Sukses</td>
								<td align="right">{{ riwayat_penjualans.data_riwayat_penjualan.diskon | pemisahTitik}}</td>
								<td align="right">{{ riwayat_penjualans.data_riwayat_penjualan.total_bayar | pemisahTitik}}</td>
								<td>
									<button class="btn btn-xs btn-primary" id="btnSimpanKategoriProduk" @click="modalDetailRiwayatPenjualan(riwayat_penjualans.data_riwayat_penjualan.id)" type="submit">Detail</button>
								</td>
							</tr>
						</tbody>
						<tbody v-else-if="loading == true" class="data-ada" >
							<tr >
								<td colspan="6"  class="text-center">
									Sedang Memuat Data
								</td>
							</tr>
						</tbody>
						<tbody v-else class="tidak-ada-data">
							<tr>
								<td colspan="6"  class="text-center">
									Tidak Ada Data
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<vue-simple-spinner v-if="loading"></vue-simple-spinner>
				<div align="right"><pagination :data="riwayat_penjualan_data" v-on:pagination-change-page="getRiwayatPenjualan" v-if="search == '' "></pagination></div>
				<div align="right"><pagination :data="riwayat_penjualan_data" v-on:pagination-change-page="getRiwayatPenjualan" v-if="search != '' "></pagination></div>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	data: function () {
		return {
			detail_penjualan: [],
			riwayat_penjualan: [],
			riwayat_penjualan_data: {},
			filter:{
				priode:'',
				dari_tanggal: '',
				sampai_tanggal:''
			},
			url : window.location.origin+(window.location.pathname).replace("home","penjualan"),
			search : '',
			loading : true,
			placeholder_priode:{
				placeholder: 'PILIH PRIODE'
			},

		}
	},
	mounted() {
		var app = this;
		app.loading = true;
		app.getRiwayatPenjualan();   
	},
	filters: {
		pemisahTitik: function(value) {
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
    	submitPostRiwayatTransaksi()
    	{
    		var app = this;
    		var filter = app.filter;
    		app.getRiwayatPenjualan();
    	},
    	submitPriode()
    	{
    		var app = this;
    		app.filter.dari_tanggal = '';
    		app.filter.sampai_tanggal = '';
    		var filter = app.filter;
    		app.getRiwayatPenjualan();
    	},
    	// menampilkan data simpan penjualan
    	getRiwayatPenjualan(page) {
    		var app = this;
    		if (typeof page === 'undefined') {
    			page = 1;
    		}
    		var filter = app.filter;
    		axios.post(app.url+'/riwayat-penjualan?page='+ page, filter)
    		.then(function (resp) {
    			app.loading = false
    			app.riwayat_penjualan = resp.data.data;
    			app.riwayat_penjualan_data = resp.data
    		})
    		.catch(function (resp) {
    			alert("Could not load riwayat_penjualan");
    		});
    	},

    	modalDetailRiwayatPenjualan(id) {
    		var app = this;
    		axios.get(app.url+ '/detail-riwayat-penjualan?id=' +id)
    		.then(function(resp){
    			app.detail_penjualan = resp.data;
    			console.log(resp.data)
    			$('#modalDetail').show();
    		})
    	},
    	closeModal(id) {
    		$('#modalDetail').hide();
    	},
    	rentangWaktu(){
    		var app = this;
    		var awal_tanggal = new Date();
    		awal_tanggal.setDate(1);
    		app.filter.dari_tanggal = awal_tanggal;
    		app.filter.sampai_tanggal = new Date();
    		$('#rentang_waktu1').toggle();
    		$('#rentang_waktu2').toggle();
    		$('#rentang_waktu3').toggle();
    	},
    	urlCetak(id_penjualan){
    		window.open('penjualan/cetak-penjualan?id_penjualan='+id_penjualan,'_blank');
    	}
    	// getHasilPencarian(page){
    	// 	var app = this;
    	// 	app.loading = true;
    	// 	if (typeof page === 'undefined') {
    	// 		page = 1;
    	// 	}
    	// 	axios.get(app.url+'/search?search='+app.search+'&page='+page)
    	// 	.then(function (resp) {
    	// 		app.loading = false
    	// 		app.riwayat_penjualan = resp.data.data;
    	// 		app.riwayat_penjualan_data = resp.data;
    	// 	})
    	// 	.catch(function (resp) {
    	// 		console.log(resp);
    	// 		app.loading = false
    	// 		alert("Could not load riwayat_penjualan");
    	// 	});

    	// }
    }

}
</script>