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
            background:linear-gradient(
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
        <form id="multiStepForm" action="{{ route('test.update', $test) }}" method="POST">
            @csrf
            @foreach($sheetQuestions as $index => $sheetQuestion)
                <div class="step" id="step-{{ $index }}">
                    <div class="mb-4 p-3 border rounded backgroundCard">
                        <h5 class="mb-3">{{ $index + 1 }}. {!! $sheetQuestion->question_description !!}</h5>
                        @foreach($sheetQuestion->answer_sheet_question_answer as $answer)
                            <div class="form-check">
                                <input class="form-check-input" type="radio"
                                       name="answers[{{ $index }}]"
                                       value="{{ $answer->id }}"
                                       id="q{{ $index }}a{{ $answer->id }}">
                                <label class="form-check-label" for="q{{ $index }}a{{ $answer->id }}">
                                    {!! $answer->answer_description !!}
                                </label>
                            </div>
                        @endforeach
                    </div>
                    <div class="navigation-buttons">
                        @if($index > 0)
                            <button type="button" class="btn btn-secondary prevBtn">Previous</button>
                        @endif
                        @if($index < count($sheetQuestions) - 1)
                            <button type="button" class="btn btn-primary nextBtn">Next</button>
                        @else
                            <button type="submit" class="btn btn-success">Finish test</button>
                        @endif
                    </div>
                </div>
            @endforeach
        </form>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const steps = document.querySelectorAll('.step');
            let currentStep = 0;
            steps[currentStep].classList.add('active');

            const nextBtns = document.querySelectorAll('.nextBtn');
            nextBtns.forEach(btn=>{
                btn.addEventListener('click',function(){
                    steps[currentStep].classList.remove('active');
                    currentStep++;
                    steps[currentStep].classList.add('active');
                })
            })

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
