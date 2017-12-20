<style scoped>

</style>
<template>
	<div class="container">
		<div class="row">	
			<div class="col-md-3 col-sm-offset-1">
				<div class="panel panel-default">
					<div class="panel-heading">
						<p class="panel-title">Filter</p>
					</div>
					<div class="panel-body text-center">
						<div class="btn-group-vertical">
							<button class="btn btn-primary active">Harian</button>
							<button class="btn btn-primary">Mingguan</button>	
							<button class="btn btn-primary">Bulanan</button>
							<button class="btn btn-primary">Tahunan</button>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-7">
				<div class="panel panel-default">
					<div class="panel-heading">
						<p class="panel-title">Laporan Ringkas</p>
					</div>
					<div class="panel-body">
						<table class="table table-striped table-condensed">
							<thead>
								<tr>
								<th>Jenis Laporan</th>
								<th>Total Nominal(Rp)</th>
							    </tr>
							</thead>
							<tbody>
								<tr>
									<td>Penjualan</td>
									<td>0,00</td>
								</tr>
								<tr>
									<td>Diskon</td>
									<td>0,00</td>
								</tr>
								<tr>
									<td>Pembatalan</td>
									<td>0,00</td>
								</tr>
								<tr>
									<td>Penjualan bersih</td>
									<td>0,00</td>
								</tr>
								<tr>
									<td>Pajak</td>
									<td>0,00</td>
								</tr>
								<tr>
									<td>Pembulatan</td>
									<td>0,00</td>
								</tr>
								<tr>
									<td>Total Penerimaan</td>
									<td>0,00</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>