<x-guest-layout>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div>
            <x-breeze.input-label for="name" :value="__('Name')" />
            <x-breeze.text-input id="name" type="text" name="name" :value="old('name')"
                                 required autofocus autocomplete="name" />
            <x-breeze.input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-breeze.input-label for="email" :value="__('Email')" />
            <x-breeze.text-input id="email" type="email" name="email" :value="old('email')"
                                 required autocomplete="username" />
            <x-breeze.input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-breeze.input-label for="password" :value="__('Password')" />
            <x-breeze.text-input id="password" type="password" name="password"
                                 required autocomplete="new-password" />
            <x-breeze.input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-breeze.input-label for="password_confirmation" :value="__('Confirm password')" />
            <x-breeze.text-input id="password_confirmation" type="password" name="password_confirmation"
                                 required autocomplete="new-password" />
            <x-breeze.input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-6">
            <x-breeze.primary-button>{{ __('Register') }}</x-breeze.primary-button>
        </div>
    </form>

    <p class="text-sm mt-6" style="color:#4A6B48">
        Already registered?
        <a href="{{ route('login') }}" class="link underline">Log in</a>
    </p>

</x-guest-layout>