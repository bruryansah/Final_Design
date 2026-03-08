<x-guest-layout>
    <x-slot name="title">Register — AutoPart Original</x-slot>

    {{-- Back Button --}}
    <a href="/" class="btn-back">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M19 12H5M5 12l7 7M5 12l7-7"/>
        </svg>
        Kembali ke Beranda
    </a>

    {{-- Header --}}
    <h1 class="auth-form-title">Daftar</h1>
    <p class="auth-form-subtitle">
        Sudah punya akun?
        <a href="{{ route('login') }}">Masuk di sini →</a>
    </p>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        {{-- Name --}}
        <div class="form-field">
            <label for="name" class="form-label">Nama Lengkap</label>
            <input
                id="name"
                type="text"
                name="name"
                value="{{ old('name') }}"
                class="form-input"
                placeholder="Nama kamu"
                required
                autofocus
                autocomplete="name"
            >
            @error('name')
                <p class="form-error">{{ $message }}</p>
            @enderror
        </div>

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
                placeholder="Minimal 8 karakter"
                required
                autocomplete="new-password"
            >
            @error('password')
                <p class="form-error">{{ $message }}</p>
            @enderror
        </div>

        {{-- Confirm Password --}}
        <div class="form-field">
            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
            <input
                id="password_confirmation"
                type="password"
                name="password_confirmation"
                class="form-input"
                placeholder="Ulangi password"
                required
                autocomplete="new-password"
            >
            @error('password_confirmation')
                <p class="form-error">{{ $message }}</p>
            @enderror
        </div>

        {{-- Actions --}}
        <div class="form-actions">
            <span></span>
            <button type="submit" class="btn-submit">
                Daftar Sekarang
            </button>
        </div>
    </form>
</x-guest-layout>
