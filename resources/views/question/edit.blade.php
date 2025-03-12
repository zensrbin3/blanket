<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script src="{{asset('js/app.js')}}"></script>
<script src="{{asset('js/questionCreate.js')}}"></script>

@extends('layout.layout')
@section('content')
    <style>
        .backGround{
            background: linear-gradient(
                to bottom,
                #a0aec0 0%,
                #a0aec0 25%,
                #f8f9fa 75%,
                #f8f9fa 100%
            );
        }
    </style>
<div class="container">

    <div class="row">
        <h1>{{__("Edit Question")}}</h1>
    </div>

    <form method="POST" action="{{   route('question.update',$question)   }}">
        @csrf
        <div class="mb-3">
            <label class="form-label" for="question_text" >{{ __("Question text:") }}</label>
            <div id="editor0" style="height: 200px;">{!! $question->question_description !!}</div>
            <input type="hidden" name="question_text" value="{{ old('question_text', $question->question_description) }}">
            @error('question_text')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label"> {{ __("Answers:") }} </label><br>
            @php
                $i = 1;
            @endphp
            @foreach($question->answer as $answer)
                    <div class="row mb-5 g-3">
                        <div class="col-auto"> <label class="form-label">{{$loop->iteration}})</label> </div>
                        <div class="col-6">
                            <div id="editor{{$i++}}">{!! $answer->answer_description !!}</div>
                            <input type="hidden" name="answers[{{$loop->index}}]" value="{{ old('answers.'.$loop->index, $answer->answer_description) }}">
                        </div>

                        @if($answer->is_correct)
                            <div class="col-auto"> <input class="form-check-input" type="radio"  name="correct_answer" value="{{$loop->index}}" {{ old("correct_answer")==NULL || old("correct_answer")=="$loop->index" ? 'checked' : '' }}></div>
                        @else
                            <div class="col-auto"> <input class="form-check-input" type="radio"  name="correct_answer" value="{{$loop->index}}" {{ old("correct_answer")=="$loop->index" ? 'checked' : ''}}></div>
                        @endif

                    </div>
            @endforeach


        </div>

        <div class="mb-5 pb-5 pt-4">
            <x-input.button text="Update"/>
        </div>


    </form>
</div>
@endsection

