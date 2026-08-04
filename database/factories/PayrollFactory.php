<?php

namespace Database\Factories;

use App\Models\Payroll;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payroll>
 */
class PayrollFactory extends Factory
{
    protected $model = Payroll::class;

    public function definition(): array
    {
        $baseSalary = fake()->numberBetween(2500000, 4500000);
        $overtimeHours = fake()->randomFloat(2, 0, 15);
        $overtimePay = $overtimeHours * 20000;
        $bonus = fake()->numberBetween(0, 300000);
        $deductions = fake()->numberBetween(0, 100000);
        $netSalary = $baseSalary + $overtimePay + $bonus - $deductions;

        return [
            'id_user' => User::factory(),
            'period_month' => fake()->numberBetween(1, 12),
            'period_year' => 2026,
            'base_sallary' => $baseSalary,
            'net_sallary' => $netSalary,
            'deductions' => $deductions,
            'bonus' => $bonus,
            'overtime_hours' => $overtimeHours,
            'overtime_pay' => $overtimePay,
            'payment_status' => fake()->randomElement(['paid', 'pending']),
            'payment_date' => fake()->date(),
            'notes' => fake()->sentence(),
        ];
    }
}
