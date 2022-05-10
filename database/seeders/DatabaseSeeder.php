<?php

namespace Database\Seeders;

use App\Models\Gig;
use App\Models\GigResponse;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::factory()->withPersonalTeam()->create([
            'email' => 'test@test.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);

        $user->currentTeam->users()->saveMany(User::factory(5)->create());
        
        $gigs = Gig::factory(10)->for($user->currentTeam)->create();

        foreach ($gigs as $gig) {
            GigResponse::factory()->for($gig)->create([
                'user_id' => random_int(1, 6)
            ]);
        }

    }
}
