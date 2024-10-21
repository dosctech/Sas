<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4 relative">
            <x-input-label for="password" :value="__('Password')" />
            <div class="relative">
                <x-text-input id="password" class="block mt-1 w-full pr-10" type="password" name="password" required autocomplete="new-password" />
                <span id="togglePassword" class="absolute inset-y-0 right-3 flex items-center text-blue-600 cursor-pointer" onclick="togglePasswordVisibility('password', 'togglePassword')">Show</span>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4 relative">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <div class="relative">
                <x-text-input id="password_confirmation" class="block mt-1 w-full pr-10" type="password" name="password_confirmation" required autocomplete="new-password" />
                <span id="togglePasswordConfirm" class="absolute inset-y-0 right-3 flex items-center text-blue-600 cursor-pointer" onclick="togglePasswordVisibility('password_confirmation', 'togglePasswordConfirm')">Show</span>
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4 custom-register-button">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>

    <script>
        function togglePasswordVisibility(inputId, toggleId) {
            const input = document.getElementById(inputId);
            const toggleText = document.getElementById(toggleId);
            const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
            input.setAttribute('type', type);
            toggleText.textContent = type === 'password' ? 'Show' : 'Hide';
        }
    </script>

    <style>
        .custom-register-button {
            background-color: #347928; /* Set custom green color */
            color: white; /* Set text color to white */
            border: none; /* Remove default border */
            padding: 0.5rem 1rem; /* Add padding */
            border-radius: 0.375rem; /* Add rounded corners */
            transition: background-color 0.3s ease; /* Smooth transition for background color */
        }

        .custom-register-button:hover {
            background-color: #2c621f; /* Darker green on hover */
        }

        .relative {
            position: relative;
        }

        .absolute {
            position: absolute;
        }

        #togglePassword, #togglePasswordConfirm {
            right: 0.75rem;
            top: 0.75rem;
        }
    </style>
</x-guest-layout>
