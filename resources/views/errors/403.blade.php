<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 — Akses Ditolak | NXLS MECHANICAL</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@400;600;700;800;900&family=Barlow:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        /* ── Variables ── */
        :root {
            --red:      #E02020;
            --red-dark: #B01010;
            --black:    #0D0D0D;
            --dark:     #151515;
            --dark2:    #1E1E1E;
            --dark3:    #2A2A2A;
            --mid:      #444444;
            --light:    #F5F5F5;
            --white:    #FFFFFF;
            --amber:    #F59E0B;
            --font-head:'Barlow Condensed', sans-serif;
            --font-body:'Barlow', sans-serif;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }
        body {
            font-family: var(--font-body);
            background: var(--black);
            color: var(--white);
            min-height: 100vh;
            overflow-x: hidden;
        }
        a { text-decoration: none; color: inherit; }

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

        /* Lock icon animated */
        .loader-lock {
            font-size: 44px;
            animation: lockShake 1.8s ease-in-out infinite;
        }
        @keyframes lockShake {
            0%, 100% { transform: rotate(0deg); }
            15%  { transform: rotate(-8deg); }
            30%  { transform: rotate(8deg); }
            45%  { transform: rotate(-4deg); }
            60%  { transform: rotate(4deg); }
            75%  { transform: rotate(0deg); }
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
        .loader-logo em { color: var(--red); font-style: normal; }

        @keyframes logoPulse {
            from { opacity: 0.6; }
            to   { opacity: 1; }
        }

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
            top: 0; left: -40%;
            width: 40%;
            height: 100%;
            background: linear-gradient(90deg, transparent, var(--amber), transparent);
            border-radius: 2px;
            animation: barSlide 1s ease infinite;
        }
        @keyframes barSlide {
            0%   { left: -40%; }
            100% { left: 100%; }
        }

        .loader-text {
            font-family: var(--font-head);
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 0.3em;
            text-transform: uppercase;
            color: rgba(255,255,255,0.35);
        }

        /* ══════════════════════════════════════
           BG EFFECTS
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
        .grid-bg {
            position: fixed;
            inset: 0;
            z-index: 0;
            pointer-events: none;
            background-image:
                linear-gradient(rgba(255,255,255,0.025) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.025) 1px, transparent 1px);
            background-size: 60px 60px;
        }

        /* Amber accent top for 403 (warning vibe) */
        .accent-line-top {
            position: fixed;
            top: 0; left: 0; right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--red) 0%, var(--amber) 50%, var(--red) 100%);
            background-size: 200% 100%;
            animation: gradientShift 3s linear infinite;
            z-index: 10;
        }
        @keyframes gradientShift {
            0%   { background-position: 0% 0%; }
            100% { background-position: 200% 0%; }
        }

        /* Warning stripes corner */
        .stripe-corner {
            position: fixed;
            bottom: 48px; left: 0;
            width: 120px; height: 6px;
            background: repeating-linear-gradient(
                45deg,
                var(--amber) 0px,
                var(--amber) 8px,
                var(--black) 8px,
                var(--black) 16px
            );
            opacity: 0.35;
            z-index: 2;
        }
        .stripe-corner-r {
            position: fixed;
            top: 70px; right: 0;
            width: 6px; height: 120px;
            background: repeating-linear-gradient(
                180deg,
                var(--red) 0px,
                var(--red) 8px,
                var(--black) 8px,
                var(--black) 16px
            );
            opacity: 0.35;
            z-index: 2;
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

        /* ── Mini Nav ── */
        .mini-nav {
            position: fixed;
            top: 3px; left: 0; right: 0;
            height: 60px;
            background: rgba(13,13,13,0.95);
            border-bottom: 1px solid rgba(255,255,255,0.06);
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
        .mini-brand em { color: var(--red); font-style: normal; }
        .mini-back {
            font-family: var(--font-head);
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: rgba(255,255,255,0.5);
            border: 1.5px solid rgba(255,255,255,0.15);
            padding: 6px 18px;
            border-radius: 4px;
            transition: color 0.2s, border-color 0.2s;
        }
        .mini-back:hover { color: var(--white); border-color: rgba(255,255,255,0.5); }

        /* ── Error Card ── */
        .error-card {
            text-align: center;
            max-width: 640px;
            width: 100%;
            margin-top: 60px;
        }

        /* Giant 403 */
        .error-code {
            font-family: var(--font-head);
            font-size: clamp(120px, 22vw, 240px);
            font-weight: 900;
            line-height: 0.85;
            letter-spacing: -0.04em;
            text-transform: uppercase;
            color: transparent;
            -webkit-text-stroke: 2px rgba(255,255,255,0.06);
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
            background: linear-gradient(180deg, rgba(245,158,11,0.5) 0%, rgba(224,32,32,0.08) 100%);
            -webkit-background-clip: text;
            background-clip: text;
        }

        /* Warning badge */
        .warning-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(245,158,11,0.1);
            border: 1px solid rgba(245,158,11,0.3);
            border-radius: 4px;
            padding: 5px 14px;
            margin-bottom: 20px;
        }
        .warning-badge span {
            font-family: var(--font-head);
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: var(--amber);
        }

        .error-icon {
            font-size: 52px;
            display: block;
            margin: 0 auto 16px;
            animation: iconPulse 2s ease-in-out infinite;
        }
        @keyframes iconPulse {
            0%, 100% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.08); opacity: 0.75; }
        }

        .error-divider {
            width: 64px;
            height: 3px;
            background: linear-gradient(90deg, var(--red), var(--amber));
            margin: 0 auto 24px;
            border-radius: 2px;
        }

        .error-label {
            font-family: var(--font-head);
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.25em;
            text-transform: uppercase;
            color: var(--amber);
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
            color: rgba(255,255,255,0.45);
            line-height: 1.7;
            margin-bottom: 32px;
        }

        /* Info Box */
        .info-box {
            background: rgba(245,158,11,0.06);
            border: 1px solid rgba(245,158,11,0.18);
            border-left: 3px solid var(--amber);
            border-radius: 5px;
            padding: 14px 18px;
            text-align: left;
            margin-bottom: 32px;
        }
        .info-box p {
            font-size: 13px;
            color: rgba(255,255,255,0.5);
            line-height: 1.65;
        }
        .info-box strong {
            font-family: var(--font-head);
            font-weight: 700;
            color: var(--amber);
            font-size: 12px;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            display: block;
            margin-bottom: 4px;
        }

        /* ── Actions ── */
        .error-actions {
            display: flex;
            gap: 12px;
            justify-content: center;
            flex-wrap: wrap;
            margin-bottom: 40px;
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
        .btn-primary:hover { background: var(--red-dark); border-color: var(--red-dark); transform: translateY(-2px); }
        .btn-amber {
            font-family: var(--font-head);
            font-size: 14px;
            font-weight: 800;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--black);
            background: var(--amber);
            padding: 12px 30px;
            border-radius: 5px;
            border: 2px solid var(--amber);
            transition: filter 0.2s, transform 0.2s;
            display: inline-block;
        }
        .btn-amber:hover { filter: brightness(1.15); transform: translateY(-2px); }
        .btn-ghost {
            font-family: var(--font-head);
            font-size: 14px;
            font-weight: 800;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: rgba(255,255,255,0.5);
            background: transparent;
            padding: 12px 30px;
            border-radius: 5px;
            border: 2px solid rgba(255,255,255,0.12);
            transition: border-color 0.2s, color 0.2s, transform 0.2s;
            display: inline-block;
        }
        .btn-ghost:hover { border-color: rgba(255,255,255,0.4); color: var(--white); transform: translateY(-2px); }

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
            color: rgba(255,255,255,0.25);
            transition: color 0.2s;
            position: relative;
        }
        .quick-link::after {
            content: '';
            position: absolute;
            bottom: -2px; left: 0; right: 0;
            height: 1px;
            background: var(--amber);
            transform: scaleX(0);
            transition: transform 0.2s;
            transform-origin: left;
        }
        .quick-link:hover { color: rgba(255,255,255,0.65); }
        .quick-link:hover::after { transform: scaleX(1); }

        /* ── Footer ── */
        .error-footer {
            position: fixed;
            bottom: 0; left: 0; right: 0;
            padding: 14px 32px;
            border-top: 1px solid rgba(255,255,255,0.05);
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
            color: rgba(255,255,255,0.2);
        }
        .error-footer .status-dot {
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .status-dot::before {
            content: '';
            width: 6px; height: 6px;
            border-radius: 50%;
            background: var(--amber);
            animation: blink 1.2s ease infinite;
        }
        @keyframes blink {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.3; }
        }

        /* ── Responsive ── */
        @media (max-width: 600px) {
            .mini-nav { padding: 0 16px; }
            .error-footer { flex-direction: column; gap: 6px; padding: 12px 16px; }
            .error-actions { flex-direction: column; align-items: center; }
            .btn-primary, .btn-amber, .btn-ghost { width: 100%; max-width: 280px; text-align: center; }
        }
    </style>
</head>
<body>

    <!-- ══ LOADER ══ -->
    <div id="loader">
        <div class="loader-lock">🔒</div>
        <div class="loader-logo">NXLS <em>MECHANICAL</em></div>
        <div class="loader-track"><div class="loader-bar"></div></div>
        <p class="loader-text">Memeriksa Akses...</p>
    </div>

    <!-- ══ DECORATIONS ══ -->
    <div class="noise"></div>
    <div class="grid-bg"></div>
    <div class="accent-line-top"></div>
    <div class="stripe-corner"></div>
    <div class="stripe-corner-r"></div>

    <!-- ══ MINI NAV ══ -->
    <nav class="mini-nav">
        <a href="{{ url('/') }}" class="mini-brand">NXLS <em>MECHANICAL</em></a>
        <a href="{{ url('/') }}" class="mini-back">← Kembali ke Home</a>
    </nav>

    <!-- ══ MAIN CONTENT ══ -->
    <div class="page-wrap" id="pageWrap">
        <div class="error-card">

            <!-- Giant 403 -->
            <div class="error-code" data-code="403">403</div>

            <!-- Icon + warning badge -->
            <span class="error-icon">🔐</span>
            <div class="warning-badge">
                <span>⚠ Akses Ditolak</span>
            </div>
            <div class="error-divider"></div>

            <span class="error-label">Error 403 — Forbidden</span>

            <h1 class="error-title">Hayoo ngapain?<br>Zona ini Terlarang</h1>

            <p class="error-desc">
                Kamu tidak memiliki izin untuk mengakses halaman ini.<br>
                Silakan login atau hubungi admin jika kamu merasa ini adalah kesalahan.
            </p>

            <!-- Info box -->
            <div class="info-box">
                <strong>⚙ Kenapa ini terjadi?</strong>
                <p>Halaman ini membutuhkan hak akses khusus. Pastikan kamu sudah login dengan akun yang tepat, atau hubungi administrator untuk mendapatkan izin akses.</p>
            </div>

            <!-- Actions -->
            <div class="error-actions">
                <a href="{{ url('/login') }}" class="btn-amber">🔑 Login Sekarang</a>
                <a href="{{ url('/') }}" class="btn-primary">🏠 Ke Beranda</a>
                @auth
                <a href="javascript:history.back()" class="btn-ghost">← Kembali</a>
                @endauth
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
        <p class="status-dot">Error Code: 403 · Access Forbidden</p>
    </footer>

    <script>
        // Loading screen — tampil 1.8 detik (sedikit lebih lama untuk efek "checking access")
        window.addEventListener('load', function () {
            setTimeout(function () {
                var loader = document.getElementById('loader');
                var page   = document.getElementById('pageWrap');
                loader.classList.add('hidden');
                setTimeout(function () {
                    page.classList.add('visible');
                    loader.style.display = 'none';
                }, 500);
            }, 1800);
        });
    </script>
</body>
</html>
