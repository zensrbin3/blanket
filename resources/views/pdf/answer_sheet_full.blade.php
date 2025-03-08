<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<div class="container">
    <table style="width: 100%; border-bottom: 1px solid black; margin-bottom: 10px;">
        <tr>
            <td style="width: 50%;"><h2 style="display: inline;">Exam: {{ $answerSheet->description }}</h2></td>
            <td style="width: 50%; text-align: right;"><h3 style="display: inline;">Group: {{ $answerSheet->group_number }}</h3></td>
        </tr>
    </table>
    @php
        $letters = ["a", "b", "c", "d"];
    @endphp
        @foreach($answerSheet->answer_sheet_question as $question)
        <table style="width: 100%;">
            <tr>
                <td style="width: 20px; text-align: center; vertical-align: top; padding-top: 10px;">
                    {{ $question->ordinal }})
                </td>
                <td style="width: 90%; padding: 10px">
                    {!! $question->question_description !!}
                </td>
            </tr>
        </table>
        <table style="width: 100%; border-bottom: 1px solid black; margin-bottom: 10px;">
                    @for($i=0;$i<$question->answer_sheet_question_answer->count();$i=$i+2)
                        <tr>
                            <x-answers.answer is_correct="{{ $question->answer_sheet_question_answer[$i]->is_correct }}" answer_description="{!! $question->answer_sheet_question_answer[$i]->answer_description !!}" letter="{{ $letters[$i] }}"/>
                            @if(isset($question->answer_sheet_question_answer[$i + 1]))
                                <x-answers.answersTrue is_correct="{{ $question->answer_sheet_question_answer[$i+1]->is_correct }}" answer_description="{!! $question->answer_sheet_question_answer[$i+1]->answer_description !!}" letter="{{ $letters[$i+1] }}"/>
                            @endif
                        </tr>
                    @endfor
        </table>



        @endforeach
</div>

