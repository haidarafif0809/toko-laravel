<style scoped>
.tombol-export{
	float: right;
}
.btn.active
{
	background-color:#002a38;
}
</style>
<template>
	<div class="container">
		<ul class="breadcrumb">
			<li><router-link :to="{name: 'indexDashboard'}">Home</router-link></li>
			<li><router-link :to="{name: 'indexLaporan'}">Laporan</router-link></li>
			<li class="active">Laporan Rekapitulasi Kas</li>
		</ul>
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<p class="panel-title">Laporan Rekapitulasi Kas</p>
					</div>
					<div class="panel-body">
						<div class="col-md-2" >
							<selectize-component class="form-control"  v-model="filter.priode" :settings="placeholder_priode" id="pilih_priode">
								<option v-bind:value="1">Hari ini</option>
								<option v-bind:value="2">7 hari terakhir</option>
								<option v-bind:value="3">30 hari terakhir</option>
								<option v-bind:value="4">1 tahun terakhir</option>
							</selectize-component>
						</div>
						<div class="tombol-export">
							<button class="btn btn-primary">Excel</button>
						</div>
						<br>
						<br>
						<div class="table-responsive col-md-12">
							<table class="table table-striped table-condensed table-responsive">
								<thead bgcolor="#d6d6c2">
									<tr>
										<th>TANGGAL & WAKTU	</th>
										<th>Jenis Kas</th>
										<th style="text-align:right">Jumlah</th>
										<th>Keterangan</th>
										<th>Staf</th>
									</tr>
								</thead>
								<tbody v-if="laporan_kas.length > 0">
									<tr v-for="laporan_kas ,index in laporan_kas">
										<td>
											{{ laporan_kas.tanggal }}
										</td>
										<td v-if="laporan_kas.type == 1">
											<!-- {{ (laporan_kas.type) }} -->
											<!-- <div v-if="laporan_kas.type == 1"> -->
												Kas Masuk 
											<!-- </div> -->
												<!-- <div v-else> -->
											<!-- </div> -->
										</td>
										<td v-else>
											Kas Keluar
										</td>
										<td align="right">
											{{ new Intl.NumberFormat().format(laporan_kas.jumlah) }}
										</td>
										<td>
											{{ (laporan_kas.keterangan) }}
										</td>
										<td>
											{{ (laporan_kas.nama_pemilik) }}
										</td>
									</tr>
								</tbody>
								<tbody v-else class="data-tidak-ada">
									<tr>
										<td colspan="4" class="text-center">Tidak Ada Data</td>
									</tr>
								</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</template>
<script>
export default{
	data: function(){
		return{
			laporan_kas:[],
// 			grand_total_penjualan:[],
			url : window.location.origin + (window.location.pathname).replace("home", "laporan"),
			placeholder_priode: {
				placeholder: 'Pilih Periode'
			},
			filter: {
				priode: '',
			}
		}
	},
	mounted(){
		var app = this;
		app.getDataLaporan();
		// app.getDataGrandTotal();
	},

	watch: {
        'filter.priode': function(value) {
        	this.getDataLaporan(this.filter.priode);
//         	this.getDataGrandTotal(this.filter.priode);
        }
    },

	methods: {
		getDataLaporan(type = 1){
			let app = this;
			axios.get(app.url+'/rekapitulasi-kas/?type=' + type)
			.then(function (resp){
				app.laporan_kas = resp.data;
				console.log(resp.data)
			})
		},
		// getDataGrandTotal(type = 1){
		// 	let app = this;
		// 	axios.get(app.url+'/grand-total-penjualan?type=' + type)
		// 	.then(function (resp){
		// 		app.grand_total_penjualan = resp.data;
		// 		console.log(resp.data)
		// 	})
		// },

	},
}
</script>