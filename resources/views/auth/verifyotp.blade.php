<x-guest-layout>
    <form method="POST" action="{{ route('verify.otp') }}">
        @csrf
        <div>
            <x-input-label for="token" :value="__('Enter OTP')" />
            <x-text-input id="token" class="block mt-1 w-full" type="text" name="token" required autofocus />
            <x-input-error :messages="$errors->get('token')" class="mt-2" />
        </div>
        <div class="flex items-center justify-end mt-4">
            <x-primary-button>{{ __('Verify OTP') }}</x-primary-button>
        </div>
    </form>
</x-guest-layout>
