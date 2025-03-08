<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class HelloWorldController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function test()
    {
        return view('hello-world.test', ['username' => "Kristjan Peric"]);
    }
}
