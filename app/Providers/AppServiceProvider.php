<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Queue\Events\JobFailed;
use Illuminate\Queue\Events\JobProcessing;
use Illuminate\Queue\Events\JobProcessed;

class AppServiceProvider extends ServiceProvider
{

    const QUEUE_FOLDER_BASE_PATH = 'D:/laravel-test-data/queue/';
    const QUEUE_FOLDER_BEFORE = self::QUEUE_FOLDER_BASE_PATH .'before/';
    const QUEUE_FOLDER_AFTER = self::QUEUE_FOLDER_BASE_PATH .'after/';

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Schema::defaultStringLength(191);

		\View::share('approotkey', 'ni ya shi kakaxi');

		$this->app->when(\App\Http\Controllers\HomeController::class)
            ->needs('sami')
            ->give("daughter");

		//job callback when fail
//        \Queue::failing(function(JobFailed $event){
//            file_put_contents(
//                'D:/laravel-test-data/queue/fail/log.txt',
//                '[' .date('Y-m-d H:i:s') .']' . ' info : '. 'connectionName : '. $event->connectionName. ' job : '.get_class($event->job)
//            );
//            return false;
//        });

        \Queue::before(function (JobProcessing $event) {
            $file = self::QUEUE_FOLDER_BEFORE.'statistics.txt';

            if (!file_exists($file)) {
                $fileinfo = 'before job count : 1';
            } else {
                $fileinfo = file_get_contents($file);
                $fileinfo = explode(':', $fileinfo);
                $count = (int)$fileinfo[1];
                $fileinfo = 'before job count : '. (++$count);
            }

            file_put_contents($file, $fileinfo);
        });

        \Queue::after(function (JobProcessed $event) {
            $file = self::QUEUE_FOLDER_AFTER.'statistics.txt';

            if (!file_exists($file)) {
                $fileinfo = 'after job count : 1';
            } else {
                $fileinfo = file_get_contents($file);
                $fileinfo = explode(':', $fileinfo);
                $count = (int)$fileinfo[1];
                $fileinfo = 'after job count : '. (++$count);
            }

            file_put_contents($file, $fileinfo);
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
