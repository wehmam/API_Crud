<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $fillable = ['nama_produk','jenis_produk','harga_produk','foto_produk'];
    protected $table = 'indomaret';
}
