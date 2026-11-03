<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\Payroll;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PayrollSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cashiers = User::where('role', RoleEnum::KASIR->value)->get();

        if ($cashiers->isEmpty()) {
            return;
        }

        $now = Carbon::now();
        $currentMonth = $now->month;
        $currentYear = $now->year;
        $prevMonth = $now->copy()->subMonth();

        foreach ($cashiers as $cashier) {
            $baseSalary = 3500000;
            $overtimeHours = 4.0;
            $overtimePay = 100000;
            $bonus = 250000;
            $deductions = 50000;
            $netSalary = $baseSalary + $overtimePay + $bonus - $deductions;

            // Payroll bulan lalu (Sudah Dibayar)
            Payroll::updateOrCreate(
                [
                    'id_user' => $cashier->id,
                    'period_month' => $prevMonth->month,
                    'period_year' => $prevMonth->year,
                ],
                [
                    'id_user' => $cashier->id,
                    'period_month' => $prevMonth->month,
                    'period_year' => $prevMonth->year,
                    'base_sallary' => $baseSalary,
                    'net_sallary' => $netSalary,
                    'deductions' => $deductions,
                    'bonus' => $bonus,
                    'overtime_hours' => $overtimeHours,
                    'overtime_pay' => $overtimePay,
                    'payment_status' => 'paid',
                    'payment_date' => $prevMonth->copy()->endOfMonth()->toDateString(),
                    'notes' => 'Gaji periode ' . $prevMonth->translatedFormat('F Y') . ' telah ditransfer',
                ]
            );

            // Payroll bulan ini (Masih Pending)
            Payroll::updateOrCreate(
                [
                    'id_user' => $cashier->id,
                    'period_month' => $currentMonth,
                    'period_year' => $currentYear,
                ],
                [
                    'id_user' => $cashier->id,
                    'period_month' => $currentMonth,
                    'period_year' => $currentYear,
                    'base_sallary' => $baseSalary,
                    'net_sallary' => $baseSalary,
                    'deductions' => 0,
                    'bonus' => 0,
                    'overtime_hours' => 0,
                    'overtime_pay' => 0,
                    'payment_status' => 'pending',
                    'payment_date' => null,
                    'notes' => 'Gaji periode berjalan ' . $now->translatedFormat('F Y'),
                ]
            );
        }
    }
}

