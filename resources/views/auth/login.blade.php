<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"><script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

@extends('layout.layout')

@section('content')
    <style>
        .auth-card-custom {
            background-color: rgba(255, 255, 255, 0.8);
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            max-width: 400px;
            margin: 3rem auto;
        }
        .auth-card-custom h1 {
            font-family: 'Arial', sans-serif;
            font-weight: bold;
            margin-bottom: 1rem;
        }
        .auth-card-custom .form-control {
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .auth-card-custom .btn-custom {
            background-color: #2575fc;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 0.5rem 1.5rem;
            transition: background-color 0.3s ease;
        }
        .auth-card-custom .btn-custom:hover {
            background-color: #6a11cb;
        }
        .auth-card-custom .remember-me {
            font-size: 0.9rem;
            color: #333;
        }
        .auth-card-custom .forgot-link {
            font-size: 0.9rem;
            color: #2575fc;
            text-decoration: none;
        }
        .auth-card-custom .forgot-link:hover {
            text-decoration: underline;
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

    <div class="auth-card-custom">
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4 text-center alert alert-danger" :errors="$errors" />

        <h1 class="text-center">Login</h1>
        <form method="POST" action="{{ route('login') }}" class="text-center">
            @csrf

            <!-- Email Address -->
            <div class="mb-3 text-start">
                <x-label for="email" :value="__('Email')" class="form-label" />
                <x-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <!-- Password -->
            <div class="mb-3 text-start">
                <x-label for="password" :value="__('Password')" class="form-label" />
                <x-input id="password" class="form-control" type="password" name="password" required autocomplete="current-password" />
            </div>

            <!-- Remember Me -->
            <div class="mb-3 text-start">
                <div class="form-check">
                    <x-input id="remember_me" type="checkbox" class="form-check-input" name="remember" />
                    <label for="remember_me" class="form-check-label remember-me">
                        {{ __('Remember me') }}
                    </label>
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-4">
                    <a class="forgot-link" href="{{ route('register') }}">
                        Create a new account?
                    </a>
            </div>

            <!-- Dugme i link -->
            <div class="d-flex justify-content-between align-items-center mt-4">
                <button type="submit" class="btn-custom">Login</button>
                @if (Route::has('password.request'))
                    <a class="forgot-link" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>
        </form>
    </div>
@endsection

