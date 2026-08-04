<?php

namespace Database\Seeders;

use App\Models\Schedule;
use App\Models\User;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();

        foreach ($users as $user) {
            Schedule::firstOrCreate(
                [
                    'id_user' => $user->id,
                    'schedule_name' => 'Shift Reguler Kasir/Staff',
                ],
                [
                    'start_time' => '08:00:00',
                    'end_time' => '17:00:00',
                    'start_date' => now()->startOfMonth()->toDateString(),
                    'end_date' => now()->endOfMonth()->toDateString(),
                    'description' => 'Jadwal kerja bulanan',
                    'status' => 'active',
                ]
            );
        }
    }
}
