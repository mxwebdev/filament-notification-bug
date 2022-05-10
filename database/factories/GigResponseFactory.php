<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\Gig;
use App\Models\User;
use App\Models\GigResponse;
use Illuminate\Database\Eloquent\Factories\Factory;

class GigResponseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = GigResponse::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'status' => $this->faker->randomElement([
                GigResponse::STATUS_PENDING, 
                GigResponse::STATUS_ACCEPTED, 
                GigResponse::STATUS_DECLINED, 
                GigResponse::STATUS_TENTATIVE
            ]),
            'response_time' => Carbon::now(),
            'comment' => $this->faker->paragraph,
            'gig_id' => Gig::factory(),
            'user_id' => User::factory(),
        ];
    }
}
