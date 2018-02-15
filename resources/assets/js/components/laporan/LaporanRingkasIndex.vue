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
	      <li class="active">Laporan Ringkas</li>
	    </ul>
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<p class="panel-title">Laporan Ringkas</p>
					</div>
					<div class="panel-body">
						<div class="btn-group">
							<button class="btn btn-primary active">Harian</button>
							<button class="btn btn-primary">Mingguan</button>	
							<button class="btn btn-primary">Bulanan</button>
							<button class="btn btn-primary">Tahunan</button>
						</div>
						<div class="tombol-export">
							<button class="btn btn-primary">Excel</button>
						</div>
						<br>
						<br>
						<table class="table table-striped table-condensed table-responsive">
							<thead>
								<tr>
								<th>Jenis Laporan</th>
								<th>Total Nominal(Rp)</th>
							    </tr>
							</thead>
							<tbody>
								<tr>
									<td>Penjualan</td>
									<td v-if="laporan_ringkas.subtotal > 0">
										{{ "Rp" }}{{ new Intl.NumberFormat().format(laporan_ringkas.subtotal) }}
									</td>
									<td v-else>
										0,00
									</td>
								</tr>
								<tr>
									<td>Diskon</td>
									<td v-if="laporan_ringkas.diskon > 0">
										{{ "Rp" }}{{ new Intl.NumberFormat().format(laporan_ringkas.diskon) }}
									</td>
									<td v-else>
										0,00
									</td>
								</tr>
								<tr>
									<td>Penjualan bersih</td>
									<td v-if="laporan_ringkas.subtotal - laporan_ringkas.diskon > 0">
										{{ "Rp" }}{{ new Intl.NumberFormat().format(laporan_ringkas.subtotal - laporan_ringkas.diskon) }}
									</td>
									<td v-else>
										0,00
									</td>
								</tr>
								<tr>
									<td>Pajak</td>
									<td>0,00</td>
								</tr>
								<tr>
									<td>Total Penerimaan</td>
									<td v-if="laporan_ringkas.subtotal - laporan_ringkas.diskon > 0">
										{{ "Rp" }}{{ new Intl.NumberFormat().format(laporan_ringkas.subtotal - laporan_ringkas.diskon) }}
									</td>
									<td v-else>
										0,00
									</td>
								</tr>
							</tbody>
						</table>
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
				laporan_ringkas:[],
				url : window.location.origin + (window.location.pathname).replace("home", "laporan"),
			}
		},
		mounted(){
			var app = this;
			app.getDataLaporan();
		},
		methods: {
			getDataLaporan(){
				let app = this;
				axios.get(app.url+'/laporan-ringkas/')
				.then(function (resp){
					app.laporan_ringkas = resp.data;
					console.log(resp.data)
				})
			}
		}
	}
</script>