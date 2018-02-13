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
									<tr>
										<td>2018-09-12</td>
										<td align="right">1</td>
										<td align="right">400.000</td>
										<td align="right">400.000</td>
									</tr>
									<tr>
										<td>2018-09-11</td>
										<td align="right">2</td>
										<td align="right">500.000</td>
										<td align="right">250.000</td>
									</tr>
									<tr>
										<td>2018-09-10</td>
										<td align="right">3</td>
										<td align="right">300.000</td>
										<td align="right">100.000</td>
									</tr>
								</tbody>
								<tfoot bgcolor="#d6d6c2">	
									<tr>
										<td><b><font color="#000000">Grand Total:</font></b></td>
										<td align="right"><b><font color="#000000">6</font></b></td>
										<td align="right"><b><font color="#000000">1.200.000</font></b></td>
										<td align="right"><b><font color="#000000">200.000</font></b></td>
									</tr>
								</tfoot>
						<!-- <tbody v-else-if="loading == true" class="data-ada" >
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
						</tbody> -->
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</template>
<script >

</script>