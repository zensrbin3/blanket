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
        .auth-card-custom .link-custom {
            font-size: 0.9rem;
            color: #2575fc;
            text-decoration: none;
        }
        .auth-card-custom .link-custom:hover {
            text-decoration: underline;
        }
    </style>

    <div class="auth-card-custom">
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4 alert alert-danger" :errors="$errors" />

        <h1 class="text-center">Register</h1>

        <form method="POST" action="{{ route('register') }}" class="text-center">
            @csrf

            <!-- Name -->
            <div class="mb-3 text-start">
                <x-label for="name" :value="__('Name')" class="form-label" />
                <x-input id="name" class="form-control" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mb-3 text-start">
                <x-label for="email" :value="__('Email')" class="form-label" />
                <x-input id="email" class="form-control" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mb-3 text-start">
                <x-label for="password" :value="__('Password')" class="form-label" />
                <x-input id="password" class="form-control" type="password" name="password" required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mb-3 text-start">
                <x-label for="password_confirmation" :value="__('Confirm Password')" class="form-label" />
                <x-input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required />
            </div>

            <!-- Dugme i link -->
            <div class="d-flex justify-content-between align-items-center mt-4">
                <button type="submit" class="btn-custom">Register</button>
                <a class="link-custom" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>
            </div>
        </form>
    </div>
@endsection
