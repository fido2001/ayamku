<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pembukuan extends Model
{
    protected $table = 'pembukuan';
    protected $fillable = ['tanggal', 'nama', 'keterangan', 'debit', 'kredit', 'jenis'];
}
