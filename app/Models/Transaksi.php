<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaksi extends Model
{
    protected $fillable = ['pesanan_id','menu_id','subtotal','jumlah'];
    public function pesanan(){
        return $this->belongsTo(pesanan::class,'pesanan_id');
    }
    public function menu():BelongsTo{
        return $this->belongsTo(Menu::class);
    }
}
