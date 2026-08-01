<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_categories';

    protected $fillable = [
        'name_categories',
        'description',
        'status',
    ];

    public function menuItems(): HasMany
    {
        return $this->hasMany(MenuItem::class, 'id_categories', 'id_categories');
    }
}
