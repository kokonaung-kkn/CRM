<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class LeadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'phone_number' => $this->faker->phoneNumber(),
            'job_title' => $this->faker->jobTitle(),
            'company' => $this->faker->company(),
            'city' => $this->faker->city(),
            'address' => $this->faker->address(),
            'lead_source' => 'Google',
            'status' => 'new',
            'priority' => random_int(1,5),
            'image' => $this->faker->image(),
            'staff_id' => random_int(1,7),
        ];
    }
}
