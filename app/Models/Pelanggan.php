<?php

namespace App\Models;

use App\Models\Pesanan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Pelanggan extends Model
{
    protected $fillable =['nama','jenisK','alamat','noHp'];

    public function transaksi():HasManyThrough
    {
        return $this->hasManyThrough(Transaksi::class,Pesanan::class,'pelanggan_id','pesanan_id');
    }
}
