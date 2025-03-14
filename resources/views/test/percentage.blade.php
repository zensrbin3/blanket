<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>


@extends('layout.layout')
@section('content')
    <style>
        /* Celokupna pozadina između navbara i footera */
        .full-background {
            background: linear-gradient(to bottom, #a0aec0, #f8f9fa);
            /* Ako znaš visine navbara i footera, možeš koristiti calc() */
            min-height: calc(100vh - 120px);
            display: flex;
            justify-content: center;
            align-items: center;
        }
        /* Rezultujući okvir (result box) */
        .result-box {
            background: linear-gradient(to bottom, #ffffff, #e2e8f0);
            border: 2px solid #cbd5e0;
            border-radius: 8px;
            padding: 2rem;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            width: 90%;
            max-width: 500px;
            text-align: center;
        }
        /* Dugmad sa gradijent pozadinom */
        .btn-gradient {
            background: linear-gradient(45deg, #6a11cb, #2575fc);
            border: none;
            color: #fff;
            transition: background 0.3s ease;
        }
        .btn-gradient:hover {
            background: linear-gradient(45deg, #2575fc, #6a11cb);
        }
    </style>
    <div class="full-background">
        <div class="result-box">
            <h1 class="mb-3">Na testu: {{ $name }}</h1>
            <h2 class="mb-4">Osvojili ste: {{ $percentage }}%</h2>
            <div class="d-grid gap-3">
                <a href="{{route('test.currentResult',$test)}}" class="btn btn-gradient">
                    View correct answers
                </a>
                <a href="{{route('test.index')}}" class="btn btn-gradient">
                    Back to test/s
                </a>
            </div>
        </div>
    </div>
@endsection

