<x-guest-layout>

    <form method="POST" action="{{ route('verify.otp') }}">
        @csrf

        <div>
            <x-input-label for="token" value="Enter OTP" />
            <x-text-input
                id="token"
                class="block mt-1 w-full"
                type="text"
                name="token"
                required
                autofocus
            />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                Verify OTP
            </x-primary-button>
        </div>
    </form>

    {{-- Resend OTP --}}
    <div class="mt-4 text-center">
        <button
            type="button"
            id="resendBtn"
            class="text-sm text-blue-600 underline"
        >
            Resend OTP
        </button>
    </div>

    <p id="msg" class="text-green-600 text-center mt-2"></p>

<script>
document.getElementById('resendBtn').addEventListener('click', function () {
    fetch("{{ route('resend.otp') }}", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}",
            "Accept": "application/json"
        }
    })
    .then(res => res.json())
    .then(data => {
        document.getElementById('msg').innerText = data.message;
    })
    .catch(err => {
        console.error(err);
        alert('Failed to resend OTP');
    });
});
</script>

</x-guest-layout>
