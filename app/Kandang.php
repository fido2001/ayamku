<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kandang extends Model
{
    protected $table = 'kandang';
    protected $fillable = ['kode', 'panjang', 'lebar', 'jumlahBibit'];

    public function peternak()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
