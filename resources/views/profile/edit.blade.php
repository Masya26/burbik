<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl" style="color: white">
            {{ __('Профиль') }}
        </h2>
        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <x-dropdown-link :href="route('logout')"
                onclick="event.preventDefault();
                                this.closest('form').submit();">
                {{ __('Log Out') }}
            </x-dropdown-link>
        </form>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 rounded-lg" style="background-color: rgb(80, 200, 255);">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 rounded-lg" style="background-color: rgb(80, 200, 255);">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <x-danger-button x-data=""
                x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">{{ __('Удалить аккаунт') }}</x-danger-button>
        </div>
    </div>
</x-app-layout>
