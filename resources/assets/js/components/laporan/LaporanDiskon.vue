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
			<li class="active">Laporan Diskon</li>
		</ul>
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<p class="panel-title">Laporan Diskon</p>
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
										<th>KETERANGAN PENJUALAN</th>
										<th style="text-align:right">NOMINAL DISKON (RP)</th>
									</tr>
								</thead>
								<tbody v-if="laporan_diskon.length > 0">
									<tr v-for="laporan_diskons ,index in laporan_diskon">
										<td>
											{{ laporan_diskons.tanggal }}
										</td>
										<td>
											{{ (laporan_diskons.keterangan) }}
										</td>
										<td align="right">
											{{ new Intl.NumberFormat().format(laporan_diskons.diskon) }}
										</td>									</tr>
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
			laporan_diskon:[],
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
			axios.get(app.url+'/laporan-diskon/?type=' + type)
			.then(function (resp){
				app.laporan_diskon = resp.data;
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