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
        $numberOfTrueAnswers = 0;
        $answerSheet = $test->answerSheet;
        $answerSheetQuestions = $answerSheet->answer_sheet_question;
        $selectedAnswers = $request->get('answers');
        foreach ($answerSheetQuestions as $question) {
            $selectedAnswer = $selectedAnswers[$i];
            $test->testQuestionAnswers()->attach($question->id, ['answer_sheet_question_answer_id' => $selectedAnswer]);
            $correctAnswer = $question->answer_sheet_question_answer->where('is_correct',true)->first();
            if($selectedAnswer == $correctAnswer->id){
               $numberOfTrueAnswers += 1;
            }
            $i++;
        }
        $test->update(['status' => 'completed']);
        return redirect()->route('test.seeResult',[$test,$numberOfTrueAnswers,$i]);
    }

    public function seeResult(Test $test,$numberOfTrueAnswers,$numberOfQuestions){
        $percentage = $numberOfTrueAnswers/$numberOfQuestions*100;
        $name = $test->answerSheet->description;
        return view('test.result', ['percentage' => $percentage,'name'=>$name]);
    }
}
