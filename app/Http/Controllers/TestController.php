<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\AnswerSheet;
use App\Models\AnswerSheetQuestion;
use App\Models\AnswerSheetQuestionAnswer;
use App\Models\Question;
use App\Models\Test;
use App\Models\TestQuestionAnswers;
use App\Models\User;
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
        $percentage = count($trueAnswers) > 0 ? ($numberOfTrueAnswers / count($trueAnswers)) * 100 : 0;
        $test->update(['percentage' =>  $percentage]);
        session(['selectedAnswers' => $selectedAnswers]);
        session(['trueAnswers' => $trueAnswers]);
        return redirect()->route('test.percentage',[$test]);
    }

    public function percentage(Test $test){
        $name = $test->answerSheet->description;
        $percentage = $test->percentage;
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

    public function filter(Request $request){
        $query = Test::query();
        $query->when($request->filled('category_id'), function($q) use ($request) {
            $q->where('category_id', $request->category_id);
        });
        $query->when($request->filled('user_id'), function($q) use ($request) {
            $q->where('user_id', $request->user_id);
        });
        $query->when($request->filled('percentage'), function($q) use ($request) {
            $q->where('percentage', '>=', $request->percentage);
        });
        $tests = $query->get();
        dd($tests);
        return view('test.filter',compact('tests'));
    }
}
