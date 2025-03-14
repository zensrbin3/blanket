<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script src="{{asset('js/app.js')}}"></script>
<script src="{{asset('js/questionCreate.js')}}"></script>




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
    }
</style>
<div class="container">
<div class="row pt-3">
    <h1>{{__("Create Question")}}</h1>
</div>
<form method="POST" action="{{ route("question.store") }}">
    @csrf
    <div class="mb-3">
        <div>
            <label class="form-label " for="question_text" >{{ __("Question text:") }}</label>
            <div id="editor0" class="quill-editor" style="height: 200px;"></div>
            <input type="hidden" name="question_text">
            @error('question_text')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="mb-3">
        <label class="form-label"> {{ __("Answers:") }} </label><br>
        @for ($i = 1; $i < 5; $i++)
            <div class="row mb-5 g-3">
                <div class="col-auto"><label class="form-label">{{$i+1}}) </label> </div>
                <div class="col-6">
                    <div id="editor{{$i}}" class="quill-editor"></div>
                    <input type="hidden" name="answers[{{$i}}]">
                </div>
                <div class="col-auto"><input class="form-check-input  {{ $errors->has("correct_answer") ? "is-invalid" : " " }}" type="radio"  name="correct_answer" value="{{$i}}" {{ old("correct_answer") == "$i" ? 'checked' : '' }}></div>
            </div>
        @endfor
        @error('correct_answer')
            <div class="alert alert-danger">{{$message}}</div>
        @enderror
    </div>


    <div class="mb-5 pt-4 pb-5 ">
       <x-input.button text="Save"/>
    </div>


</form>

</div>
    @endsection

