<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';

    protected $fillable = ['id_panen', 'id_user', 'harga', 'jumlah_produk'];

    public function panen()
    {
        return $this->belongsTo(Panen::class, 'id_panen');
    }

    public function penjual()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
