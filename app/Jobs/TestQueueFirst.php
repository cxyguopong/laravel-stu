<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Mockery\Exception;

class TestQueueFirst implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $info;


    public $tries = 4;

    public $timeout = 5;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $info = array())
    {
        $this->info = $info;
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //throw new \Exception();
        file_put_contents('D:/laravel-test-data/queue/job1/'. date('Y-m-d His') . ' ' . $this->info['name'].'.txt', $this->info['info']. "\ntime is : ". date('Y/m/d H:i:s'));
        //
    }
}
