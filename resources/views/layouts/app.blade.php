@extends('layout.layout')

@section('content')
    <style>
        .quiz-bg {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('{{ asset("img/pozadina.jfif") }}') no-repeat center center;
            background-size: cover;
            filter: blur(8px);
            z-index: 1;
        }
        .quiz-content {
            position: relative;
            z-index: 2;
            padding: 20px;
        }
        .quiz-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0,0,0,0.4);
            z-index: 1;
        }
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

    <div class="container mb-5 mt-5">
        <div class="position-relative"style="height: 650px;">
            <div class="quiz-bg"></div>
            <div class="quiz-overlay"></div>
            <div class="quiz-content text-white d-flex flex-column justify-content-center align-items-center h-100">
                <h1 class="display-4 fw-bold">Dobrodošli u aplikaciju za kvizove</h1>
                <p class="lead">
                    Naša platforma vam pruža priliku da testirate svoje znanje kroz interaktivne i izazovne kvizove.
                    Bilo da ste ljubitelj opšte kulture, strastveni poznavalac nauke, istorije, sporta ili zabavne tematike,
                    ovde ćete pronaći raznovrsne kvizove koji će vas zabaviti i proširiti vaše znanje.
                    Uživajte u učenju na zabavan način, otkrivajte nove činjenice i proverite koliko zaista znate o različitim temama.
                    Kroz svaki kviz možete pratiti svoj napredak, takmičiti se sa prijateljima ili jednostavno uživati u izazovu.
                    Naša platforma je dizajnirana tako da pruži dinamično i edukativno iskustvo koje podstiče radoznalost i želju za znanjem.
                    Pripremite se za uzbudljive testove, dokažite svoje veštine i postanite pravi kviz majstor!
                </p>
            </div>
        </div>
    </div>
@endsection
