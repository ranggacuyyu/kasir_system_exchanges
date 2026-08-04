<?php

namespace Database\Factories;

use App\Models\OtpVerification;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OtpVerification>
 */
class OtpVerificationFactory extends Factory
{
    protected $model = OtpVerification::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'otp_code' => (string) fake()->numberBetween(100000, 999999),
            'type' => fake()->randomElement(['login', 'reset_password', 'verification']),
            'used' => fake()->boolean(),
            'expires_at' => now()->addMinutes(15),
        ];
    }
}
