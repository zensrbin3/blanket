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
        .cardBackground{
            background: linear-gradient(
                to bottom,
                #a0aec0 0%,
                #a0aec0 25%,
                #f8f9fa 75%,
                #f8f9fa 100%
            );
            border:1px solid black;
        }
        .cardBackground:hover {
            background: linear-gradient(
                to bottom,
                #f8f9fa 0%,
                #f8f9fa 25%,
                #a0aec0 75%,
                #a0aec0 100%
            );
        }
        .view:hover{
            background-color: dodgerblue;
        }
        .start{
            background-color: green;
        }
        .start:hover{
            background-color: darkgreen;
        }
    </style>
    <div class="container mt-5">
        <h1 class="mb-4">Tests</h1>
        @if(session()->has('success'))
            <div class="alert alert-success text-center" >{{session()->get('success')}}</div>
        @endif
        @if($tests->isEmpty())
            <p>No test found.</p>
        @else
            <div class="row ">
                @foreach($tests as $test)
                    <div class="col-md-4">
                        <div class="card mb-4 cardBackground">
                            <div class="card-body">
                                <h5 class="card-title">{{ $test->answerSheet->description }}</h5>
                                <p class="card-text">
                                    <strong>Group:</strong> {{ $test->answerSheet->group_number }}<br>
                                </p>
                                @if($test->status=='new')
                                    <a href="{{ route('test.show', $test->id) }}" class="btn btn-primary start">
                                       Start test
                                    </a>
                                @elseif($test->status='completed')
                                    <a href="{{route('test.results',$test->id)}}" class="btn btn-primary view">
                                        View test
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection

