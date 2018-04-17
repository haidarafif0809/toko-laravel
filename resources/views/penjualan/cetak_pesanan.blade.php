<!DOCTYPE doctype html>
<html lang="en">
<head>
	<title>
		cetak
	</title>
	<!-- Bootstrap core CSS     -->
	<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet"/>
	<link href="{{ asset('css/selectize.bootstrap3.css') }}" rel="stylesheet">
</head>
<style type="text/css">

p{
	margin-top: 1px; margin-bottom: 1px;
}
.marginProduk{
	margin-top: 1px; margin-bottom: 1px;
	padding-left: 3px; padding-right: 3px;
}

</style>
<body>

	<div class="row">
		<div class="col-md-12">
			<p>-------------------------------------------------------------</p>
			@if($simpan_penjualan->pelanggan_id == 0)
			<p>Pelanggan : Umum</p>
			@else
			<p>Pelanggan : {{$simpan_penjualan->nama_pelanggan}}</p>
			@endif
			@if($simpan_penjualan->catatan != null)
			<p>Catatan : {{$simpan_penjualan->catatan}}</p>
			@endif
			@if($simpan_penjualan->nomor_meja != null)
			<p>Nomor Meja : {{$simpan_penjualan->nomor_meja}}</p>
			@else
			<p>Nomor Meja : 0</p>
			@endif
			<p>Kasir : {{$simpan_penjualan->nama_pemilik}}</p>

			<p>-------------------------------------------------------------</p>
			<p>Pesanan </p>
			<p>-------------------------------------------------------------</p>
		</div>
	</div>

	<table >
		<tbody >

			@foreach ($detail_simpan_penjualan as $detail_simpan_penjualans)
			<tr>
				<td class="marginProduk"> {{title_case($detail_simpan_penjualans->nama_produk)}} </td>
				<td class="marginProduk" align="right">x {{number_format($detail_simpan_penjualans->jumlah_produk, 0, ',', '.')}}</td>
			</tr>
			@endforeach
		</tbody>
	</table>

	<div class="row">
		<div class="col-md-12">
			<p>-------------------------------------------------------------</p>
			<p>-------------------------------------------------------------</p>
		</div>
	</div>

	<p><i>Support by andaglos.id</i></p><br><br>

</body>
<!--   Core JS Files   -->
<script src="{{ asset('js/app.js?v=1.51')}}" type="text/javascript"></script>

<script>
	$(document).ready(function(){
		window.print();
		window.close();
	});
</script>
@yield('scripts')
</html>
