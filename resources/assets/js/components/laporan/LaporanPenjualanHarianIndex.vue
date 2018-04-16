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
			<li class="active">Laporan Penjualan Harian</li>
		</ul>
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<p class="panel-title">Laporan Penjualan Harian</p>
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
										<th>TANGGAL</th>
										<th style="text-align:right">JUMLAH PENJUALAN</th>
										<th style="text-align:right">TOTAL NOMINAL PENJUALAN (RP)</th>
										<th style="text-align:right">RATA-RATA NOMINAL PENJUALAN (RP)</th>
									</tr>
								</thead>
								<tbody v-if="laporan_penjualan_harian.length > 0">
									<tr v-for="laporan_penjualan_harians ,index in laporan_penjualan_harian">
										<td>
											{{ laporan_penjualan_harians.tanggal }}
										</td>
										<td align="right">
											{{ new Intl.NumberFormat().format(laporan_penjualan_harians.total_penjualan) }}
										</td>
										<td align="right">
											{{ new Intl.NumberFormat().format(laporan_penjualan_harians.total_pembayaran) }}
										</td>
										<td align="right">
											{{ new Intl.NumberFormat().format(laporan_penjualan_harians.total_pembayaran / laporan_penjualan_harians.total_penjualan) }}
										</td>
									</tr>
								</tbody>
								<tbody v-else class="data-tidak-ada">
									<tr>
										<td colspan="4" class="text-center">Tidak Ada Data</td>
									</tr>
								</tbody>
								<tfoot bgcolor="#d6d6c2">	
									<tr>
										<td><b color="#000000">Grand Total:</b></td>
										<td  v-if="grand_total_penjualan.total_penjualan > 0" align="right">
											<b color="#000000">
												{{ new Intl.NumberFormat().format(grand_total_penjualan.total_penjualan) }}
											</b>
										</td>
										<td v-else align="right">
											<b color="#000000">
												0
											</b>
										</td>
										<td v-if="grand_total_penjualan.total_pembayaran > 0" align="right">
											<b color="#000000">
												{{ new Intl.NumberFormat().format(grand_total_penjualan.total_pembayaran) }}
											</b>
										</td>
										<td v-else align="right">
											<b color="#000000">
												0
											</b>
										</td>
										<td v-if="grand_total_penjualan.total_penjualan > 0" align="right">
											<b color="#000000">
												{{ new Intl.NumberFormat().format(grand_total_penjualan.total_pembayaran / grand_total_penjualan.total_penjualan) }}
											</b>
										</td>
										<td v-else align="right"> <b color="#000000">
											0
										</b>
									</td>
								</tr>
							</tfoot>
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
			laporan_penjualan_harian:[],
			grand_total_penjualan:[],
			url : window.location.origin + (window.location.pathname).replace("home", "laporan"),
			placeholder_priode: {
				placeholder: 'Pilih Priode'
			},
			filter: {
				// id: '', //id pelanggan
				priode: '',
				// dari_tanggal: '',
				// sampai_tanggal: ''
			}
		}
	},
	mounted(){
		var app = this;
		app.getDataLaporan();
		app.getDataGrandTotal();
		// $(".btn-group > .btn").click(function(){
		// 	$(".btn-group > .btn").removeClass("active");
		// 	$(this).addClass("active");
		// });
	},

	watch: {
        'filter.priode': function(value) {
        	this.getDataLaporan(this.filter.priode);
        	this.getDataGrandTotal(this.filter.priode);
        }
    },

	methods: {
		getDataLaporan(type = 1){
			let app = this;
			axios.get(app.url+'/laporan-penjualan-harian/?type=' + type)
			.then(function (resp){
				app.laporan_penjualan_harian = resp.data;
				console.log(resp.data)
			})
		},
		getDataGrandTotal(type = 1){
			let app = this;
			axios.get(app.url+'/grand-total-penjualan?type=' + type)
			.then(function (resp){
				app.grand_total_penjualan = resp.data;
				console.log(resp.data)
			})
		},

	},
}
</script>