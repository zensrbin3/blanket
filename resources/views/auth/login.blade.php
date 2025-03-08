<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"><script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

@extends('layout.layout')
@section('content')
    <x-auth-card>
      <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
       <x-auth-validation-errors class="mb-4 text-center alert alert-danger " :errors="$errors" />
        <h1 class="pt-3 text-center mb-2 mt-2">Login</h1>
        <form method="POST" action="{{ route('login') }}" class="text-center d-flex flex-column align-items-center">
            @csrf

            <!-- Email Address -->
            <div class="col-10 col-sm-3 mt-3 text-start">
                <x-label for="email" :value="__('Email')" class="form-label" />
                <x-input id="email" class="block mt-0 w-full form-control" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <!-- Password -->
            <div class="col-10 col-sm-3 mt-2 text-start">
                <x-label for="password" :value="__('Password')" class="form-label" />
                <x-input id="password" class="block mt-0 w-full form-control" type="password" name="password" required autocomplete="current-password" />
            </div>

            <!-- Remember Me -->
            <div class="col-10 col-sm-3 mt-4 text-start">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="form-check-input text-indigo-600 focus:border-indigo-300 focus:ring focus:ring-indigo-200" name="remember" style="margin-left: 0.3rem;">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <!-- Buttons -->
            <div class="col-10 col-sm-3  row flex items-center justify-end mt-4 me-2">
                <div class="col-auto">
                    <x-input.button text="Login"/>
                </div>
                <div class="col-auto pt-1">
                    @if (Route::has('password.request'))
                        <a class="" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                </div>
            </div>
        </form>
    </x-auth-card>
@endsection
