<?php

namespace Database\Factories;

use App\Models\Gig;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class GigFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Gig::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $gig_start = $this->faker->dateTimeBetween('-6 months ', '+1 year');
        $gig_end = $this->faker->dateTimeBetween($gig_start, $gig_start->format('Y-m-d H:i:s').' +12 hours');

        return [
            'name' => $this->faker->words(3, true),
            'location' => $this->faker->city,
            'gig_start' => $gig_start,
            'gig_end' => $gig_end,
            'fee' => $this->faker->numberBetween(1_000, 2_000),
            'status' => $this->faker->randomElement([
                Gig::STATUS_OPEN,
                Gig::STATUS_CONFIRMED,
            ]),
            'team_id' => Team::factory(),
            'created_by' => User::factory(),
        ];



    }
}
