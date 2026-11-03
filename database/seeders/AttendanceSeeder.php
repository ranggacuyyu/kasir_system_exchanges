<?php

namespace Database\Seeders;

use App\Models\Attendance;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $schedules = Schedule::with('user')->get();

        if ($schedules->isEmpty()) {
            return;
        }

        $now = Carbon::now();

        foreach ($schedules as $schedule) {
            // Absensi kemarin (selesai bertugas)
            $yesterday = $now->copy()->subDay();
            Attendance::updateOrCreate(
                [
                    'id_user' => $schedule->id_user,
                    'id_schedule' => $schedule->id_schedule,
                    'check_in' => $yesterday->copy()->setTime(7, 35, 0),
                ],
                [
                    'id_user' => $schedule->id_user,
                    'id_schedule' => $schedule->id_schedule,
                    'check_in' => $yesterday->copy()->setTime(7, 35, 0),
                    'check_out' => $yesterday->copy()->setTime(15, 30, 0),
                    'late_minute' => 5,
                    'overtime' => '0 jam',
                    'status' => 'present',
                ]
            );

            // Absensi hari ini (sedang bertugas)
            Attendance::updateOrCreate(
                [
                    'id_user' => $schedule->id_user,
                    'id_schedule' => $schedule->id_schedule,
                    'check_in' => $now->copy()->setTime(7, 28, 0),
                ],
                [
                    'id_user' => $schedule->id_user,
                    'id_schedule' => $schedule->id_schedule,
                    'check_in' => $now->copy()->setTime(7, 28, 0),
                    'check_out' => null,
                    'late_minute' => 0,
                    'overtime' => null,
                    'status' => 'present',
                ]
            );
        }
    }
}

