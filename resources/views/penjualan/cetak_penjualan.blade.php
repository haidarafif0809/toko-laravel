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
			<center><h4 style="margin-top: 1px; margin-bottom: 1px;"><b>{{$nama_toko->nama_toko}}</b></h4></center>
			<center><p><b>{{$nama_toko->alamat}} {{$nama_toko->kabupaten}} {{$nama_toko->provinsi}}</b></p></center>
			<p>-------------------------------------------------------------</p>
			@if($penjualan->pelanggan_id == 0)
			<p>Pelanggan : Umum</p>
			@else
			<p>Pelanggan : {{$penjualan->nama_pelanggan}}</p>
			@endif
			<p>No. Transaksi : #{{$penjualan->id}}</p>
			<p>Kasir : {{$penjualan->nama_pemilik}}</p>

			<p>-------------------------------------------------------------</p>
		</div>
	</div>

	<table >
		<tbody >

			@foreach ($detail_penjualan as $detail_penjualans)
			<tr>
				<td class="marginProduk"> {{title_case($detail_penjualans->nama_produk)}} </td>
				<td class="marginProduk" align="right"> {{number_format($detail_penjualans->harga_produk, 0, ',', '.')}}</td>
				<td class="marginProduk" align="right">{{number_format($detail_penjualans->jumlah_produk, 0, ',', '.')}}</td>
				<td class="marginProduk" align="right">{{number_format($detail_penjualans->harga_produk * $detail_penjualans->jumlah_produk, 0, ',', '.')}}</td>
			</tr>
			@if($detail_penjualans->diskon != null)
			<tr>
				<td class="marginProduk">Disc. {{number_format($detail_penjualans->diskon, 0, ',', '.')}} </td>
			</tr>
			@endif
			@endforeach
		</tbody>
	</table>

	<div class="row">
		<div class="col-md-12">
			<p>-------------------------------------------------------------</p>
		</div>
	</div>
	<table>
		<tbody>
		</tr><tr>
			<td class="marginProduk"> Total item</td>
			<td class="marginProduk" align="right">:</td>
			<td class="marginProduk" align="right"></td>
			<td class="marginProduk" align="right">---{{number_format($total_item, 0, ',', '.')}}---item</td>
		</tr>
		@if($penjualan->diskon != null || $total_diskon != null)
		<tr>
			@if($total_diskon != null)
			<td class="marginProduk"> Subtotal </td>
			<td class="marginProduk" align="right">:</td>
			<td class="marginProduk" align="right"></td>
			<td class="marginProduk" align="right">{{number_format($penjualan->subtotal + $total_diskon, 0, ',', '.')}}</td>
			@else
			<td class="marginProduk"> Subtotal </td>
			<td class="marginProduk" align="right">:</td>
			<td class="marginProduk" align="right"></td>
			<td class="marginProduk" align="right">{{number_format($penjualan->subtotal, 0, ',', '.')}}</td>
			@endif

		</tr>
		<tr>
			@if($total_diskon != null && $penjualan->diskon != null)
			<td class="marginProduk"> Diskon </td>
			<td class="marginProduk" align="right">:</td>
			<td class="marginProduk" align="right"></td>
			<td class="marginProduk" align="right">{{number_format($penjualan->diskon + $total_diskon, 0, ',', '.')}}</td>
			@elseif($total_diskon == null && $penjualan->diskon != null)
			<td class="marginProduk"> Diskon </td>
			<td class="marginProduk" align="right">:</td>
			<td class="marginProduk" align="right"></td>
			<td class="marginProduk" align="right">{{number_format($penjualan->diskon, 0, ',', '.')}}</td>
			@else
			<td class="marginProduk"> Diskon </td>
			<td class="marginProduk" align="right">:</td>
			<td class="marginProduk" align="right"></td>
			<td class="marginProduk" align="right">{{number_format($total_diskon, 0, ',', '.')}}</td>
			@endif
		</tr>
		@endif
		<tr>
			<td class="marginProduk"> Total </td>
			<td class="marginProduk" align="right">:</td>
			<td class="marginProduk" align="right"></td>
			<td class="marginProduk" align="right">{{number_format($penjualan->total_bayar, 0, ',', '.')}}</td>
		</tr>

		<tr>
			<td class="marginProduk"> Tunai </td>
			<td class="marginProduk" align="right">:</td>
			<td class="marginProduk" align="right"></td>
			<td class="marginProduk" align="right">{{number_format($penjualan->tunai, 0, ',', '.')}}</td>
		</tr>

		<tr>
			<td class="marginProduk"> Kembalian </td>
			<td class="marginProduk" align="right">:</td>
			<td class="marginProduk" align="right"></td>
			<td class="marginProduk" align="right">{{number_format($penjualan->kembalian, 0, ',', '.')}}</td>
		</tr>
	</tbody>
</table>

<p>-------------------------------------------------------------</p>
<p>{{$penjualan->waktu}}</p>

<p>No. Telp : {{$nama_toko->no_telp}}</p>
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
