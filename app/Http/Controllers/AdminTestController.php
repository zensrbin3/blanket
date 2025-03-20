<?php

namespace App\Http\Controllers;

use App\Models\AnswerSheet;
use App\Models\Test;
use App\Models\User;
use Illuminate\Http\Request;

class AdminTestController
{
    public function index(){
        $users = User::where('role', '!=', 'admin')->get();
        $answerSheets = AnswerSheet::all();
        return view('test_add_admin.index', compact('users', 'answerSheets'));
    }

    public function store(Request $request){
        if($request->assignment==null){
            return redirect()->route('admin.test.index')->with('error','You have not selected any tests.');
        }
        foreach ($request->assignment as $userId => $values) {
            foreach ((array)$values as $value) {
                list($sheetId, $categoryId) = explode('|', $value);
                $test = new Test();
                $test->user()->associate($userId);
                $test->answerSheet()->associate($sheetId);
                $test->category_id = $categoryId;
                $test->status = 'new';
                $test->save();
            }
        }
        return redirect()->route('admin.test.index')->with('success', 'Tests added successfully');
    }
}
