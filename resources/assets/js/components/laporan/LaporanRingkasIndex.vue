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
			<li class="active">Laporan Ringkas</li>
		</ul>
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<p class="panel-title">Laporan Ringkas</p>
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
						<table class="table table-striped table-condensed table-responsive">
							<thead>
								<tr>
									<th>Jenis Laporan</th>
									<th style="text-align:right">Total Nominal(Rp)</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>Penjualan</td>
									<td v-if="laporan_ringkas.subtotal > 0" align="right">
										{{ new Intl.NumberFormat().format(laporan_ringkas.subtotal) }}
									</td>
									<td v-else align="right">
										0,00
									</td>
								</tr>
								<tr>
									<td>Diskon</td>
									<td v-if="laporan_ringkas.diskon > 0" align="right">
										{{ new Intl.NumberFormat().format(laporan_ringkas.diskon) }}
									</td>
									<td v-else align="right">
										0,00
									</td>
								</tr>
								<tr>
									<td>Penjualan bersih</td>
									<td v-if="laporan_ringkas.subtotal - laporan_ringkas.diskon > 0" align="right">
										{{ new Intl.NumberFormat().format(laporan_ringkas.subtotal - laporan_ringkas.diskon) }}
									</td>
									<td v-else align="right">
										0,00
									</td>
								</tr>
								<tr>
									<td>Pajak</td>
									<td align="right">0,00</td>
								</tr>
								<tr>
									<td>Total Penerimaan</td>
									<td v-if="laporan_ringkas.subtotal - laporan_ringkas.diskon > 0" align="right">
										{{ new Intl.NumberFormat().format(laporan_ringkas.subtotal - laporan_ringkas.diskon) }}
									</td>
									<td v-else align="right">
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
			placeholder_priode: {
				placeholder: 'Pilih Periode'
			},
			filter: {
				// id: '', //id pelanggan
				priode: '',
				// dari_tanggal: '',
				// sampai_tanggal: ''
			},
		}
	},
	mounted(){
		var app = this;
		app.getDataLaporan();
		// $(".btn-group > .btn").click(function(){
		// 	$(".btn-group > .btn").removeClass("active");
		// 	$(this).addClass("active");
		// });
	},

	watch: {
        'filter.priode': function(value) {
        	this.getDataLaporan(this.filter.priode);
        	// this.getDataGrandTotal(this.filter.priode);
        }
    },

	methods: {
		getDataLaporan(type = 1){
			let app = this;
			axios.get(app.url+'/laporan-ringkas/?type=' + type)
			.then(function (resp){
				app.laporan_ringkas = resp.data;
				console.log(resp.data)
			})
		}
	}
}
</script>