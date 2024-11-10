<x-guest-layout>
    <div class="min-h-screen flex flex-col justify-center items-center bg-blue-100">
        <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-sm">
            <div class="flex justify-center mb-6">
                <div class="bg-blue-200 p-4 rounded-full">
                    <svg class="w-12 h-12 text-blue-500" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 12c2.761 0 5-2.239 5-5s-2.239-5-5-5-5 2.239-5 5 2.239 5 5 5zm0 2c-3.86 0-7 3.14-7 7h14c0-3.86-3.14-7-7-7z" />
                    </svg>
                </div>
            </div>

            <x-validation-errors class="mb-4" />

            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-4 relative">
                    <x-label for="email" class="sr-only" value="{{ __('Email') }}" />
                    <x-input id="email" class="block mt-2 w-full border border-blue-300 rounded-full p-3 pl-10 focus:border-blue-500" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Username" />
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg class="w-5 h-5 text-blue-400" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M20 4h-4V2h-4v2H8V2H4v2H2v2h20V4zm-1 4H5v14h14V8zM10 10h2v2h-2zm4 0h2v2h-2z" />
                        </svg>
                    </div>
                </div>

                <div class="mb-4 relative">
                    <x-label for="password" class="sr-only" value="{{ __('Password') }}" />
                    <x-input id="password" class="block mt-2 w-full border border-blue-300 rounded-full p-3 pl-10 focus:border-blue-500" type="password" name="password" required autocomplete="current-password" placeholder="Password" />
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg class="w-5 h-5 text-blue-400" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17 8V7a5 5 0 10-10 0v1a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V10a2 2 0 00-2-2zm-7-1a3 3 0 116 0v1h-6V7z" />
                        </svg>
                    </div>
                </div>

                <div class="flex items-center justify-between mb-6">
                    <label for="remember_me" class="flex items-center">
                        <x-checkbox id="remember_me" name="remember" />
                        <span class="ms-2 text-sm text-gray-700">{{ __('Remember me') }}</span>
                    </label>
                    
                    @if (Route::has('password.request'))
                        <a class="text-sm text-blue-600 hover:text-blue-800" href="{{ route('password.request') }}">
                            {{ __('Forgot password?') }}
                        </a>
                    @endif
                </div>

                <div class="flex justify-center">
                    <x-button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-full w-full">
                        {{ __('Login') }}
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
