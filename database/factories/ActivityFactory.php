<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Activity;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Activity>
 */
class ActivityFactory extends Factory
{
    protected $model = Activity::class;

    public function definition()
    {
        $sportTypes = ['Natation', 'Basket fauteuil', 'Athlétisme', 'Tennis de table', 'Boccia', 'Escrime', 'Cyclisme', 'Goalball', 'Judo', 'Tir à l\'arc'];

        $startTime = $this->faker->time('H:i');
        $endTime = date('H:i', strtotime($startTime) + 3600 * $this->faker->numberBetween(1, 3));

        return [
            'name' => $this->faker->sentence(3),
            'description' => $this->faker->paragraphs(3, true),
            'link' => $this->faker->optional(0.7)->url(),
            'location' => $this->faker->address(),
            'date' => $this->faker->dateTimeBetween('+1 week', '+3 months')->format('Y-m-d'),
            'start_time' => $startTime,
            'end_time' => $endTime,
            'sport_type' => $this->faker->randomElement($sportTypes),
            'is_accessible_mobility' => $this->faker->boolean(80),
            'is_accessible_vision' => $this->faker->boolean(60),
            'is_accessible_hearing' => $this->faker->boolean(70),
            'is_accessible_cognitive' => $this->faker->boolean(50),
            'accessibility_details' => $this->faker->optional(0.7)->paragraph(),
            'contact_email' => $this->faker->safeEmail(),
            'contact_phone' => $this->faker->phoneNumber(),
            'user_id' => function () {
                if (User::count() === 0) {
                    return User::factory()->create()->id;
                }
                return $this->faker->boolean(70)
                    ? User::inRandomOrder()->first()->id
                    : User::factory()->create()->id;

            }
        ];
    }
}
