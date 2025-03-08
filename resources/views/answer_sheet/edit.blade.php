
@extends('layout.layout')
@section('content')
    <div class="container">
        <div class="row pt-3 pb-5 text-center mx-auto">
            <h1>{{__("Edit Answer Sheet")}}</h1>
        </div>

        <form method="POST" action="{{ route("answer_sheet.update",$answer_sheet) }}">
            @csrf

            <div class="mb-3 col-11  col-sm-4 mx-auto">
                <div>
                    <label class="form-label " for="description" >{{ __("Answer Sheet description:") }}</label>
                    <x-input.textarea name="description"  value="{{$answer_sheet->description}}" placeholder="Enter description" />
                </div>
            </div>

            <div class="mb-3 pt-3 col-11  col-sm-4 mx-auto">
                <x-input.button text="Save"/>
            </div>


        </form>
    </div>
@endsection

