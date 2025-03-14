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
        $trueAnswers = [];
        $answerSheetQuestions = $test->answerSheet->answer_sheet_question;
        $selectedAnswers = $request->get('answers');
        foreach ($answerSheetQuestions as $question) {
            $selectedAnswer = $selectedAnswers[$i];
            $test->testQuestionAnswers()->attach($question->id, ['answer_sheet_question_answer_id' => $selectedAnswer]);
            $correctAnswer = $question->answer_sheet_question_answer->where('is_correct',true)->first();
            $trueAnswers[$i]=$correctAnswer->id;
            if($selectedAnswer == $correctAnswer->id){
               $numberOfTrueAnswers += 1;
            }
            $i++;
        }
        $test->update(['status' => 'completed']);
        session(['selectedAnswers' => $selectedAnswers]);
        session(['trueAnswers' => $trueAnswers]);
        return redirect()->route('test.percentage',[$test,$numberOfTrueAnswers,count($trueAnswers)]);
    }

    public function percentage(Test $test,$numberOfTrueAnswers,$numberOfQuestions){
        $percentage = $numberOfTrueAnswers/$numberOfQuestions*100;
        $name = $test->answerSheet->description;
        return view('test.percentage', [
            'percentage'      => $percentage,
            'name'            => $name,
            'test'            => $test,
        ]);
    }

    public function currentResult(Test $test){
        $answerSheetQuestions = $test->answerSheet->answer_sheet_question;
        $selectedAnswers = session('selectedAnswers', []);
        $trueAnswers = session('trueAnswers', []);
        return view('test.current_result', [
            'answerSheetQuestions'=> $answerSheetQuestions,
            'selectedAnswers' => $selectedAnswers,
            'trueAnswers' => $trueAnswers,
            'name' => $test->answerSheet->description
        ]);
    }

    public function results(Test $test){
        $selectedAnswers=[];
        $trueAnswers=[];
        $answerSheetQuestions = $test->answerSheet->answer_sheet_question;
        foreach($answerSheetQuestions as $question){
            $trueAnswers[] = $question->answer_sheet_question_answer->where('is_correct',true)->first()->id;
            $selectedAnswers[] = $question->testAnswer()->value('answer_sheet_question_answer_id');
        }
        return view('test.results',[
            'name' => $test->answerSheet->description,
            'answerSheetQuestions'=> $answerSheetQuestions,
            'selectedAnswers' => $selectedAnswers,
            'trueAnswers' => $trueAnswers
        ]);
    }
}
