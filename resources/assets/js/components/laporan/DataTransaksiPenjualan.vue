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
			<li class="active">Data Transaksi Penjualan</li>
		</ul>
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<p class="panel-title">Data Transaksi Penjualan</p>
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
									<th>Tanggal</th>
									<th>Order</th>
									<th>Staf</th>
									<th>Pelanggan</th>
									<th>Pembayaran</th>
									<th>Catatan</th>
									<th>Produk</th>
									<th class="text-right">Subtotal</th>
									<th class="text-right">Diskon</th>
									<th class="text-right">Pajak</th>
									<th class="text-right">Total</th>
								</tr>
							</thead>
							<tbody >
								<tr v-for="data_transaksi, index in data_transaksi_penjualan">
									<td>{{ data_transaksi.tanggal }}</td>
									<td>{{ data_transaksi.no_faktur }}</td>
									<td>Staf</td>
									<td>{{ data_transaksi.pelanggan }}</td>
									<td>Tunai</td>
									<td>{{ data_transaksi.catatan }}</td>
									<td>
										<ul>
											<li v-for="data in data_transaksi.detail_produk">
												{{ data.nama_produk }} x {{ data.jumlah_produk}}
											</li>
										</ul>
									</td>
									<td align="right">{{new Intl.NumberFormat().format(data_transaksi.subtotal) }}</td>
									<td v-if="data_transaksi.diskon == null" align="right">0</td>
									<td v-else align="right">{{ data_transaksi.diskon }}</td>
									<td v-if="data_transaksi.pajak == null" align="right">0</td>
									<td v-else align="right">{{data_transaksi.pajak}}</td>	
									<td align="right">{{ new Intl.NumberFormat().format(data_transaksi.subtotal - data_transaksi.diskon) }}</td>
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
			loading : true,
			data_transaksi_penjualan:[],
			grand_total_penjualan:[],
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
		app.getDataTransaksiPenjualan();
		app.getDataGrandTotal();
	},

	watch: {
        'filter.priode': function(value) {
        	this.getDataTransaksiPenjualan(this.filter.priode);
        	this.getDataGrandTotal(this.filter.priode);
        }
    },

	methods: {
		getDataTransaksiPenjualan(type = 1) {
			let app = this;
			axios.get(app.url+'/data-transaksi-penjualan/?type=' + type)
			.then(function (resp){
				app.data_transaksi_penjualan = resp.data;
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
		}
	}
}
</script>