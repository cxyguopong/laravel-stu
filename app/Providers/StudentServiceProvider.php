<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Student;

class StudentServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Student::class, function($app){
            $student = new Student([]);
            $student->school = "fast quick";
            return $student;
        });
    }
}
