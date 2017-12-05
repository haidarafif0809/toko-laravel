<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;

class KasMutasi extends Model
{
    use AuditableTrait;
    protected $fillable = ['dari_kas',
        'ke_kas', 'jumlah', 'keterangan'];

    public function dari_kas()
    {
        return $this->belongsTo('App\Kas', 'dari_kas', 'id');
    }
    public function ke_kas()
    {
        return $this->belongsTo('App\Kas', 'ke_kas', 'id');
    }

}
