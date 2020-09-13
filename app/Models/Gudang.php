<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gudang extends Model
{
    protected $guarded = [];

    public function barangs()
    {
        return $this->hasMany('App\Models\Barang', 'gudang_id', 'id');
    }
}
