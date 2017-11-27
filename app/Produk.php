<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;

class Produk extends Model
{
	use AuditableTrait;

	protected $primaryKey = 'produk_id';

	protected $fillable = ['produk_id','kode_produk','kode_barcode','nama_produk','harga_beli','harga_jual','satuans_id','kategori_produks_id','gudangs_id','status','supliers_id','limit_stok','over_stok','berkaitan_dgn_stok','jenis_produk','tipe_produk','golongan','golongan_produk'];

	public function satuan()
	{
		return $this->hasOne('App\Satuan','id', 'produk_id');
	}

}
