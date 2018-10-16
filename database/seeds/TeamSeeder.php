<?php

use Illuminate\Database\Seeder;
use \App\Team;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Team::create([
            'city' => 'Mexico',
            'name' => "Aria 51",
            'description' => "Very secret object",
        ]);
    }
}
