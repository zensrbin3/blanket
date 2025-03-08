<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\AnswerSheet;
use App\Models\AnswerSheetQuestion;
use App\Models\AnswerSheetQuestionAnswer;
use App\Models\Question;
use App\Models\Test;
use App\Models\TestQuestionAnswers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class TestController
{
    public function index(){
        $tests = Test::forUser()->get();
        return view('test.index', [
            'tests' => $tests
        ]);
    }

    public function show(Test $test)
    {
        $answerSheet = $test->answerSheet;
        $sheetQuestions = $answerSheet->answer_sheet_question;
        return view('test.show', [
            'sheetQuestions'=> $sheetQuestions,
            'test'         => $test,
            'name'         => $answerSheet->description,
        ]);
    }


    public function update(Request $request,Test $test)
    {
        $i=0;
        $answerSheet = $test->answerSheet;
        $answerSheetQuestions = $answerSheet->answer_sheet_question;
        $selectedAnswers = $request->get('answers');
        foreach ($answerSheetQuestions as $question) {
            $test->testQuestionAnswers()->attach($question->id, ['answer_sheet_question_answer_id' => $selectedAnswers[$i++]]);
        }
        $test->update(['status' => 'completed']);
        return redirect()->route('test.index')->with('success', 'Test completed successfully');
    }
}
