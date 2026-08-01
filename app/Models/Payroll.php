<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payroll extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_payroll';

    protected $fillable = [
        'id_user',
        'period_month',
        'period_year',
        'base_sallary',
        'net_sallary',
        'deductions',
        'bonus',
        'overtime_hours',
        'overtime_pay',
        'payment_status',
        'payment_date',
        'notes',
    ];

    protected $casts = [
        'payment_date' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
