<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order';
    protected $fillable = ['id_users', 'id_produk', 'tanggal', 'batas_pembayaran', 'status_order', 'nominal', 'banyak_item', 'rekening', 'atas_nama', 'jumlah_transfer', 'bukti', 'jenis_pengiriman'];

    public function takeImage()
    {
        return "/storage/" . $this->bukti;
    }
}
