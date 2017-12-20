<style scoped>
.box{
        padding: 30px 5px 30px 5px;
        background: #ffff;
        border: 1px solid #ddd;
        border-radius: 5px;
        margin-bottom: 25px;
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
		<div class="panel panel-info">
			<div class="panel-heading">
				<span class="panel-title">Laporan</span>
			</div>
			<div class="panel-body text-center">
	            <div class="col-md-4">
	            	<router-link :to="{name: 'indexDashboard'}">
	            	<div class="box">
	            		<i class="fa fa-book fa-3x"></i>
	            		<p class="judul">Laporan Ringkas</p>
	            		<p class="keterangan">Menunjukkan laporan penjualan secara umum.</p>
	            	</div>
	            </router-link>
	            </div>
	            <div class="col-md-4">
	            	<router-link :to="{name: 'indexDashboard'}">
	            	<div class="box">
	            		<i class="fa fa-calendar fa-3x"></i>
	            		<p class="judul">Analisa Penjualan Harian</p>
	            		<p class="keterangan">Menunjukkan laporan penjualan per hari.</p>
	            	</div>
	            </router-link>
	            </div>
	            <div class="col-md-4">
	            	<router-link :to="{name: 'indexDashboard'}">
	            	<div class="box">
	            		<i class="fa fa-clock-o fa-3x"></i>
	            		<p class="judul">Analisa Penjualan Per Jam</p>
	            		<p class="keterangan">Menunjukkan laporan penjualan per jam.</p>
	            	</div>
	            </router-link>
	            </div>
	            <div class="col-md-4">
	            	<router-link :to="{name: 'indexDashboard'}">
	            	<div class="box">
	            		<i class="fa fa-list-alt fa-3x"></i>
	            		<p class="judul">Data Transaksi Penjualan</p>
	            		<p class="keterangan">Menunjukkan transaksi laporan penjualan.</p>
	            	</div>
	            </router-link>
	            </div>
	            <div class="col-md-4">
	            	<router-link :to="{name: 'indexDashboard'}">
	            	<div class="box">
	            		<i class="fa fa-copy fa-3x"></i>
	            		<p class="judul">Rekapitulasi Kas</p>
	            		<p class="keterangan">Menampilkan penerimaan kasyang dilaporkan oleh operator</p>
	            	</div>
	            </router-link>
	            </div>
	            <div class="col-md-4">
	            	<router-link :to="{name: 'indexDashboard'}">
	            	<div class="box">
	            		<i class="fa fa-th fa-3x"></i>
	            		<p class="judul">Laporan Stok</p>
	            		<p class="keterangan">Menampilkan laporan stok produk per lokasi.</p>
	            	</div>
	            </router-link>
	            </div>
            </div>
		</div>
	</div>
</template>