<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
@extends('layout.layout')
@section('content')

    @if(Session::has('flash_msg'))
        <div id="flashMsg" class="alert alert-success text-center" data-tip="{{ Session::get('flash_type') }}" >{{ Session::get('flash_msg') }}</div>
    @endif

    <div class="container">

        <div class="d-flex justify-content-between align-items-center pb-3">
            <h1>{{ __("Answer Sheets") }}</h1>
        </div>
        <form method="get" action="{{ route('answer_sheet.index') }}">
            <div class="row align-items-center">
                <label class="form-label" for="date">{{ __("Enter a date of creation:") }}</label>
                <div class="col-auto">
                   <x-input.date name="date"/>
                </div>
                <div class="col-auto">
                    <x-input.button text="Search" />
                </div>
                <div class="col-auto">
                    <button class="btn btn-outline-dark" onclick="location.href='{{ route('answer_sheet.index')}}'" type="button">
                        {{__("Clear filters")}}
                    </button>
                </div>
                <div class="col-auto ms-auto">
                    <button class="btn btn-outline-dark" onclick="location.href='{{ route('answer_sheet.create')}}'" type="button">
                        <i class="bi bi-plus-lg"></i> {{__("Add Answer Sheets")}}
                    </button>
                </div>
            </div>

        </form>

        <div class="row pb-5">
            <table class="table">
                <tr class="table-primary">
                    <td>#</td>
                    <td class="col-auto">{{ __("Answer Sheet description") }}</td>
                    <td class="col-auto">{{ __("Group") }}</td>
                    <td class="col-auto me-3">{{ __("Creation date") }}</td>
                    <td class="col-auto text-end"></td>
                </tr>
                @foreach($answer_sheets as $sheet)
                    <tr class="table-light">
                        <td class="align-middle">{{$loop->iteration}}</td>
                        <td class="align-middle">{{ \Illuminate\Support\Str::limit($sheet->description,30,'...')}}</td>
                        <td class="align-middle">{{$sheet->group_number}}</td>
                        <td class="align-middle">{{$sheet->created_at}}</td>
                        <td class="text-end">
                            <div class="d-inline"> <!-- Možeš koristiti d-inline ili d-flex ovde -->
                                <div class="dropdown col-auto d-inline">
                                    <button class="btn btn-outline-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-eye-fill"></i> {{ __("Print") }}
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <li>
                                            <a class="dropdown-item" href="{{ route('answer_sheet.show', ['answer_sheet' => $sheet, 'full' => 1]) }}">
                                                {{ __("With answers") }}
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('answer_sheet.show', ['answer_sheet' => $sheet, 'full' => 0]) }}">
                                                {{ __("Blank") }}
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <button class="btn btn-outline-dark d-inline" onclick="location.href='{{ route('answer_sheet.edit',$sheet) }}'" type="button">
                                    <i class="bi bi-pencil-fill"></i> {{ __("Edit") }}
                                </button>
                                <button class="btn btn-outline-dark d-inline" onclick="location.href='{{ route('answer_sheet.destroy',$sheet) }}'" type="button">
                                    <i class="bi bi-trash3-fill"></i> {{ __("Delete") }}
                                </button>
                            </div>
                        </td>
                </tr>
                @endforeach

            </table>
        </div>
    </div>


@endsection
