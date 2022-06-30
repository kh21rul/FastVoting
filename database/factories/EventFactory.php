<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => Arr::random(User::all()->pluck('id')->toArray()),
            'title' => str_replace('.', '', $this->faker->text(60)),
            'description' => $this->faker->paragraphs(3, true),
            'started_at' => $this->faker->dateTimeBetween('-1 days'),
            'finished_at' => $this->faker->dateTimeBetween('now', '+1 days'),
            'timezone' => $this->faker->timezone,
        ];
    }
}
