<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendReminderEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $info;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $info = array())
    {
        $this->info = $info;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        file_put_contents('D:/laravel-test-data/queue/'. date('Y-m-d Hi') . ' ' . $this->info['name'].'.txt', $this->info['info']. "\ntime is : ". date('Y/m/d H:i:s'));
    }
}
