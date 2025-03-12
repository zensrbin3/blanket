<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminTestController
{
    public function index(){
        $users = User::where('name', '!=', 'admin')->get();
        dd($users);
    }
}
