<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
	protected $fillable = ['id','kode_produk','kode_barcode','nama_produk','harga_beli','harga_jual','satuans_id','kategori_produks_id','gudangs_id','status','supliers_id','limit_stok','over_stok','berkaitan_dgn_stok','jenis_produk','tipe_produk','golongan','golongan_produk'];
}
