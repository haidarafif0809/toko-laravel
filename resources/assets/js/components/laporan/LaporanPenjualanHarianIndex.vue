<style scoped>
.tombol-export{
	float: right;
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
						<div class="btn-group">
							<button class="btn btn-default">Harian</button>
							<button class="btn btn-default">Mingguan</button>	
							<button class="btn btn-default">Bulanan</button>
							<button class="btn btn-default">Tahunan</button>
							<button class="btn btn-default">Rentang Waktu</button>
						</div>
						<div class="tombol-export">
							<button class="btn btn-primary">Excel</button>
						</div>
						<br>
						<br>
						<div class="table-responsive">
							<table class="table table-striped table-condensed table-responsive">
								<thead bgcolor="#d6d6c2">
									<tr>
										<th>TANGGAL</th>
										<th style="text-align:right">JUMLAH PENJUALAN</th>
										<th style="text-align:right">TOTAL NOMINAL PENJUALAN (RP)</th>
										<th style="text-align:right">RATA-RATA NOMINAL PENJUALAN (RP)</th>
									</tr>
								</thead>
								<tbody >
									<tr v-for="laporan_penjualan_harians ,index in laporan_penjualan_harian">
										<td>
											{{ laporan_penjualan_harians.tanggal }}
										</td>
										<td align="right">
											{{ new Intl.NumberFormat().format(laporan_penjualan_harians.jumlah_penjualan) }}
										</td>
										<td align="right">
											{{ new Intl.NumberFormat().format(laporan_penjualan_harians.total_pembayaran) }}
										</td>
										<td align="right">
											{{ new Intl.NumberFormat().format(laporan_penjualan_harians.total_pembayaran / laporan_penjualan_harians.jumlah_penjualan) }}
										</td>
									</tr>
								</tbody>
								<tfoot bgcolor="#d6d6c2">	
									<tr>
										<td><b><font color="#000000">Grand Total:</font></b></td>
										<td align="right"><b><font color="#000000">
											{{ new Intl.NumberFormat().format(grand_total_penjualan.total_penjualan) }}
										</font></b></td>
										<td align="right"><b><font color="#000000">
											{{ new Intl.NumberFormat().format(grand_total_penjualan.total_pembayaran) }}
										</font></b></td>
										<td v-if="grand_total_penjualan.total_penjualan > 0" align="right"><b><font color="#000000">
											{{ (grand_total_penjualan.total_pembayaran / grand_total_penjualan.total_penjualan) }}
										</font></b></td>
										<td v-else align="right"> <b><font color="#000000">
											0
										</font></b></td>
										<!-- <td align="right"><b><font color="#000000">
											{{ (grand_total_penjualan.total_pembayaran / grand_total_penjualan.total_penjualan).toFixed(2) }}
										</font></b></td> -->
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
		}
	},
	mounted(){
		var app = this;
		app.getDataLaporan();
		app.getDataGrandTotal();
	},
	methods: {
		getDataLaporan(){
			let app = this;
			axios.get(app.url+'/laporan-penjualan-harian/')
			.then(function (resp){
				app.laporan_penjualan_harian = resp.data;
				console.log(resp.data)
			})
		},
		getDataGrandTotal(){
			let app = this;
			axios.get(app.url+'/grand-total-penjualan/')
			.then(function (resp){
				app.grand_total_penjualan = resp.data;
				console.log(resp.data)
			})
		}
	}
}
</script>