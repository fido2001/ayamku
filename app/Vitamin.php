<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vitamin extends Model
{
    protected $table = 'vitamin';

    protected $fillable = ['jenis_vitamin', 'takaran', 'syarat'];

    public function progress()
    {
        return $this->hasMany(Progress::class, 'id_vitamin');
    }
}
