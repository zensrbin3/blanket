<?php

namespace App\Http\Controllers;
use App\Models\Test;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Answer;
use App\Models\AnswerSheet;
use App\Models\AnswerSheetQuestion;
use App\Models\AnswerSheetQuestionAnswer;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
class AnswerSheetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Ako je date prosleđen, izvršava se validacija
        if ($request->has('date')) {
            $request->validate([
                'date' => 'required|date',
            ]);

            $date = $request->get('date');
            $answerSheets = AnswerSheet::whereDate('created_at', $date)->orderBy('created_at', 'desc')->get();
        } else {
            // Ako date nije prosleđen, prikazuju se svi zapisi
            $answerSheets = AnswerSheet::orderBy('created_at', 'desc')->get();
        }

        return view('answer_sheet.index', ['answer_sheets' => $answerSheets]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('answer_sheet.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $allQuestionsNumber = Question::count();
        $validator = Validator::make($request->input(), [
            'description' => 'required|max:255',
            'number_of_questions' => 'required|integer|max:' . $allQuestionsNumber,
            'number_of_groups' => 'required|integer',
        ]);
        $validated = $validator->validate();

        if($validated) {
            $answerSheetDescription = $request->get('description');
            $numberOfQuestions = $request->get('number_of_questions');
            $numberOfGroups = $request->get('number_of_groups');
            for($i = 0; $i < $numberOfGroups; $i++) {
                $answerSheet = new AnswerSheet();
                $answerSheet->description = $answerSheetDescription;
                $answerSheet->group_number = $i+1;
                $answerSheet->save();
//                $test = new Test();
//                $test->answer_sheet_id = $answerSheet->id;
//                $test->user_id = auth()->user()->id;
//                $test->status = 'new';
//                $test->save();
                $randomQuestions = [];
                $usedQuestions = [];
                for ($j = 0; $j < $numberOfQuestions; $j++) {

                    do {
                        $randomOffset = rand(0, $allQuestionsNumber - 1);
                    } while (in_array($randomOffset, $usedQuestions));

                    $question = Question::query()->offset($randomOffset)->limit(1)->first();
                    $usedQuestions[$j]=$randomOffset;
                    $randomQuestions[$j] = $question;
                }

                $iteration = 1;
                foreach ($randomQuestions as $question) {
                    $answerSheetQuestion = new AnswerSheetQuestion();
                    $answerSheetQuestion->answer_sheet()->associate($answerSheet);
                    $answerSheetQuestion->ordinal = $iteration;
                    $answerSheetQuestion->question_description = $question->question_description;
                    $answerSheetQuestion->save();


                    $answers = $question->answer;
                    $shuffledAnswers = $answers->shuffle();
                    $iteration2 = 1;
                    foreach ($shuffledAnswers as $answer) {
                        $answerSheetAnswer = new AnswerSheetQuestionAnswer();
                        $answerSheetAnswer->answer_sheet_question()->associate($answerSheetQuestion);
                        $answerSheetAnswer->ordinal = $iteration2;
                        $answerSheetAnswer->is_correct = $answer->is_correct;
                        $answerSheetAnswer->answer_description = $answer->answer_description;
                        $answerSheetAnswer->save();
                        $iteration2++;
                    }

                    $iteration++;
                }



            }

            session()->flash('flash_type', 'success');
            session()->flash('flash_msg', 'Data has been added successfully');
            return redirect(route("answer_sheet.index"));
        } else {
           return redirect(route('answer_sheet.create'));
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */


    public function show(AnswerSheet $answerSheet,$full)
    {

        $data = [
            'answerSheet' => $answerSheet,
        ];

        if($full==1){
            $name=$answerSheet->description . "-group-" . $answerSheet->group_number .'-full.pdf';
            $view="pdf.answer_sheet_full";
        } else {
            $name=$answerSheet->description . "-group-" . $answerSheet->group_number .'.pdf';
            $view="pdf.answer_sheet";
        }

        $pdf = Pdf::loadView($view, $data);
        return $pdf->download($name);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(AnswerSheet $answerSheet)
    {
        return view('answer_sheet.edit', ['answer_sheet' => $answerSheet]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, AnswerSheet $answerSheet)
    {
        $validator = Validator::make($request->input(), [
            'description' => 'required|max:255',
        ], []);

        $validated = $validator->validate();
        if($validated) {
            $answerSheetDescription = $request->get('description');
            $answerSheet->description = $answerSheetDescription;
            $answerSheet->save();
            session()->flash('flash_type', 'success');
            session()->flash('flash_msg', 'Data has been edited successfully');
            return redirect(route("answer_sheet.index"));
        } else {
            return redirect(route("answer_sheet.edit", $answerSheet));
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy(AnswerSheet  $answerSheet)
    {
        $answerSheet->delete();
        session()->flash('flash_type', 'success');
        session()->flash('flash_msg', 'Data has deleted successfully');
        return redirect(route('answer_sheet.index'));
    }



}
