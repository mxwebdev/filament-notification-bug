<?php

namespace Database\Seeders;

use App\Models\Gig;
use App\Models\Team;
use App\Models\User;
use App\Models\GigResponse;
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
            'name' => 'Maximilian Wörner',
            'email' => 'test@test.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);

        $users = User::factory(6)->withPersonalTeam()->create();

        $team = Team::factory()->create(['name' => 'TOTO and the Kids']);

        $team->users()->save($user);
        $team->users()->saveMany($users);
        
        // $gigs = Gig::factory(5)->for($user->currentTeam)->create();

        // foreach ($gigs as $gig) {
        //     GigResponse::factory()->for($gig)->create([
        //         'user_id' => random_int(1, 6)
        //     ]);
        // }

    }
}
