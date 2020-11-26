<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';

    protected $fillable = ['id_panen', 'harga', 'jumlah_produk'];

    public function panen()
    {
        return $this->belongsTo(Panen::class, 'id_panen');
    }
}
