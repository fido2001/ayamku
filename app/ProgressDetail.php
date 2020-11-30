<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class ProgressDetail extends Model
{
    protected $table = 'progress_detail';

    protected $fillable = ['id_progress', 'id_vitamin', 'id_kategori', 'banyak_telur', 'jumlah_ternak', 'ternak_mati', 'jumlah_pakan', 'perkembangan', 'tgl_progress', 'ket_waktu'];

    public function progress()
    {
        return $this->belongsTo(Progress::class, 'id_progress');
    }

    public function vitamin()
    {
        return $this->belongsTo(Vitamin::class, 'id_vitamin');
    }

    public function produk()
    {
        return $this->hasMany(Produk::class, 'id_progress_detail');
    }

    public function getTanggalProgress()
    {
        return Carbon::parse($this->tgl_progress)->translatedFormat('l, d F Y');
    }
}
