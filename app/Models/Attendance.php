<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attendance extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_attendance';

    protected $fillable = [
        'id_user',
        'id_schedule',
        'check_in',
        'check_out',
        'late_minute',
        'overtime',
        'status',
    ];

    protected $casts = [
        'check_in' => 'datetime',
        'check_out' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function schedule(): BelongsTo
    {
        return $this->belongsTo(Schedule::class, 'id_schedule', 'id_schedule');
    }
}
