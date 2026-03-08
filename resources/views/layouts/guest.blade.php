<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'AutoPart Original' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@400;600;700;800;900&family=Barlow:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --red: #E02020;
            --red-dark: #B01010;
            --black: #0D0D0D;
            --dark: #151515;
            --dark2: #1E1E1E;
            --mid: #444;
            --light: #F5F5F5;
            --white: #FFFFFF;
            --font-head: 'Barlow Condensed', sans-serif;
            --font-body: 'Barlow', sans-serif;
            --radius: 6px;
            --transition: 0.22s ease;
        }
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { height: 100%; }
        body {
            font-family: var(--font-body);
            background: var(--black);
            color: var(--white);
            min-height: 100vh;
            display: flex;
            align-items: stretch;
            overflow-x: hidden;
        }

        /* ---- SPLIT LAYOUT ---- */
        .auth-wrap {
            display: flex;
            width: 100%;
            min-height: 100vh;
        }

        /* Left panel — branding */
        .auth-left {
            flex: 1;
            background: var(--dark);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 48px;
            position: relative;
            overflow: hidden;
            min-height: 100vh;
        }
        .auth-left::before {
            content: '';
            position: absolute;
            top: -80px; right: -80px;
            width: 340px; height: 340px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(224,32,32,0.18) 0%, transparent 70%);
            pointer-events: none;
        }
        .auth-left::after {
            content: '';
            position: absolute;
            bottom: -60px; left: -60px;
            width: 260px; height: 260px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(224,32,32,0.10) 0%, transparent 70%);
            pointer-events: none;
        }

        .auth-brand { position: relative; z-index: 1; }
        .auth-logo-link { display: inline-flex; align-items: center; gap: 12px; }
        .auth-logo-img {
            height: 44px; width: auto;
            object-fit: contain;
            min-width: 110px;
        }
        .auth-logo-text {
            font-family: var(--font-head);
            font-size: 20px;
            font-weight: 800;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            color: var(--white);
        }

        .auth-left-body {
            position: relative;
            z-index: 1;
        }
        .auth-left-eyebrow {
            font-family: var(--font-head);
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: var(--red);
            margin-bottom: 16px;
            border-left: 3px solid var(--red);
            padding-left: 10px;
        }
        .auth-left-title {
            font-family: var(--font-head);
            font-size: clamp(36px, 4vw, 56px);
            font-weight: 900;
            text-transform: uppercase;
            line-height: 1.05;
            color: var(--white);
            margin-bottom: 18px;
        }
        .auth-left-title span { color: var(--red); display: block; }
        .auth-left-desc {
            font-size: 14px;
            color: rgba(255,255,255,0.5);
            line-height: 1.7;
            max-width: 320px;
        }

        .auth-left-footer {
            position: relative;
            z-index: 1;
        }
        .auth-left-footer p {
            font-size: 12px;
            color: rgba(255,255,255,0.25);
        }

        /* Right panel — form */
        .auth-right {
            width: 460px;
            flex-shrink: 0;
            background: var(--white);
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 56px 48px;
            position: relative;
        }

        /* Back button */
        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-family: var(--font-head);
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--mid);
            margin-bottom: 36px;
            transition: color var(--transition);
            text-decoration: none;
            width: fit-content;
        }
        .btn-back svg { width: 14px; height: 14px; transition: transform var(--transition); }
        .btn-back:hover { color: var(--red); }
        .btn-back:hover svg { transform: translateX(-3px); }

        /* Form header */
        .auth-form-title {
            font-family: var(--font-head);
            font-size: 32px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 0.02em;
            color: var(--black);
            margin-bottom: 6px;
        }
        .auth-form-subtitle {
            font-size: 14px;
            color: #888;
            margin-bottom: 32px;
            line-height: 1.5;
        }
        .auth-form-subtitle a {
            color: var(--red);
            font-weight: 600;
            text-decoration: none;
            transition: color var(--transition);
        }
        .auth-form-subtitle a:hover { color: var(--red-dark); text-decoration: underline; }

        /* Session status */
        .auth-status {
            background: #f0fdf4;
            border: 1px solid #86efac;
            border-radius: var(--radius);
            padding: 10px 14px;
            font-size: 13px;
            color: #166534;
            margin-bottom: 20px;
        }

        /* Form fields */
        .form-field { margin-bottom: 18px; }
        .form-label {
            font-family: var(--font-head);
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: #555;
            display: block;
            margin-bottom: 7px;
        }
        .form-input {
            font-family: var(--font-body);
            font-size: 14px;
            width: 100%;
            padding: 11px 14px;
            border: 1.5px solid #DDD;
            border-radius: var(--radius);
            background: var(--white);
            color: var(--black);
            outline: none;
            transition: border-color var(--transition), box-shadow var(--transition);
        }
        .form-input:focus {
            border-color: var(--red);
            box-shadow: 0 0 0 3px rgba(224,32,32,0.1);
        }
        .form-input::placeholder { color: #bbb; }
        .form-error {
            font-size: 12px;
            color: var(--red);
            margin-top: 5px;
        }

        /* Remember me */
        .remember-wrap {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 8px;
        }
        .remember-wrap input[type="checkbox"] {
            width: 16px; height: 16px;
            border-radius: 3px;
            border: 1.5px solid #ccc;
            cursor: pointer;
            accent-color: var(--red);
        }
        .remember-wrap label {
            font-size: 13px;
            color: #666;
            cursor: pointer;
        }

        /* Form actions */
        .form-actions {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 24px;
            gap: 12px;
        }
        .link-secondary {
            font-size: 13px;
            color: #888;
            text-decoration: underline;
            transition: color var(--transition);
        }
        .link-secondary:hover { color: var(--black); }

        .btn-submit {
            font-family: var(--font-head);
            font-size: 15px;
            font-weight: 800;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--white);
            background: var(--red);
            border: none;
            padding: 12px 32px;
            border-radius: var(--radius);
            cursor: pointer;
            transition: background var(--transition), transform var(--transition);
            white-space: nowrap;
        }
        .btn-submit:hover { background: var(--red-dark); transform: translateY(-1px); }
        .btn-submit-full {
            width: 100%;
            margin-top: 24px;
            padding: 13px;
        }

        /* Divider */
        .auth-divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 24px 0;
            color: #ccc;
            font-size: 12px;
        }
        .auth-divider::before, .auth-divider::after {
            content: ''; flex: 1; height: 1px; background: #eee;
        }

        /* Responsive */
        @media (max-width: 900px) {
            .auth-left { display: none; }
            .auth-right { width: 100%; padding: 48px 32px; }
        }
        @media (max-width: 480px) {
            .auth-right { padding: 36px 20px; }
            .form-actions { flex-direction: column; align-items: stretch; }
            .btn-submit { width: 100%; text-align: center; }
        }
    </style>
</head>
<body>
<div class="auth-wrap">

    <!-- LEFT PANEL -->
    <div class="auth-left">
        <div class="auth-brand">
            <a href="/" class="auth-logo-link">
                <img src="{{ 'assets/img/logo.png' }}" alt="AutoPart Original Logo" class="auth-logo-img">
            </a>
        </div>

        <div class="auth-left-body">
            <div class="auth-left-eyebrow">✦ Platform Spare Part Terpercaya</div>
            <h2 class="auth-left-title">
                Suku Cadang
                <span>Original.</span>
                Harga Terbaik.
            </h2>
            <p class="auth-left-desc">
                Spare part mobil Jepang, Eropa, dan Amerika. Garansi resmi distributor, pengiriman ke seluruh Indonesia.
            </p>
        </div>

        <div class="auth-left-footer">
            <p>© 2026 AutoPart Original. All rights reserved.</p>
        </div>
    </div>

    <!-- RIGHT PANEL -->
    <div class="auth-right">
        {{ $slot }}
    </div>

</div>
</body>
</html>
