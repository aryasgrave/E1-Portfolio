<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <section class="login">
        <div class="login__container">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="input">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus
                        autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="input">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" type="password" name="password" required
                        autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="checkbox">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" name="remember">
                        <span>{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class="submit">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif

                    <button class="btn-solid--gradient">
                        {{ __('Log in') }}
                    </button>
                </div>
            </form>
        </div>
    </section>
</x-guest-layout>
