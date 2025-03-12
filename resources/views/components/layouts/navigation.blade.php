<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('layouts.app') }}">{{ __(config('app.name')) }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse col-auto" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                @auth
                    @if(session('is_admin'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('answer_sheet.index') }}">{{ __("Answer Sheets") }}</a>
                        </li>
                        <li>
                            <a class="nav-link" href="{{route('admin.test.index')}}">Add test for user</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                               data-bs-toggle="dropdown" aria-expanded="false" style="border:1px solid black;">{{ __("Question") }}</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{ route('question.index') }}" style="border:1px solid black;">{{ __("Questions") }}</a></li>
                                <li><a class="dropdown-item" href="{{ route('question.create') }}" style="border:1px solid black;">{{ __("Add question") }}</a></li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('test.index') }}">{{ __("Tests") }}</a>
                        </li>
                    @endif
                @endauth
                @guest
                    <div class="col-auto mt-3">
                        <x-login></x-login>
                    </div>
                    <div class="col-auto mt-3">
                        <x-register></x-register>
                    </div>
                @endguest
            </ul>
        </div>
        <!-- Login/Register section -->
        <div class="col-auto ms-auto me-5 pt-2">
            <div class="row">
                @auth
                    <div class="col-auto">
                        <p class="nav-link fw-medium">{{ __("Profile:") }} {{ Auth::user()->name }}</p>
                    </div>
                    <div class="col-auto">
                        <x-logout></x-logout>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</nav>
