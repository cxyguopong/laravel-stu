<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Http\Response;

use Illuminate\Foundation\Validation\ValidatesRequests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Bus\DispatchesJobs;

use App\Http\Requests\RegisterPost;

use App\Jobs\TestQueueFirst;
use App\Jobs\SendReminderEmail;

use App\Events\OrderShipped;

class HomeController extends Controller
{

    public function index(Request $req)
    {
        echo $req->path();
        echo "<br>";
        var_dump($req->is("home/"));
        exit;
    }

    public function two(Request $req)
    {
        echo "path : " . $req->path();
        echo "<br>";
        var_dump($req->is("home/*/*/"));
    }

    public function three(Request $req, $id = null)
    {
        echo "id : " . $id;
        echo "<br>";
        echo 'current url : ' . $req->url();
        echo "<br>";
        echo "fullfil current url : " . $req->fullUrl();

        echo "<br>";
        $method = $req->method();
        echo "method : " . $method;
        echo "<br>";
        echo "request pattern is post : " . ($req->isMethod('post') ? 'Yes' : 'No');
        echo "<br>";
        echo "request pattern is get : " . ($req->isMethod('get') ? 'Yes' : 'No');

        echo nl2br("\n\n------------ user input -------------\n");
        print_r($req->all());
        echo nl2br("\n");
        echo "sex : " . $req->input('sex');
        echo nl2br("\n");
        echo "halo : " . $req->input('halo', 'default(suck blood)');
        echo "<br>";
        echo "index 0 of love : " . $req->input('love.0');

        echo "<br>";
        echo "index 0 name of elder : " . $req->input('elder.0.degree');

        echo "<br><br>use input only and except:<br>";
        $input = $req->only(['name', 'sex', 'non-existent']);
        print_r($input);
        echo "<br>";
        $inputExcept = $req->except('love', 'elder');
        print_r($inputExcept);

        echo "<br>use intersect : <br>";
        $inputIntersect = $req->intersect(['name', 'sex', 'non-existent']);
        print_r($inputIntersect);

        echo "<br><br>has:<br>";
        var_dump($req->has('age'));
    }

    public function form(Request $req, Response $res)
    {

        //return response("hello form !")->cookie("name", "feiyuqing", 30);   
        return view('home/form');
    }

    public function formpost(RegisterPost $req)
    {
        return $req->except('_token');
    }

    public function response(Request $req)
    {

        return response()
            ->json(['name' => 'Abigail', 'state' => 'CA'])
            ->setCallback('abcde');
    }

    public function response1(Request $req)
    {
        //exit('is response1, session value:'.$req->status);    
    }

    public function profile()
    {
        return view('profile');
    }

    public function session(Request $req)
    {
        $sess = session();
        if ($sess->has('my_status')) {
            $count = $sess->get('count');
            if ($count > 1) {
                session()->reflash();
            }

            $sess->put('count', --$count);
            $str = "last written cookie is : <b>" . $sess->get('my_status') . '</b> The number of effective left : <b>' . $count . "</b>";
            return response($str);
        } else {
            $sess->flash('my_status', 'Task was successful!');
            $sess->put('count', 5);
            return response('writing to session named my_status!');
        }
    }

    public $sami;

    public function ctvar(\App\Student $student)
    {

        echo \App\User::count();
        exit;

        $student2 = \App::make(\App\Student::class);
        $student3 = resolve(\App\Student::class);
        echo "<pre>";
        var_dump('is singlegon : ' . ($student === $student2 ? 'yes' : 'no'));

        echo "school : " . $student2->school;
        echo "<br>";
        echo $student3->school;
    }

    public function cli()
    {
//        \Artisan::queue('email:send', [
//            'user' => 1, '--queue' => 'default'
//        ]);
        echo "kakaxi";

    }

    public function event()
    {   $this->info = array('name'=>'kaaxi', 'info'=>"zhang");
        //$order = Order
        //event(new OrderShipped(array('status' => 'success', 'info' => 'ni ya shi kakaxi!')));
        file_put_contents('D:/laravel-test-data/queue/'. date('Y-m-d His') . ' ' . $this->info['name'].'.txt', $this->info['info']. "\ntime is : ". date('Y/m/d H:i:s'));
    }

    public function queue(){
//        $nameprefix = "";
//        for ($i = 0; ++$i<=8;) {
//            $nameprefix .= chr(mt_rand(0,25) + 65);
//        }
//        for ($i = 0; ++$i<=500;) {
//            $job = (new \App\Jobs\SendReminderEmail(['name'=>$nameprefix .'-'. $i, 'info'=>'hello world ']))->delay(\Carbon\Carbon::now()->addSeconds($i*30));
//            dispatch($job);
//        }


        $info = [
            'name'=>'regex dog',
            'info'=>"I'm job1 queue"
        ];

        $job = (new TestQueueFirst($info))->delay(2)->onQueue('job1test');
        dispatch($job);

        echo "test a queue task;";
    }
    //public function four()
}