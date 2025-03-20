<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script src="{{asset('js/disabledRadio.js')}}"></script>

@extends('layout.layout')
@section('content')
    <style>
        /* Glavni kontejner za formu */
        .assignment-container {
            background: linear-gradient(
                to bottom,
                #a0aec0 0%,
                #a0aec0 25%,
                #f8f9fa 75%,
                #f8f9fa 100%
            );
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        /* Hover efekat za red sa korisnikom */
        .user-row {
            transition: all 1s ease;
        }
        .user-row:hover {
            text-decoration: underline;
        }
        /* Stilizacija radio dugmića sa animacijom */
        .checkbox-custom input[type="checkbox"] {
            accent-color: #2575fc;
            transition: transform 0.3s ease;
        }
        .checkbox-custom input[type="checkbox"]:hover {
            transform: scale(1.2);
        }
        /* Fade in animacija za ceo kontejner */
        .assignment-container.fade-in {
            animation: fadeIn 2s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
    </style>

    <div class="container assignment-container fade-in mt-5">
        <h1 class="mb-4 text-center">Assign Test to Users</h1>
        @if(session()->has('success'))
            <div class="alert alert-success text-center">{{ session('success') }}</div>
        @endif
        @if(session()->has('error'))
            <div class="alert alert-danger text-center">{{ session('error') }}</div>
        @endif
        <form method="POST" action="{{route('admin.test.store')}}">
            @csrf
            @foreach($users as $user)
                @php
                    $assignedSheets = $user->tests->pluck('answer_sheet_id')->toArray();
                @endphp
                <div class="user-row mb-3 p-3 border rounded">
                    <h5>Name: {{ $user->name }}</h5>
                    <p>Email: {{ $user->email }}</p>
                    <div class="ms-3 checkbox-custom">
                        <label class="form-label fw-bold">Assign Test:</label>
                        <div class="d-flex flex-wrap">
                            @foreach($answerSheets as $sheet)
                                <div class="form-check me-3">
                                    <input class="form-check-input" type="checkbox"
                                           name="assignment[{{ $user->id }}][]"
                                           value="{{ $sheet->id }}|{{ $sheet->category_id }}"
                                           id="user{{ $user->id }}sheet{{ $sheet->id }}"
                                           @if(in_array($sheet->id, $assignedSheets)) disabled @endif>
                                    <label class="form-check-label" for="user{{ $user->id }}sheet{{ $sheet->id }}">
                                        {{ $sheet->description }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach


            <div class="text-center">
                <button type="submit" class="btn btn-primary mt-4">Assign Tests</button>
            </div>
        </form>
    </div>
@endsection

