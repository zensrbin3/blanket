<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::orderBy('created_at', 'desc')->get();
        return view('question.index', ['questions' => $questions]);
    }

    public function create()
    {
        return view('question.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->input(), [
            'question_text' => 'required|max:255',
            'answers' => 'required|array|size:4',
            'answers.*' => 'required|string|min:1',
            'correct_answer' => 'required',

        ], [
            'correct_answer.required' => 'Select true answer',
        ]);

       $validated = $validator->validate();

            if($validated) {

                $questionText = $request->get('question_text');

                $question = new Question();
                $question->question_description = $questionText;
                $question->save();

                $answers = $request->get("answers");
                $correctAnswer = $request->get("correct_answer");

                foreach ($answers as $key => $answerText) {
                    $answer = new Answer();
                    if ($key == $correctAnswer) {
                        $answer->is_correct = 1;
                    } else {
                        $answer->is_correct = 0;
                    }

                    $answer->answer_description = $answerText;

                    $answer->question()->associate($question);
                    $answer->save();
                }
                session()->flash('flash_type', 'success');
                session()->flash('flash_msg', 'Data has been added successfully');
                return redirect('/question/index');
            }
            else
            {
                return redirect('/question/create');
            }

    }

    public function show(Question $question)
    {
        return view('question.show', ['question' => $question]);
    }
    public function edit(Question $question, Request $request)
    {
            return view('question.edit', ['question' => $question]);

    }

    public function update(Request $request,Question $question)
    {
        $validator = Validator::make($request->all(), [
            'question_text' => 'required|max:255',
            'answers' => 'required|array|size:4',
            'answers.*' => 'required|string|min:1',
            'correct_answer' => 'required',

        ], $messages = [
            'correct_answer.requried' => 'Select true answer',
        ]);

        $validated = $validator->validate();


        if($validated) {

            $questionText = $request->get('question_text');
            $question->question_description = $questionText;
            $question->save();

            $answers = $request->get("answers");
            $correctAnswer = $request->get("correct_answer");

            foreach ($question->answer as $index => $answer) {
                $answer->answer_description = $answers[$index];
                $answer->is_correct = 0;
                if ($correctAnswer == $index) {
                    $answer->is_correct = 1;
                }

                $answer->save();
            }

            session()->flash('flash_type', 'success');
            session()->flash('flash_msg', 'Data has been edited successfully');

            return redirect( route('question.show',$question));
        } else {
            return redirect('/question/edit');
        }
    }

    public function destroy(Question $question)
    {
        $question->delete();
        session()->flash('flash_type', 'success');
        session()->flash('flash_msg', 'Data has deleted successfully');
        return redirect('/question/index');
    }



}
