<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            <!-- Profile Information Update Section -->
            <div class="bg-white p-6 shadow-xl rounded-lg">
                <div class="max-w-xl mx-auto">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Update Profile Information') }}</h3>
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Password Update Section -->
            <div class="bg-white p-6 shadow-xl rounded-lg">
                <div class="max-w-xl mx-auto">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Change Password') }}</h3>
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Delete User Section -->
            <div class="bg-white p-6 shadow-xl rounded-lg">
                <div class="max-w-xl mx-auto">
                    <h3 class="text-lg font-medium text-red-600 mb-4">{{ __('Delete Account') }}</h3>
                    <p class="text-sm text-gray-500 mb-4">
                        {{ __('Once you delete your account, all of its resources and data will be permanently deleted. Please proceed with caution.') }}
                    </p>
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
            
        </div>
    </div>
</x-app-layout>
