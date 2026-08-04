<?php

namespace Database\Seeders;

use App\Models\Payroll;
use App\Models\User;
use Illuminate\Database\Seeder;

class PayrollSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();

        foreach ($users as $user) {
            $baseSalary = $user->role === 'admin' ? 5000000 : 3200000;
            $bonus = 200000;
            $deductions = 50000;
            $netSalary = $baseSalary + $bonus - $deductions;

            Payroll::create([
                'id_user' => $user->id,
                'period_month' => (int) now()->format('m'),
                'period_year' => (int) now()->format('Y'),
                'base_sallary' => $baseSalary,
                'net_sallary' => $netSalary,
                'deductions' => $deductions,
                'bonus' => $bonus,
                'overtime_hours' => 2.5,
                'overtime_pay' => 50000,
                'payment_status' => 'paid',
                'payment_date' => now()->toDateString(),
                'notes' => 'Gaji bulanan reguler',
            ]);
        }
    }
}
