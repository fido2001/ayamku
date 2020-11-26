<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Panen extends Model
{
    protected $table = 'data_panen';

    protected $fillable = ['id_progress', 'id_kategori', 'usia_ternak', 'total_ternak', 'tanggal'];

    public function progress()
    {
        return $this->belongsTo(Progress::class, 'id_progress');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    public function getTanggal()
    {
        return Carbon::parse($this->tanggal)->translatedFormat('l, d F Y');
    }

    public function produk()
    {
        return $this->hasMany(Produk::class, 'id_panen');
    }
}
