<?php

namespace App\Models;

use App\Models\Meja;
use App\Models\Menu;
use App\Models\User;
use App\Models\Pelanggan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pesanan extends Model
{
    protected $fillable=['menu_id','pelanggan_id','meja_id','total_harga','kembalian','uang_diberikan','status','user_id'];

    public function menu():BelongsTo
    {
        return $this->belongsTo(Menu::class,'menu_id');
    }
    public function pelanggan():BelongsTo
    {
        return $this->belongsTo(Pelanggan::class,'pelanggan_id');
    }
    public function meja():BelongsTo
    {
        return $this->belongsTo(Meja::class,'meja_id');
    }
    public function user():BelongsTo
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function transaksi():HasMany{
        return $this->hasMany(Transaksi::class);
    }
}
