<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Factory as FakerFactory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = FakerFactory::create('ar_JO'); // إعداد Faker لاستخدام اللغة العربية

        /*
        `name`, `email`, `email_verified_at`, 
        `password`, `gender`, `showPassword`, `phone`, `cid`, `date_of_birth`, `photo`*/
        return [
            'name' => $faker->name,
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '123456',
            'gender' => $this->faker->randomElement([1, 0]),
            'showPassword' => '123456',
            'phone' => $this->faker->regexify('[0-9]{8}'),
            'cid' =>  $this->faker->regexify('[0-9]{12}'),
            'date_of_birth' =>   $this->faker->date($format = 'Y-m-d', $max = '2000-1-1'),
            // 'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
