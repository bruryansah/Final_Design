<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 — Halaman Tidak Ditemukan | NXLS MECHANICAL</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@400;600;700;800;900&family=Barlow:wght@300;400;500;600&display=swap"
        rel="stylesheet">
    <style>
        /* ── Variables ── */
        :root {
            --red: #E02020;
            --red-dark: #B01010;
            --black: #0D0D0D;
            --dark: #151515;
            --dark2: #1E1E1E;
            --dark3: #2A2A2A;
            --mid: #444444;
            --light: #F5F5F5;
            --white: #FFFFFF;
            --font-head: 'Barlow Condensed', sans-serif;
            --font-body: 'Barlow', sans-serif;
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: var(--font-body);
            background: var(--black);
            color: var(--white);
            min-height: 100vh;
            overflow-x: hidden;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        /* ══════════════════════════════════════
           LOADING SCREEN
        ══════════════════════════════════════ */
        #loader {
            position: fixed;
            inset: 0;
            z-index: 9999;
            background: var(--black);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 28px;
            transition: opacity 0.5s ease, visibility 0.5s ease;
        }

        #loader.hidden {
            opacity: 0;
            visibility: hidden;
        }

        .loader-logo {
            font-family: var(--font-head);
            font-size: 28px;
            font-weight: 900;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: var(--white);
            display: flex;
            align-items: center;
            gap: 10px;
            animation: logoPulse 1.2s ease infinite alternate;
        }

        .loader-logo span {
            color: var(--red);
        }

        @keyframes logoPulse {
            from {
                opacity: 0.6;
            }

            to {
                opacity: 1;
            }
        }

        /* Track bar */
        .loader-track {
            width: 220px;
            height: 3px;
            background: var(--dark3);
            border-radius: 2px;
            overflow: hidden;
            position: relative;
        }

        .loader-bar {
            position: absolute;
            top: 0;
            left: -40%;
            width: 40%;
            height: 100%;
            background: linear-gradient(90deg, transparent, var(--red), transparent);
            border-radius: 2px;
            animation: barSlide 1s ease infinite;
        }

        @keyframes barSlide {
            0% {
                left: -40%;
            }

            100% {
                left: 100%;
            }
        }

        .loader-text {
            font-family: var(--font-head);
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 0.3em;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.35);
        }

        /* Gear spinner */
        .loader-gear {
            font-size: 40px;
            animation: spin 2s linear infinite;
            filter: grayscale(0.2);
        }

        @keyframes spin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        /* ══════════════════════════════════════
           NOISE OVERLAY
        ══════════════════════════════════════ */
        .noise {
            position: fixed;
            inset: 0;
            pointer-events: none;
            z-index: 0;
            opacity: 0.03;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E");
            background-size: 200px;
        }

        /* ══════════════════════════════════════
           GRID LINES BG
        ══════════════════════════════════════ */
        .grid-bg {
            position: fixed;
            inset: 0;
            z-index: 0;
            pointer-events: none;
            background-image:
                linear-gradient(rgba(255, 255, 255, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, 0.03) 1px, transparent 1px);
            background-size: 60px 60px;
        }

        /* Red accent line top */
        .accent-line-top {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: var(--red);
            z-index: 10;
        }

        /* ══════════════════════════════════════
           MAIN CONTENT
        ══════════════════════════════════════ */
        .page-wrap {
            position: relative;
            z-index: 1;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 60px 24px;
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.7s ease 0.1s, transform 0.7s ease 0.1s;
        }

        .page-wrap.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Logo */
        .nav-logo {
            display: flex;
            align-items: center;
            flex-shrink: 0;
        }

        .logo-img {
            height: 44px;
            width: auto;
            object-fit: contain;
            /* Placeholder style if image is empty */
            min-width: 120px;
        }


        /* ── Nav Mini ── */
        .mini-nav {
            position: fixed;
            top: 3px;
            left: 0;
            right: 0;
            height: 60px;
            background: rgba(13, 13, 13, 0.95);
            border-bottom: 1px solid rgba(255, 255, 255, 0.06);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 32px;
            z-index: 5;
            backdrop-filter: blur(8px);
        }

        .mini-brand {
            font-family: var(--font-head);
            font-size: 20px;
            font-weight: 900;
            letter-spacing: 0.12em;
            text-transform: uppercase;
        }

        .mini-brand em {
            color: var(--red);
            font-style: normal;
        }

        .mini-back {
            font-family: var(--font-head);
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.5);
            border: 1.5px solid rgba(255, 255, 255, 0.15);
            padding: 6px 18px;
            border-radius: 4px;
            transition: color 0.2s, border-color 0.2s;
        }

        .mini-back:hover {
            color: var(--white);
            border-color: rgba(255, 255, 255, 0.5);
        }

        /* ── Error Card ── */
        .error-card {
            text-align: center;
            max-width: 640px;
            width: 100%;
            margin-top: 60px;
        }

        /* Giant 404 number */
        .error-code {
            font-family: var(--font-head);
            font-size: clamp(120px, 22vw, 240px);
            font-weight: 900;
            line-height: 0.85;
            letter-spacing: -0.04em;
            text-transform: uppercase;
            color: transparent;
            -webkit-text-stroke: 2px rgba(255, 255, 255, 0.08);
            position: relative;
            user-select: none;
            margin-bottom: 12px;
        }

        .error-code::after {
            content: attr(data-code);
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            -webkit-text-stroke: 0;
            color: transparent;
            background: linear-gradient(180deg, rgba(224, 32, 32, 0.55) 0%, rgba(224, 32, 32, 0.05) 100%);
            -webkit-background-clip: text;
            background-clip: text;
        }

        /* Icon + divider */
        .error-icon {
            font-size: 48px;
            display: block;
            margin: 0 auto 16px;
            animation: iconFloat 3s ease-in-out infinite;
        }

        @keyframes iconFloat {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-8px);
            }
        }

        .error-divider {
            width: 64px;
            height: 3px;
            background: var(--red);
            margin: 0 auto 24px;
            border-radius: 2px;
        }

        .error-label {
            font-family: var(--font-head);
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.25em;
            text-transform: uppercase;
            color: var(--red);
            margin-bottom: 12px;
            display: block;
        }

        .error-title {
            font-family: var(--font-head);
            font-size: clamp(28px, 5vw, 42px);
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.02em;
            line-height: 1.1;
            color: var(--white);
            margin-bottom: 16px;
        }

        .error-desc {
            font-size: 15px;
            color: rgba(255, 255, 255, 0.45);
            line-height: 1.7;
            margin-bottom: 40px;
        }

        /* ── Actions ── */
        .error-actions {
            display: flex;
            gap: 12px;
            justify-content: center;
            flex-wrap: wrap;
            margin-bottom: 48px;
        }

        .btn-primary {
            font-family: var(--font-head);
            font-size: 14px;
            font-weight: 800;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--white);
            background: var(--red);
            padding: 12px 30px;
            border-radius: 5px;
            border: 2px solid var(--red);
            transition: background 0.2s, transform 0.2s;
            display: inline-block;
        }

        .btn-primary:hover {
            background: var(--red-dark);
            border-color: var(--red-dark);
            transform: translateY(-2px);
        }

        .btn-ghost {
            font-family: var(--font-head);
            font-size: 14px;
            font-weight: 800;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.6);
            background: transparent;
            padding: 12px 30px;
            border-radius: 5px;
            border: 2px solid rgba(255, 255, 255, 0.15);
            transition: border-color 0.2s, color 0.2s, transform 0.2s;
            display: inline-block;
        }

        .btn-ghost:hover {
            border-color: rgba(255, 255, 255, 0.5);
            color: var(--white);
            transform: translateY(-2px);
        }

        /* ── Quick Links ── */
        .quick-links {
            display: flex;
            gap: 6px 20px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .quick-link {
            font-family: var(--font-head);
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.3);
            transition: color 0.2s;
            position: relative;
        }

        .quick-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            right: 0;
            height: 1px;
            background: var(--red);
            transform: scaleX(0);
            transition: transform 0.2s;
            transform-origin: left;
        }

        .quick-link:hover {
            color: rgba(255, 255, 255, 0.7);
        }

        .quick-link:hover::after {
            transform: scaleX(1);
        }

        /* ── Footer mini ── */
        .error-footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 14px 32px;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            display: flex;
            align-items: center;
            justify-content: space-between;
            z-index: 5;
        }

        .error-footer p {
            font-family: var(--font-head);
            font-size: 11px;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.2);
        }

        /* ── Corner decorations ── */
        .corner {
            position: fixed;
            width: 60px;
            height: 60px;
            pointer-events: none;
            z-index: 2;
            opacity: 0.25;
        }

        .corner-tl {
            top: 70px;
            left: 16px;
            border-top: 2px solid var(--red);
            border-left: 2px solid var(--red);
        }

        .corner-br {
            bottom: 48px;
            right: 16px;
            border-bottom: 2px solid var(--red);
            border-right: 2px solid var(--red);
        }

        /* ── Responsive ── */
        @media (max-width: 600px) {
            .mini-nav {
                padding: 0 16px;
            }

            .error-footer {
                flex-direction: column;
                gap: 6px;
                padding: 12px 16px;
            }

            .error-actions {
                flex-direction: column;
                align-items: center;
            }

            .btn-primary,
            .btn-ghost {
                width: 100%;
                max-width: 280px;
                text-align: center;
            }
        }
    </style>
</head>

<body>

    <!-- ══ LOADER ══ -->
    <div id="loader">
        <div class="loader-gear">⚙️</div>
        <div class="loader-logo">NXLS <span>MECHANICAL</span></div>
        <div class="loader-track">
            <div class="loader-bar"></div>
        </div>
        <p class="loader-text">Memuat Halaman...</p>
    </div>

    <!-- ══ DECORATIONS ══ -->
    <div class="noise"></div>
    <div class="grid-bg"></div>
    <div class="accent-line-top"></div>
    <div class="corner corner-tl"></div>
    <div class="corner corner-br"></div>

    <!-- ══ MINI NAV ══ -->
    <nav class="mini-nav">
        <img src="{{ 'assets/img/logo.png' }}" alt="AutoPart Original Logo" class="logo-img" id="logoImg">
        <a href="{{ url('/') }}" class="mini-back">← Kembali ke Home</a>
    </nav>

    <!-- ══ MAIN CONTENT ══ -->
    <div class="page-wrap" id="pageWrap">
        <div class="error-card">

            <!-- Giant number -->
            <div class="error-code" data-code="404">404</div>

            <!-- Icon -->
            <span class="error-icon">🔩</span>
            <div class="error-divider"></div>

            <span class="error-label">Error 404 — Tidak Ditemukan</span>

            <h1 class="error-title">Halaman Ini<br>Hilang dari Garasi</h1>

            <p class="error-desc">
                Spare part yang kamu cari tidak ada di rak kami.<br>
                Mungkin sudah dipindah, dihapus, atau link-nya salah ketik.
            </p>

            <!-- Actions -->
            <div class="error-actions">
                <a href="{{ url('/') }}" class="btn-primary">🏠 Kembali ke Beranda</a>
                <a href="{{ url('/#product') }}" class="btn-ghost">🔧 Lihat Produk</a>
            </div>

            <!-- Quick Links -->
            <div class="quick-links">
                <a href="{{ url('/') }}" class="quick-link">Home</a>
                <a href="{{ url('/#about') }}" class="quick-link">About</a>
                <a href="{{ url('/#product') }}" class="quick-link">Product</a>
                <a href="{{ url('/login') }}" class="quick-link">Login</a>
                <a href="{{ url('/register') }}" class="quick-link">Register</a>
            </div>

        </div>
    </div>

    <!-- ══ FOOTER ══ -->
    <footer class="error-footer">
        <p>© 2026 NXLS MECHANICAL</p>
        <p>Error Code: 404 · Page Not Found</p>
    </footer>

    <script>
        // Loading screen — tampil 1.6 detik lalu fade out
        window.addEventListener('load', function() {
            setTimeout(function() {
                var loader = document.getElementById('loader');
                var page = document.getElementById('pageWrap');
                loader.classList.add('hidden');
                setTimeout(function() {
                    page.classList.add('visible');
                    loader.style.display = 'none';
                }, 500);
            }, 1600);
        });
    </script>
</body>

</html>
