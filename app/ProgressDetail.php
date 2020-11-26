<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}
