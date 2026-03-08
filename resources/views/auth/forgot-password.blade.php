<x-guest-layout>
    <x-slot name="title">Lupa Password — AutoPart Original</x-slot>

    {{-- Back Button --}}
    <a href="{{ route('login') }}" class="btn-back">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M19 12H5M5 12l7 7M5 12l7-7"/>
        </svg>
        Kembali ke Login
    </a>

    {{-- Header --}}
    <h1 class="auth-form-title">Lupa Password</h1>
    <p class="auth-form-subtitle">
        Masukkan email kamu dan kami akan mengirimkan link reset password.
    </p>

    {{-- Session Status --}}
    @if (session('status'))
        <div class="auth-status">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        {{-- Email --}}
        <div class="form-field">
            <label for="email" class="form-label">Email</label>
            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                class="form-input"
                placeholder="email@contoh.com"
                required
                autofocus
            >
            @error('email')
                <p class="form-error">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="btn-submit btn-submit-full">
            Kirim Link Reset Password
        </button>

        <div class="auth-divider">atau</div>

        <p style="text-align:center; font-size:13px; color:#888;">
            Ingat password kamu?
            <a href="{{ route('login') }}" style="color:#E02020; font-weight:600; text-decoration:none;">Masuk di sini →</a>
        </p>
    </form>
</x-guest-layout>
