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
						<div class="btn-group">
							<button class="btn btn-primary active" id="1" v-on:click="getDataTransaksiPenjualan(1); getDataGrandTotal(1);">Harian</button>
							<button class="btn btn-primary" id="11" v-on:click="getDataTransaksiPenjualan(2); getDataGrandTotal(2);">Mingguan</button>	
							<button class="btn btn-primary" id="111" v-on:click="getDataTransaksiPenjualan(3); getDataGrandTotal(3);">Bulanan</button>
							<button class="btn btn-primary" id="1111" v-on:click="getDataTransaksiPenjualan(4); getDataGrandTotal(4);">Tahunan</button>
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
									<th>Subtotal</th>
									<th>Diskon</th>
									<th>Pajak</th>
									<th>Total</th>
								</tr>
							</thead>
							<tbody>
								<tr v-for="data_transaksi, index in data_transaksi_penjualan">
									<td>{{ data_transaksi.tanggal }}</td>
									<td>{{ data_transaksi.no_faktur }}</td>
									<td>Staf</td>
									<td>{{ data_transaksi.pelanggan }}</td>
									<td>Tunai</td>
									<td>{{ data_transaksi.catatan }}</td>
									<td>{{ data_transaksi.produk }}</td>
									<td>{{new Intl.NumberFormat().format(data_transaksi.subtotal) }}</td>
									<td>{{ data_transaksi.diskon }}</td>
									<td>0,00</td>
									<td>{{ new Intl.NumberFormat().format(data_transaksi.subtotal - data_transaksi.diskon) }}</td>
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
			data_transaksi_penjualan:[],
			grand_total_penjualan:[],
			url : window.location.origin + (window.location.pathname).replace("home", "laporan"),
		}
	},
	mounted(){
		var app = this;
		app.getDataTransaksiPenjualan();
		app.getDataGrandTotal();
			$(".btn-group > .btn").click(function(){
		    $(".btn-group > .btn").removeClass("active");
		    $(this).addClass("active");
		});
	},
	methods: {
		getDataTransaksiPenjualan(type = 1) {
			let app = this;
			axios.get(app.url+'/data-transaksi-penjualan/'+type)
			.then(function (resp){
			app.data_transaksi_penjualan = resp.data;
			})

		},
		getDataGrandTotal(type = 1){
			let app = this;
			axios.get(app.url+'/grand-total-penjualan/'+type)
			.then(function (resp){
				app.grand_total_penjualan = resp.data;
				console.log(resp.data)
			})
		}
	}
}
</script>