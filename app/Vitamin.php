<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vitamin extends Model
{
    protected $table = 'vitamin';

    protected $fillable = ['jenis_vitamin', 'takaran', 'syarat'];

    public function progress_detail()
    {
        return $this->hasMany(ProgressDetail::class, 'id_vitamin');
    }
}
