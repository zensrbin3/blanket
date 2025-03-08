@extends('layout.layout')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Test: {{ $name }}</h2>
        <form action="{{ route('test.update', $test) }}" method="POST">
            @csrf
            @foreach($sheetQuestions as $questionIndex => $sheetQuestion)
                <div class="mb-4 p-3 border rounded">
                    <table>
                        <td style="width: 20px; text-align: center; vertical-align: top; padding-top: 10px;" class="fw-bold">{{$questionIndex + 1}})</td>
                        <td style="padding: 10px 10px 10px 5px;">{!! $sheetQuestion->question_description !!}</td>
                    </table>
                    @foreach($sheetQuestion->answer_sheet_question_answer as $answer)
                        <div class="form-check">
                            <input class="form-check-input" type="radio"
                                   name="answers[{{$questionIndex}}]"
                                   value="{{ $answer->id }}">
                            <label class="form-check-label">
                                {!! $answer->answer_description !!}
                            </label>
                        </div>
                    @endforeach
                </div>
            @endforeach


            <button type="submit" class="btn btn-primary">Finish test</button>
        </form>
    </div>
@endsection
