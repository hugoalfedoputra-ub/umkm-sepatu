<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="bg-beige mt-4">
            <div>
                <x-input-label for="email" :value="__('Email')" class="text-beige" />
                <x-text-input id="email" class="block mt-1 w-full bg-beige text-black placeholder-gray-700" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-beige" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" class="text-beige" />
                <x-text-input id="password" class="block mt-1 w-full bg-beige text-black placeholder-gray-700" type="password" name="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-beige" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center text-beige">
                    <input id="remember_me" type="checkbox" class="rounded border-beige text-beige shadow-sm focus:ring-beige" name="remember">
                    <span class="ml-2 text-sm">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-beige hover:text-beige rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-beige" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-primary-button class="ml-3 bg-beige text-black">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>
        </div>
    </form>
</x-guest-layout>
