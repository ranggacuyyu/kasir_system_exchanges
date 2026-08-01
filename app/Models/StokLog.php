<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StokLog extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_log';

    protected $fillable = [
        'id_menu',
        'change_type',
        'quantity',
        'note',
    ];

    public function menuItem(): BelongsTo
    {
        return $this->belongsTo(MenuItem::class, 'id_menu', 'id_menu');
    }
}
