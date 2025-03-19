<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
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
    </style>

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
                        <td class="align-middle">{{ $loop->iteration }}</td>
                        <td class="align-middle sheet-description" data-sheet-id="{{ $sheet->id }}">
                            {{ $sheet->description }}
                        </td>
                        <td class="align-middle">{{ $sheet->group_number }}</td>
                        <td class="align-middle">{{ $sheet->created_at }}</td>
                        <td class="text-end action-cell">
                            <div class="d-inline action-buttons">
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
                                <button class="btn btn-outline-dark d-inline edit-btn" data-sheet-id="{{ $sheet->id }}" type="button">
                                    <i class="bi bi-pencil-fill"></i> {{ __("Edit") }}
                                </button>
                                <button class="btn btn-outline-dark d-inline" onclick="location.href='{{ route('answer_sheet.destroy', $sheet) }}'" type="button">
                                    <i class="bi bi-trash3-fill"></i> {{ __("Delete") }}
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach

            </table>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.edit-btn').forEach(function(editBtn) {
                editBtn.addEventListener('click', function() {
                    var sheetId = this.getAttribute('data-sheet-id');
                    var row = this.closest('tr');
                    var descCell = row.querySelector('.sheet-description');
                    var currentDesc = descCell.innerText.trim();
                    descCell.innerHTML = '<input type="text" class="form-control edit-input" value="'+currentDesc+'">';
                    var actionDiv = row.querySelector('.action-buttons');
                    actionDiv.classList.add('d-none');
                    var actionCell = row.querySelector('.action-cell');
                    var saveBtn = document.createElement('button');
                    saveBtn.type = 'button';
                    saveBtn.className = 'btn btn-success save-btn';
                    saveBtn.innerHTML = '<i class="bi bi-check-lg"></i> Save';
                    actionCell.appendChild(saveBtn);
                    saveBtn.addEventListener('click', function() {
                        var newDesc = row.querySelector('.edit-input').value;
                        // AJAX zahtev za update
                        fetch("{{ route('answer_sheet.update') }}", {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                id: sheetId,
                                description: newDesc
                            })
                        })
                            .then(response => response.json())
                            .then(data => {
                                if(data.success) {
                                    descCell.innerText = newDesc;
                                    saveBtn.remove();
                                    actionDiv.classList.remove('d-none');
                                } else {
                                    alert('Update failed: ' + data.message);
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                alert('An error occurred.');
                            });
                    });
                });
            });
        });
    </script>


@endsection
