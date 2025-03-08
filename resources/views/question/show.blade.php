
@extends('layout.layout')
@section('content')

@if(Session::has('flash_msg'))
    <div id="flashMsg" class="alert alert-success text-center" data-tip="{{ Session::get('flash_type') }}" >{{ Session::get('flash_msg') }}</div>
@endif

<div class="container">
    <h1 class="row">{{__("Question text")}}</h1>

    <div class="row bg-light border-secondary rounded-pill mb-4">
        <h4 class="mt-2">
            {!! $question->question_description !!}
        </h4>
    </div>

    <h1 class="row">{{__("Answers")}}</h1>



        @foreach($question->answer as $answer)
        <div class="row">
            @if($answer->is_correct)
                <h4 class="bg-info border-secondary rounded-pill">{{ strip_tags($answer->answer_description) }}</h4>
            @else
                <h4 class="bg-light border-secondary rounded-pill">{{ strip_tags($answer->answer_description) }}</h4>
            @endif

        </div>

        @endforeach




</div>
@endsection
