@extends('layout.layout')
@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Tests</h1>
        @if(session()->has('success'))
            <div class="alert alert-success text-center" >{{session()->get('success')}}</div>
        @endif
        @if($tests->isEmpty())
            <p>No test found.</p>
        @else
            <div class="row">
                @foreach($tests as $test)
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <div class="card-body">
                                <h5 class="card-title">{{ $test->answerSheet->description }}</h5>
                                <p class="card-text">
                                    <strong>Group:</strong> {{ $test->answerSheet->group_number }}<br>
                                </p>
                                <a href="{{ route('test.show', $test->id) }}" class="btn btn-primary">
                                   Start test
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection

