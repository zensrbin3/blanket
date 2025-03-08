
@extends('layout.layout')
@section('content')
    <div class="row">
        <div class="col-auto">
            <h1>Answer Sheet: {{$answerSheet->description}}</h1>
        </div>
        <ul class="list-group list-group-flush fs-4">
            <li class="list-group-item">Group: {{$answerSheet->group_number}}</li>
            <li class="list-group-item">Created at: {{$answerSheet->created_at}}</li>
            <li class="list-group-item">Updated at: {{$answerSheet->updated_at}}</li>
            <li class="list-group-item">
                <button class="btn btn-outline-dark" onclick="location.href='{{ route('answer_sheet.showfull',$answerSheet) }}'" type="button">{{__("Show with answers")}}</button>
                <button class="btn btn-outline-dark" onclick="location.href='{{ route('answer_sheet.showquestions',$answerSheet) }}'" type="button">{{__("Show only questions")}}</button>
            </li>
        </ul>
    </div>
@endsection
