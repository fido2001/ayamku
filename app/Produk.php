<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';

    protected $fillable = ['id_progress_detail', 'harga', 'jumlah_produk', 'nama_produk', 'tgl_produk'];

    public function progress_detail()
    {
        return $this->belongsTo(ProgressDetail::class, 'id_progress_detail');
    }

    public function takeImage()
    {
        return "/storage/" . $this->gambar;
    }
}
