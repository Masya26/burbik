<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" style="color: white;" :value="__('Email')" />
                <x-text-input id="email" style="background-color: white; border-color: white;" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" style="color: white;" :value="__('Пароль')" />

                <x-text-input id="password" style="background-color: white; border-color: white;" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" style="border-color: white" class="rounded" name="remember">
                    <span class="ms-2 text-sm text-white">{{ __('Запомнить меня') }}</span>
                </label>
            </div>

            <div class="mt-4" style="display: flex; flex-direction: row; justify-content: center;">
                <x-primary-button class="ms-3" style="background-color: white; color: rgb(11, 178, 255);">
                    {{ __('Войти') }}
                </x-primary-button>
            </div>
        </form>
        <div class="mt-2 pt-2 border-t" style="display: flex; flex-direction: row; justify-content: center;">
            <a href="/register">
                <x-primary-button class="ms-3" style="background-color: white; color: rgb(11, 178, 255); ">
                    {{ __('Зарегистрироваться') }}
                </x-primary-button>
            </a>
        </div>
</x-guest-layout>
