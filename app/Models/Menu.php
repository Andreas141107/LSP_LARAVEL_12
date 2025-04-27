<?php

    namespace App\Models;

    use App\Models\Pesanan;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\HasMany;
    use Illuminate\Database\Eloquent\Factories\HasFactory;

    class Menu extends Model
    {
    use HasFactory;
    protected $fillable=['nama','harga'];

    public function pesanan():HasMany
    {
        return $this->hasMany(Pesanan::class,'menu_id');
    }
    }
