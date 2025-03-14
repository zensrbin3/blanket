@extends('layout.layout')
@section('content')
    <style>
        .backGround{
            background: linear-gradient(
                to bottom,
                #f8f9fa 0%,
                #f8f9fa 25%,
                #a0aec0 75%,
                #a0aec0 100%
            );
        }
        .backgroundCard{
            background: linear-gradient(
                to bottom,
                #f8f9fa 0%,
                #f8f9fa 25%,
                #a0aec0 75%,
                #a0aec0 100%
            );
        }
        /* Svaki step se sakriva osim kada ima klasu active */
        .step {
            display: none;
        }
        .step.active {
            display: block;
        }
        /* Stilizacija navigacionih dugmadi */
        .navigation-buttons {
            margin-top: 1rem;
        }
    </style>
    <div class="container mt-5">
        <h1 class="mb-4">Test: {{ $name }}</h1>
        @foreach($answerSheetQuestions as $index => $answerSheetQuestion)
            <div class="step" id="step-{{ $index }}">
                <div class="mb-4 p-3 border rounded backgroundCard">
                    <h5 class="mb-3">{{ $index + 1 }}. {!! $answerSheetQuestion->question_description !!}</h5>
                    @foreach($answerSheetQuestion->answer_sheet_question_answer as $answer)
                        <div class="form-check">
                            <label class="form-check-label" for="q{{ $index }}a{{ $answer->id }}">
                                {!! $answer->answer_description !!}
                            </label>
                            @if($answer->id == $trueAnswers[$index])
                                <span style="color: green; font-size: 1.2em;">&#10004;</span>
                            @endif
                            @if(isset($selectedAnswers[$index]) && $answer->id == $selectedAnswers[$index] && $answer->id != $trueAnswers[$index])
                                <span style="color: red; font-size: 1.2em;">&#10006;</span>
                            @endif
                        </div>
                    @endforeach
                </div>
                <div class="navigation-buttons">
                    @if($index > 0)
                        <button type="button" class="btn btn-secondary prevBtn">Previous</button>
                    @endif
                    @if($index < count($answerSheetQuestions) - 1)
                        <button type="button" class="btn btn-primary nextBtn">Next</button>
                    @else
                        <a  class="btn btn-primary" href="{{route('test.index')}}">Return to test/s</a>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const steps = document.querySelectorAll('.step');
            let currentStep = 0;
            steps[currentStep].classList.add('active');

            const nextBtns = document.querySelectorAll('.nextBtn');
            nextBtns.forEach(btn => {
                btn.addEventListener('click', function(){
                    steps[currentStep].classList.remove('active');
                    currentStep++;
                    steps[currentStep].classList.add('active');
                });
            });

            const prevBtns = document.querySelectorAll('.prevBtn');
            prevBtns.forEach(btn => {
                btn.addEventListener('click', function(){
                    steps[currentStep].classList.remove('active');
                    currentStep--;
                    steps[currentStep].classList.add('active');
                });
            });
        });
    </script>
@endsection
