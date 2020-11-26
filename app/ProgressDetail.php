<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class ProgressDetail extends Model
{
    protected $table = 'progress_detail';

    protected $fillable = ['id_progress', 'id_vitamin', 'ternak_sehat', 'ternak_sakit', 'perkembangan', 'tgl_progress', 'keluhan', 'saran'];

    public function progress()
    {
        return $this->belongsTo(Progress::class, 'id_progress');
    }

    public function vitamin()
    {
        return $this->belongsTo(Vitamin::class, 'id_vitamin');
    }

    public function getTanggalProgress()
    {
        return Carbon::parse($this->tgl_progress)->translatedFormat('l, d F Y');
    }
}
