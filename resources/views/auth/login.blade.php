<x-guest-layout>

    <x-breeze.auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <x-breeze.input-label for="email" :value="__('Email')" />
            <x-breeze.text-input id="email" type="email" name="email" :value="old('email')"
                                 required autofocus autocomplete="username" />
            <x-breeze.input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-breeze.input-label for="password" :value="__('Password')" />
            <x-breeze.text-input id="password" type="password" name="password"
                                 required autocomplete="current-password" />
            <x-breeze.input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" name="remember" class="rounded">
                <span class="ms-2 text-sm">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-between mt-6">
            @if (Route::has('password.request'))
                <a class="link underline text-sm" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @else
                <span></span>
            @endif

            <x-breeze.primary-button>{{ __('Log in') }}</x-breeze.primary-button>
        </div>
    </form>

    <p class="text-sm mt-6" style="color:#4A6B48">
        No account yet?
        <a href="{{ route('register') }}" class="link underline">Create one</a>
    </p>

</x-guest-layout>