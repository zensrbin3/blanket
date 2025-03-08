<form method="GET" action="{{ route('login') }}">
    @csrf
    <x-dropdown-link :href="route('login')"
                     onclick="event.preventDefault();
                                                this.closest('form').submit();">
        {{ __('Login') }}
    </x-dropdown-link>
</form>
