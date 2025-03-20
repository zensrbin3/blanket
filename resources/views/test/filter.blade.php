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
        .test-card {
            border: none;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background: #fff;
        }
        .test-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }
        .test-card-header {
            background: linear-gradient(45deg, #6a11cb, #2575fc);
            color: #fff;
            padding: 1rem;
        }
        .test-card-body {
            padding: 1rem;
        }
        .passed {
            color: green;
            font-weight: bold;
        }
        .failed {
            color: red;
            font-weight: bold;
        }
        .fade-in {
            animation: fadeIn 1s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
    </style>
    @if($tests==null)
        <div class="text-center">There are no tests for that filter!</div>
    @endif
    <div class="container">
        <h1 class="text-center mb-4">Test Results</h1>
        @if($tests->isEmpty())
            <div class="text-center" style="color:darkred; font-size:20px;">There are no tests for that filter!</div>
        @else
            <div class="row">
                @foreach($tests as $test)
                    <div class="col-md-4 mb-4">
                        <div class="card test-card fade-in">
                            <div class="test-card-header">
                                <h5 class="card-title">Test: {{ $test->answerSheet->description }}</h5>
                            </div>
                            <div class="card-body">
                                <p><strong>User:</strong> {{ $test->user->name }}</p>
                                <p><strong>Category:</strong> {{ $test->category->name }}</p>
                                <p><strong>Percentage:</strong> {{ $test->percentage }}%</p>
                                @if(is_null($test->percentage))
                                    <p class="text-warning">No result available</p>
                                @elseif($test->percentage >= 55)
                                    <p class="passed">Passed</p>
                                @else
                                    <p class="failed">Failed</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
