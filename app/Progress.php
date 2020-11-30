<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Progress extends Model
{
    protected $table = 'progress';
    protected $fillable = ['id_kandang', 'kategori', 'tgl_mulai', 'tgl_selesai', 'lama_siklus'];

    public function kandang()
    {
        return $this->belongsTo(Kandang::class, 'id_kandang');
    }

    public function panen()
    {
        return $this->hasMany(Panen::class, 'id_progress');
    }

    public function progress_detail()
    {
        return $this->hasMany(ProgressDetail::class, 'id_progress');
    }

    public function getTanggalMulai()
    {
        return Carbon::parse($this->tgl_mulai)->translatedFormat('l, d F Y');
    }

    public function getTanggalSelesai()
    {
        return Carbon::parse($this->tgl_selesai)->translatedFormat('l, d F Y');
    }
}
