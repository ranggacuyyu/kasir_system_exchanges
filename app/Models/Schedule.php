<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Schedule extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_schedule';

    protected $fillable = [
        'id_user',
        'schedule_name',
        'start_time',
        'end_time',
        'start_date',
        'end_date',
        'description',
        'status',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class, 'id_schedule', 'id_schedule');
    }
}
