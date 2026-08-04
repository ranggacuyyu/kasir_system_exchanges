<?php

namespace Database\Factories;

use App\Models\Attendance;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attendance>
 */
class AttendanceFactory extends Factory
{
    protected $model = Attendance::class;

    public function definition(): array
    {
        $checkIn = fake()->dateTimeBetween('-1 month', 'now');
        $checkOut = (clone $checkIn)->modify('+8 hours');

        return [
            'id_user' => User::factory(),
            'id_schedule' => Schedule::factory(),
            'check_in' => $checkIn,
            'check_out' => $checkOut,
            'late_minute' => fake()->numberBetween(0, 30),
            'overtime' => fake()->randomElement(['0 Jam', '1 Jam', '2 Jam']),
            'status' => fake()->randomElement(['present', 'late', 'absent', 'permission']),
        ];
    }
}
