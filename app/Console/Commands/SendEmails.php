<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\DripEmailer;
use App\User;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:send {user* : the ID of the user} {--x|queue=* : Whether the job should be queued}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send drip e-mails to a user';

    protected $drip;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(DripEmailer $drip)
    {
        parent::__construct();
        $this->drip = $drip;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //$this->drip->send(User::find($this->argument('user')));

        echo "------------- argument --------------\n";
        $userid = $this->argument("user");
        print_r($userid);

        echo "\n------------- option ---------------\n";
        $queue = $this->option("queue");
        print_r($queue);

        $name = $this->ask("what is your name?");

        echo "your name is : {$name}";

        $choice = 'your choice is : '. ($this->confirm("Do you wish to continue ?") ? 'yes' : 'no');
        echo $choice."\n";

        $love = $this->anticipate("what is your love ?", ['game', 'eat', 'swimming', 'ski'], 'swimming');
        print_r($love);

        echo "\n";
        $this->info('this is a info!');
        $this->error('Something went wrong!');
        $this->line('Display line');

        echo "------------ table layout -------------\n";
        $header = ['Name', 'Email', 'created_at'];
        $users = User::all(['name', 'email', 'created_at'])->toArray();
        $this->table($header, $users);

        echo "------------- progressBar ---------------";
        $users = User::all();
        $bar = $this->output->createProgressBar(count($users));
        foreach ($users as $user) {
            $user->name;
            $bar->advance();
        }
        $bar->finish();
        echo "\n";
        exit;
    }
}
