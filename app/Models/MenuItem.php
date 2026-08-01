<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MenuItem extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_menu';

    protected $fillable = [
        'id_categories',
        'name_menu',
        'modal',
        'price',
        'stok',
        'imgae_url',
        'description',
        'status',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'id_categories', 'id_categories');
    }

    public function stokLogs(): HasMany
    {
        return $this->hasMany(StokLog::class, 'id_menu', 'id_menu');
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class, 'id_menu', 'id_menu');
    }
}
