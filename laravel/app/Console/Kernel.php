<?php

namespace App\Console;
use DB;
use Illuminate\Console\Scheduling\Schedule;

//接入redis
use Illuminate\Support\Facades\Redis;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        // Commands\Inspire::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {  
            $data = Redis::rpop('rizhi');
            $res = json_decode($data,true);
            if($res != null){
            DB::table('laravel')->insert($res);  
            }
        })->everyMinute();
    }
      
}
