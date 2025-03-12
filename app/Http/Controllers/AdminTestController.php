<?php

namespace App\Http\Controllers;

use App\Models\AnswerSheet;
use App\Models\Test;
use App\Models\User;
use Illuminate\Http\Request;

class AdminTestController
{
    public function index(){
        $users = User::where('name', '!=', 'admin')->get();
        $answerSheets = AnswerSheet::all();
        return view('test_add_admin.index', compact('users', 'answerSheets'));
    }

    public function store(Request $request){
        foreach ($request->assignment as $userId=>$answerSheetId){
            $test = new Test();
            $test->user()->associate($userId);
            $test->answerSheet()->associate($answerSheetId);
            $test->status = 'new';
            $test->save();
        }
        return redirect()->route('admin.test.index')->with('success', 'Tests added successfully');
    }
}
