<?php

namespace Database\Factories;

use App\Enums\Status;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Schedule>
 */
class ScheduleFactory extends Factory
{
    protected $model = Schedule::class;

    public function definition(): array
    {
        return [
            'id_user' => User::factory(),
            'schedule_name' => fake()->randomElement(['Shift Pagi', 'Shift Siang', 'Shift Malam']),
            'start_time' => '08:00:00',
            'end_time' => '16:00:00',
            'start_date' => now()->startOfWeek()->toDateString(),
            'end_date' => now()->endOfWeek()->toDateString(),
            'description' => fake()->sentence(),
            'status' => Status::ACTIVE->value,
        ];
    }
}
