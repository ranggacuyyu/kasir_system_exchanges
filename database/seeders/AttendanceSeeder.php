<?php

namespace Database\Seeders;

use App\Models\Attendance;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Database\Seeder;

class AttendanceSeeder extends Seeder
{
    public function run(): void
    {
        $schedules = Schedule::all();

        foreach ($schedules as $schedule) {
            Attendance::create([
                'id_user' => $schedule->id_user,
                'id_schedule' => $schedule->id_schedule,
                'check_in' => now()->setHour(8)->setMinute(5),
                'check_out' => now()->setHour(17)->setMinute(0),
                'late_minute' => 5,
                'overtime' => '0 Jam',
                'status' => 'present',
            ]);
        }
    }
}
