<style scoped>
.box{
	padding: 30px 5px 30px 5px;
	background: #ffff;
	border: 1px solid #ddd;
	border-radius: 5px;
	margin-bottom: 25px;
	max-height: 173px;
}
.judul{
	font-size: 18px;
	font-weight: 400;
	text-align: center;
	color:#707070;
}
.box:hover, .box:hover p{
	background-color: #00BCD4;
	color:#fff;
}
a:-webkit-any-link {
	text-decoration: none;
}
.keterangan{
	color:#707070;
	font-size: 14px;
	font-weight: 100;
}
p{margin:0px;}
i{margin-bottom: 20px}
</style>

<template>
	<div class="container">
		<ul class="breadcrumb">
			<li><router-link :to="{name: 'indexDashboard'}">Home</router-link></li>
			<li class="active">Laporan</li>
		</ul>
		<div class="panel panel-info">
			<div class="panel-heading">
				<span class="panel-title">Laporan</span>
			</div>
			<div class="panel-body text-center">
				<div class="col-md-4">
					<router-link :to="{name: 'indexLaporanRingkas'}">
						<div class="box">
							<i class="fa fa-book fa-3x"></i>
							<p class="judul">Laporan Ringkas</p>
							<p class="keterangan">Menunjukkan laporan penjualan secara umum.</p>
						</div>
					</router-link>
				</div>
				<div class="col-md-4">
					<router-link :to="{name: 'indexLaporanPenjualanHarian'}">
						<div class="box">
							<i class="fa fa-calendar fa-3x"></i>
							<p class="judul">Analisa Penjualan Harian</p>
							<p class="keterangan">Menunjukkan laporan penjualan per hari.</p>
						</div>
					</router-link>
				</div>
				<div class="col-md-4">
					<router-link :to="{name: 'indexLaporanPenjualanPerJam'}">
						<div class="box">
							<i class="fa fa-clock-o fa-3x"></i>
							<p class="judul">Analisa Penjualan Per Jam</p>
							<p class="keterangan">Menunjukkan laporan penjualan per jam.</p>
						</div>
					</router-link>
				</div>
				<div class="col-md-4">
					<router-link :to="{name: 'indexDataTransaksiPenjualan'}">
						<div class="box">
							<i class="fa fa-list-alt fa-3x"></i>
							<p class="judul">Data Transaksi Penjualan</p>
							<p class="keterangan">Menunjukkan transaksi laporan penjualan.</p>
						</div>
					</router-link>
				</div>
				<div class="col-md-4">
					<router-link :to="{name: 'indexLaporanRekapitulasiKas'}">
						<div class="box">
							<i class="fa fa-copy fa-3x"></i>
							<p class="judul">Rekapitulasi Kas</p>
							<p class="keterangan">Menampilkan penerimaan kas yang dilaporkan oleh operator</p>
						</div>
					</router-link>
				</div>
				<div class="col-md-4">
					<router-link :to="{name: 'indexDashboard'}">
						<div class="box">
							<i class="fa fa-th fa-3x"></i>
							<p class="judul">Laporan Penjualan Produk</p>
							<p class="keterangan">Menampilkan laporan penjualan produk.</p>
						</div>
					</router-link>
				</div>
				<div class="col-md-4">
					<router-link :to="{name: 'indexDashboard'}">
						<div class="box">
							<i class="fa fa-server fa-3x"></i>
							<p class="judul">Laporan Penjualan Modifier</p>
							<p class="keterangan">Menampilkan laporan penjualan modifier.</p>
						</div>
					</router-link>
				</div>
				<!-- <div class="col-md-4">
					<router-link :to="{name: 'indexLaporanPenjualanPerPenjualan'}">
						<div class="box">
							<i class="fa fa-money fa-3x"></i>
							<p class="judul">Laporan Penjualan Per Penjualan</p>
							<p class="keterangan">Menampilkan laporan penjualan Per penjualan.</p>
						</div>
					</router-link>
				</div> -->
				<div class="col-md-4">
					<router-link :to="{name: 'indexDashboard'}">
						<div class="box">
							<i class="fa fa-tag fa-3x"></i>
							<p class="judul">Laporan Penjualan Per Kategori</p>
							<p class="keterangan">Menampilkan laporan penjualan per kategori.</p>
						</div>
					</router-link>
				</div>
				<!-- <div class="col-md-4">
					<router-link :to="{name: 'indexDashboard'}">
						<div class="box">
							<i class="fa fa-fire fa-3x"></i>
							<p class="judul">Laporan Penerimaan Pajak</p>
							<p class="keterangan">Menampilkan laporan penerimaan pajak per transaksi.</p>
						</div>
					</router-link>
				</div> -->
				<div class="col-md-4">
					<router-link :to="{name: 'indexLaporanDiskon'}">
						<div class="box">
							<i class="fa fa-cut fa-3x"></i>
							<p class="judul">Laporan Diskon</p>
							<p class="keterangan">Menampilkan laporan jumlah diskon yang sudah diberikan.</p>
						</div>
					</router-link>
				</div>
				<!-- <div class="col-md-4">
					<router-link :to="{name: 'indexDashboard'}">
						<div class="box">
							<i class="fa fa-user fa-3x"></i>
							<p class="judul">Laporan Pembelian Member</p>
							<p class="keterangan">Menampilkan laporan jumlah pembelian member.</p>
						</div>
					</router-link>
				</div> -->
				<!-- <div class="col-md-4">
					<router-link :to="{name: 'indexDashboard'}">
						<div class="box">
							<i class="fa fa-rss fa-3x"></i>
							<p class="judul">Laporan Laba Harian</p>
							<p class="keterangan">Menampilkan laporan laba per hari.</p>
						</div>
					</router-link>
				</div> -->
				<!-- <div class="col-md-4">
					<router-link :to="{name: 'indexDashboard'}">
						<div class="box">
							<i class="fa fa-line-chart fa-3x"></i>
							<p class="judul">Laporan Laba Produk</p>
							<p class="keterangan">Menampilkan laporan laba produk.</p>
						</div>
					</router-link>
				</div> -->
			</div>
		</div>
	</div>
</template>