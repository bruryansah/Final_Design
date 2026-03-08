<x-guest-layout>
    <x-slot name="title">Login — AutoPart Original</x-slot>

    {{-- Back Button --}}
    <a href="/" class="btn-back">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M19 12H5M5 12l7 7M5 12l7-7"/>
        </svg>
        Kembali ke Beranda
    </a>

    {{-- Header --}}
    <h1 class="auth-form-title">Masuk</h1>
    <p class="auth-form-subtitle">
        Belum punya akun?
        <a href="{{ route('register') }}">Daftar sekarang →</a>
    </p>

    {{-- Session Status --}}
    @if (session('status'))
        <div class="auth-status">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}">
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
                autocomplete="username"
            >
            @error('email')
                <p class="form-error">{{ $message }}</p>
            @enderror
        </div>

        {{-- Password --}}
        <div class="form-field">
            <label for="password" class="form-label">Password</label>
            <input
                id="password"
                type="password"
                name="password"
                class="form-input"
                placeholder="••••••••"
                required
                autocomplete="current-password"
            >
            @error('password')
                <p class="form-error">{{ $message }}</p>
            @enderror
        </div>

        {{-- Remember Me --}}
        <div class="remember-wrap">
            <input id="remember_me" type="checkbox" name="remember">
            <label for="remember_me">Ingat saya</label>
        </div>

        {{-- Actions --}}
        <div class="form-actions">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="link-secondary">
                    Lupa password?
                </a>
            @endif
            <button type="submit" class="btn-submit">
                Masuk
            </button>
        </div>
    </form>
</x-guest-layout>
