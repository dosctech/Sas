<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <div class="relative">
                <x-text-input id="password" class="block mt-1 w-full pr-20"
                              type="password"
                              name="password"
                              required autocomplete="current-password" />

                <!-- Show/Hide password toggle -->
                <button type="button" id="togglePassword" onclick="togglePasswordVisibility()" class="absolute right-2 top-2 text-gray-600 hover:text-gray-900">
                    <span id="toggleText">Show</span>
                </button>
            </div>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <!-- Modify the button with custom hover styles -->
            <x-primary-button class="ml-3 custom-login-button">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>

    <!-- Toggle password visibility script -->
    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const toggleText = document.getElementById('toggleText');
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';

            passwordInput.setAttribute('type', type);
            
            // Toggle the text between "Show" and "Hide"
            toggleText.textContent = type === 'password' ? 'Show' : 'Hide';
        }
    </script>

    <style>
        .custom-login-button {
            background-color: #347928; /* Set custom green color */
            color: white; /* Set text color to white */
            border: none; /* Remove default border */
            padding: 0.5rem 1rem; /* Add padding */
            border-radius: 0.375rem; /* Add rounded corners */
            transition: background-color 0.3s ease; /* Smooth transition for background color */
        }

        .custom-login-button:hover {
            background-color: #2c621f; /* Darker green on hover */
        }
    </style>
</x-guest-layout>
