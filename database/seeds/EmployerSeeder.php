<?php

use Illuminate\Database\Seeder;
use \App\Team;

class EmployerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teams = Team::where('id', '>', 0)->get();

        if ($teams->count() > 0) {
            foreach($teams as $team) {
                for($i=1; $i<=10; $i++) {
                    $team->employers()->create([
                        'first_name' => "First Name of $i Employer",
                        'second_name' => "Second Name of $i Employer",
                        'vacancy' => "Vacancy of $i Employer",
                    ]);
                }
            }
        }
    }
}
