@extends('layout.layout')
@section('content')
<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4 alert alert-danger" :errors="$errors" />

        <h1 class="pt-3 text-center mb-2 mt-2">Register</h1>

        <form method="POST" action="{{ route('register') }}" class="text-center d-flex flex-column align-items-center">
            @csrf

            <!-- Name -->
            <div class="col-10 col-sm-3  mt-3 text-start">
                <x-label for="name" :value="__('Name')" class="form-label" />
                <x-input id="name" class="block mt-0 w-full form-control" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="col-10 col-sm-3  mt-3 text-start">
                <x-label for="email" :value="__('Email')" class="form-label" />
                <x-input id="email" class="block mt-0 w-full form-control" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="col-10 col-sm-3 mt-3 text-start">
                <x-label for="password" :value="__('Password')" class="form-label" />
                <x-input id="password" class="block mt-0 w-full form-control" type="password" name="password" required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="col-10 col-sm-3  mt-3 text-start">
                <x-label for="password_confirmation" :value="__('Confirm Password')" class="form-label" />
                <x-input id="password_confirmation" class="block mt-0 w-full form-control" type="password" name="password_confirmation" required />
            </div>

            <!-- Register Button & Login Link -->
            <div class="col-10 col-sm-3  row flex items-center justify-end mt-4 me-2">
                <div class="col-auto">
                    <x-input.button text="Register"/>
                </div>
                <div class="col-auto mt-1">
                    <a class="text-sm text-gray-600 hover:text-gray-900 " href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>
                </div>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
@endsection
