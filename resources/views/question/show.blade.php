
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
            height: 84%;
        }
    </style>
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
                <x-trueAnswer description="{{ strip_tags($answer->answer_description) }}"/>
            @else
                <x-wrongAnswer description="{{ strip_tags($answer->answer_description) }}"/>
            @endif

        </div>

        @endforeach




</div>
@endsection
