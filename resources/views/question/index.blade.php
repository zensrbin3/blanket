<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

@extends('layout.layout')
@section('content')
    <style>
        .backGround {
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
@if(Session::has('flash_msg'))
    <div id="flashMsg" class="alert alert-success text-center" data-tip="{{ Session::get('flash_type') }}" >{{ Session::get('flash_msg') }}</div>
@endif

<div class="container">
    <div class="d-flex justify-content-between align-items-center pb-1">
        <h1>{{ __("Questions") }}</h1>
        <button class="btn btn-outline-dark" onclick="location.href='{{ route('question.create')}}'" type="button"><i class="bi bi-plus-lg"></i> {{__("Add Question")}} </button>
    </div>
<div class="row pb-5">
    <table class="table">
        <tr class="table-secondary">
            <td >
                #
            </td>
            <td >
                {{ __("Question text") }}
            </td>
            <td>
                &nbsp;
            </td>
        </tr>
        @foreach($questions as $question)
            <tr class="table-light">
                <td class="align-middle">
                    {{$loop->iteration}}
                </td>
                <td class="align-middle">
                    {!! \Illuminate\Support\Str::limit($question->question_description, 30, '...') !!}
                </td>
                <td class="text-end align-middle">
                    <button class="btn btn-outline-dark" onclick="location.href='{{ route('question.show',$question) }}'" type="button"><i class="bi bi-eye-fill"></i> </button>
                    <button class="btn btn-outline-dark" onclick="location.href='{{ route('question.edit',$question) }}'" type="button"><i class="bi bi-pencil-fill"></i> </button>
                    <button class="btn btn-outline-dark" onclick="location.href='{{ route('question.destroy',$question) }}'" type="button"><i class="bi bi-trash3-fill"></i></button>
                </td>
            </tr>
        @endforeach
    </table>
</div>
</div>
@endsection
