<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kandang extends Model
{
    protected $table = 'kandang';
    protected $fillable = ['nama_kandang', 'panjang', 'lebar', 'jenis_kandang', 'jumlah_koloni'];

    public function progress()
    {
        return $this->hasMany(Progress::class, 'id_kandang');
    }
}
