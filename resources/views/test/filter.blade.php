@extends('layout.layout')
@section('content')
    @foreach($tests as $test)
        <div>
            <p>{{$test->id}}</p>
            <p>{{$test->user_id}}</p>
            <p>{{$test->answer_sheet_id}}</p>
            <p>{{$test->category_id}}</p>
            <p>{{$test->percentage}}</p>
        </div>
    @endforeach
@endsection
