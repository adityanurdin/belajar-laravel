<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $guarded = [];

    public function barang()
    {
        return $this->belongsTo('App\Models\Barang', 'barang_id');
    }
}
