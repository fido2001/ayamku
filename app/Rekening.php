<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rekening extends Model
{
    protected $table = 'rekening';

    protected $fillable = ['nama_bank', 'nama_pemilik', 'no_rekening'];
}
