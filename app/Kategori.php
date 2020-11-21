<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';

    protected $fillable = ['bobot'];

    public function panen()
    {
        return $this->hasMany(Panen::class, 'id_kategori');
    }
}
