<form method="GET" action="{{ route('register') }}">
    @csrf
    <x-dropdown-link :href="route('register')"
                     onclick="event.preventDefault();
                                                this.closest('form').submit();">
        {{ __('Register') }}
    </x-dropdown-link>
</form>
