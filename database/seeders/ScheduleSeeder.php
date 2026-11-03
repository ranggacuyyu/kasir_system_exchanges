<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Enums\Status;
use App\Models\Schedule;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cashiers = User::where('role', RoleEnum::KASIR->value)
            ->where('status', Status::ACTIVE->value)
            ->get();

        if ($cashiers->isEmpty()) {
            return;
        }

        $today = Carbon::today();
        $startDate = $today->copy()->startOfMonth()->toDateString();
        $endDate = $today->copy()->endOfMonth()->toDateString();

        $shifts = [
            [
                'schedule_name' => 'Shift Pagi (Opening)',
                'start_time' => '07:30:00',
                'end_time' => '15:30:00',
                'description' => 'Shift kasir pembukaan toko dan persediaan pagi',
            ],
            [
                'schedule_name' => 'Shift Sore (Closing)',
                'start_time' => '15:00:00',
                'end_time' => '23:00:00',
                'description' => 'Shift kasir sore hingga penutupan toko dan rekonsiliasi kas',
            ],
            [
                'schedule_name' => 'Shift Middle (Rush Hour)',
                'start_time' => '11:00:00',
                'end_time' => '19:00:00',
                'description' => 'Shift kasir bantuan jam makan siang dan ramai',
            ],
        ];

        foreach ($cashiers as $index => $cashier) {
            $shift = $shifts[$index % count($shifts)];

            Schedule::updateOrCreate(
                [
                    'id_user' => $cashier->id,
                    'schedule_name' => $shift['schedule_name'],
                ],
                [
                    'id_user' => $cashier->id,
                    'schedule_name' => $shift['schedule_name'],
                    'start_time' => $shift['start_time'],
                    'end_time' => $shift['end_time'],
                    'start_date' => $startDate,
                    'end_date' => $endDate,
                    'description' => $shift['description'],
                    'status' => Status::ACTIVE->value,
                ]
            );
        }
    }
}

