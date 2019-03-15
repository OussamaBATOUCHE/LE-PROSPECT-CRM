<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {

        $schedule->exec("/Users/Sofiane/bin/mysqldump -h 127.0.0.1 -u root -p123  pfe")
                 ->everyMinute()
                 ->sendOutputTo('/Users/Sofiane/Desktop/Monthly_backup'.date('Y-m-d').'.sql')
                 ->EmailOutputTo('ossama12batouche@gmail.com');
                 //and if i want to email'it i can just , EmailOutputTo()
    }


}
