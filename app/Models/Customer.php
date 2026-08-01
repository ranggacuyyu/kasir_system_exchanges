<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_customer';

    protected $fillable = [
        'customer_name',
        'customer_phone',
        'service',
        'comment',
        'status',
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'id_customer', 'id_customer');
    }
}
