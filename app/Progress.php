<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    protected $table = 'data_progress';
    protected $fillable = ['id_vitamin', 'id_kandang', 'ket_waktu', 'sisa_ternak', 'perkembangan', 'keluhan'];

    public function vitamin()
    {
        return $this->belongsTo(Vitamin::class, 'id_vitamin');
    }

    public function kandang()
    {
        return $this->belongsTo(Kandang::class, 'id_kandang');
    }
}
