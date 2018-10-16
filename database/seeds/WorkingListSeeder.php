<?php

use Illuminate\Database\Seeder;
use \App\Employer;

class WorkingListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $employers = Employer::where('id', '>', 0)->get();

        $date = \Carbon\Carbon::now();
        if ($employers->count() > 0) {
            foreach($employers as $employer) {
                for($i=1; $i<=10; $i++) {
                    $employer->workingList()->create([
                        'date' => $date->toDateString(),
                        'work_from' => $date->toTimeString(),
                        'work_to' => $date->addHour(2)->toTimeString(),
                        'minutes_per_day' => 0
                    ]);
                    $date->addDay(1);

                }
                $date->subDays(15);
            }
        }
    }
}
