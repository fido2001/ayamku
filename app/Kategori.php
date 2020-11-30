<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';

    protected $fillable = ['jenis_ternak'];

    public function panen()
    {
        return $this->hasMany(Panen::class, 'id_kategori');
    }
}
