<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Panen extends Model
{
    protected $table = 'data_panen';
    protected $fillable = ['id_progress', 'id_kategori', 'lama_panen', 'total_ternak', 'tanggal'];

    public function progress()
    {
        return $this->belongsTo(Progress::class, 'id_progress');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }
}
