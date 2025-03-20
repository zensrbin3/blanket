<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

@extends('layout.layout')
@section('content')
    <div class="container mt-5">
        <h1 class="mb-4 text-center">Filter Tests</h1>
        <form method="GET" action="{{route('test.filter')}}">
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="category_id" class="form-label">Filter by Category</label>
                    <select name="category_id" id="category_id" class="form-select">
                        <option value="">All Categories</option>
                        @foreach(\App\Models\Category::all() as $category)
                            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="user_id" class="form-label">Filter by User</label>
                    <select name="user_id" id="user_id" class="form-select">
                        <option value="">All Users</option>
                        @foreach(\App\Models\User::all() as $user)
                            <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="percentage" class="form-label">Minimum Percentage</label>
                    <input type="number" name="percentage" id="percentage" class="form-control" placeholder="e.g. 70" value="{{ request('percentage') }}">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col text-center">
                    <button type="submit" class="btn btn-primary me-2">Apply Filters</button>
                    <a href="" class="btn btn-secondary">Clear Filters</a>
                </div>
            </div>
        </form>
    </div>
@endsection
