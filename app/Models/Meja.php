<?php

namespace App\Models;

use App\Models\Pesanan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Meja extends Model
{
    use HasFactory;
    protected $fillable =['kapasitas','status'];

    public function pesanan():HasMany{
        return $this->hasMany(Pesanan::class,'meja_id');
    }
}
