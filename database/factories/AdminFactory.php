<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Str;
use Hash;

class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => 'Admin',
            'phone' => '0123456789',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('000000'),
            'remember_token' => Str::random(60)
        ];
    }
}
