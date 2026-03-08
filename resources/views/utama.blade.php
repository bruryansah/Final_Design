<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoPart Original – Toko Spare Part Motor Terlengkap</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@400;600;700;800;900&family=Barlow:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body>

    <!-- ============================================================
         NAVBAR
    ============================================================ -->
    <nav class="navbar" id="navbar">
        <div class="nav-container">
            <!-- Logo -->
            <a href="#home" class="nav-logo">
                <img src="{{'assets/img/logo.png' }}" alt="AutoPart Original Logo" class="logo-img" id="logoImg">
            </a>

            <!-- Nav Links -->
            <ul class="nav-links" id="navLinks">
                <li><a href="#home" class="nav-link active" data-section="home">Home</a></li>
                <li><a href="#about" class="nav-link" data-section="about">About</a></li>
                <li><a href="#product" class="nav-link" data-section="product">Product</a></li>
                @auth
                <li><a href="/admin" class="nav-link" data-section="dashboard">Dashboard</a></li>
                @endauth
            </ul>

            <!-- Auth Actions -->
            <div class="nav-auth">
                @guest
                <a href="/login" class="btn-login">Login</a>
                <a href="/register" class="btn-register">Register</a>
                @endguest

                @auth
                <div class="greeting" id="greetingText">
                    <span class="greeting-time" id="greetingTime"></span>
                    <span class="greeting-name">{{ Auth::user()->name }}</span>
                </div>
                <form action="/logout" method="POST" style="display:inline">
                    @csrf
                    <button type="submit" class="btn-logout">Logout</button>
                </form>
                @endauth
            </div>

            <!-- Hamburger -->
            <button class="hamburger" id="hamburger" aria-label="Menu">
                <span></span><span></span><span></span>
            </button>
        </div>
    </nav>

    <!-- ============================================================
         HERO / HOME SECTION
    ============================================================ -->
    <section class="section-hero" id="home">
        <div class="hero-overlay"></div>
        <img src="{{ 'assets/img/ice-v.jpg' }}" alt="Hero Background" class="hero-bg-img" id="heroBgImg">
        <div class="hero-wrapper">
            <div class="hero-content">
                <div class="hero-eyebrow">✦ Suku Cadang Mobil Original &amp; Terlengkap</div>
                <h1 class="hero-title">
                    Solusi Digital<br>
                    <span class="hero-title-accent">Kendaraan Anda</span>
                </h1>
                <p class="hero-desc">
                    Kebutuhan spare part mobil Jepang, Eropa, dan Amerika.<br>
                    Harga distributor, garansi resmi, pengiriman ke seluruh Indonesia.
                </p>
                <div class="hero-actions">
                    <a href="#product" class="btn-primary">Lihat Produk</a>
                    <a href="#about" class="btn-outline">Tentang Kami</a>
                </div>
            </div>
        </div>
        <div class="scroll-indicator">
            <div class="scroll-dot"></div>
        </div>
    </section>

    <!-- ============================================================
         ABOUT SECTION
    ============================================================ -->
    <section class="section-about" id="about">
        <div class="container">
            <div class="about-grid">

                <div class="about-text">
                    <div class="section-label">Tentang Kami</div>
                    <h2 class="section-title">Mengapa Memilih <span class="accent">Kami?</span></h2>
                    <p class="about-desc">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, quisquam atque distinctio
                        asperiores inventore illo molestias tempore amet ducimus nobis quasi et magnam non, voluptate
                        nam incidunt. Ipsum dicta sit quos veniam.
                    </p>
                    <div class="about-features">
                        <div class="feature-item">
                            <div class="feature-icon">🚀</div>
                            <div>
                                <h4>Pengiriman Cepat ke Seluruh Indonesia</h4>
                                <p>Kami menjamin pengiriman tepat waktu ke seluruh penjuru Indonesia.</p>
                            </div>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon">🛡️</div>
                            <div>
                                <h4>Garansi Produk Resmi</h4>
                                <p>Semua produk kami dilengkapi garansi resmi dari distributor terpercaya.</p>
                            </div>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon">📱</div>
                            <div>
                                <h4>Belanja Mudah &amp; Aman</h4>
                                <p>Platform belanja yang mudah digunakan dengan sistem keamanan terjamin.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="about-visual">
                    <div class="about-image-box">
                        <img src="{{'assets/img/workshop.jpg'}}" alt="About AutoPart Original" class="about-img" id="aboutImg">
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ============================================================
         PRODUCT SECTION
    ============================================================ -->
    <section class="section-product" id="product">
        <div class="container">

            <!-- Search Bar -->
            <div class="product-search-bar">
                <input type="text" id="searchInput" class="search-input" placeholder="Cari spare part...">
                <button class="btn-cari" id="btnCari" onclick="doSearch()">CARI</button>
            </div>

            <!-- ===== MEREK TERKENAL ===== -->
            <div class="subsection">
                <div class="subsection-header">
                    <h3 class="subsection-title">MEREK TERKENAL</h3>
                    <a href="#" class="link-more" id="linkCekMerek">CEK MEREK LAINNYA &gt;</a>
                </div>

                <div class="brand-grid" id="brandGrid">
                    @isset($jenisUnik)
                        @foreach ($jenisUnik as $index => $jenis)
                        <button class="brand-card {{ $index === 0 ? 'active' : '' }}" data-jenis="{{ $jenis }}" onclick="filterByJenis('{{ $jenis }}', this)">
                            <span class="brand-name">{{ strtoupper($jenis) }}</span>
                        </button>
                        @endforeach
                    @else
                        @php $dummyBrands = ['Semua', 'Yamaha', 'Honda', 'Suzuki', 'Toyota', 'Kawasaki', 'Mitsubishi', 'Daihatsu']; @endphp
                        @foreach ($dummyBrands as $index => $brand)
                        <button class="brand-card {{ $index === 0 ? 'active' : '' }}" data-jenis="{{ $brand }}" onclick="filterByJenis('{{ $brand }}', this)">
                            <span class="brand-name">{{ strtoupper($brand) }}</span>
                        </button>
                        @endforeach
                    @endisset
                </div>
            </div>

            <!-- ===== SPAREPART LIST ===== -->
            <div class="subsection" id="sparepart-section">
                <div class="subsection-header">
                    <h3 class="subsection-title" id="sparepartTitle">SPAREPART</h3>
                    <a href="#" class="link-more">CEK SPAREPART LAINNYA &gt;</a>
                </div>

                <div class="product-grid" id="productGrid">
                    @isset($produk)
                        @forelse ($produk as $index => $p)
                        <div class="product-card" data-jenis="{{ $p->jenis }}" style="--card-delay: {{ $index * 0.08 }}s">
                            <div class="card-image-wrap">
                                <img
                                    src="{{ $p->image ? asset('storage/'.$p->image) : '' }}"
                                    alt="{{ $p->nama }}"
                                    class="card-img"
                                    onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                                >
                                <div class="card-img-placeholder" style="display:none"><span>🔧</span></div>
                            </div>
                            <div class="card-body">
                                <span class="card-jenis">{{ $p->jenis }}</span>
                                <span class="card-tipe">{{ $p->tipe }}</span>
                                <h4 class="card-title">{{ $p->nama }}</h4>
                                @isset($p->harga)
                                <p class="card-price">Rp {{ number_format($p->harga, 0, ',', '.') }}</p>
                                @endisset
                                @if(Auth::check() && Auth::user()->role == 'Guest')
                                <div class="card-actions">
                                    <button class="btn-beli" onclick="openModalBeli('{{ $p->kode ?? $p->id }}')">
                                        🛒 Beli
                                    </button>
                                    <button class="btn-keranjang" onclick="openModalKeranjang('{{ $p->id }}')">
                                        🧺 Keranjang
                                    </button>
                                </div>
                                @endif
                            </div>
                        </div>

                        {{-- ===== MODAL BELI ===== --}}
                        @if(Auth::check() && Auth::user()->role == 'Guest')
                        <div class="modal-overlay" id="modal-beli-{{ $p->kode ?? $p->id }}" onclick="closeModalBeliIfOverlay(event, this)">
                            <div class="modal-box">
                                <div class="modal-head">
                                    <div>
                                        <span class="modal-label">Pembelian Langsung</span>
                                        <h3 class="modal-title">{{ $p->nama }}</h3>
                                    </div>
                                    <button class="modal-close" onclick="closeModalBeli('{{ $p->kode ?? $p->id }}')" aria-label="Tutup">✕</button>
                                </div>
                                <div class="modal-body">
                                    <div class="modal-img-wrap">
                                        @if($p->image)
                                            <img src="{{ asset('storage/'.$p->image) }}" alt="{{ $p->nama }}" class="modal-img">
                                        @else
                                            <div class="modal-img-placeholder"><span>🔧</span></div>
                                        @endif
                                    </div>
                                    <div class="modal-info">
                                        <div class="modal-info-row">
                                            <span class="modal-info-label">Tipe</span>
                                            <span class="modal-info-value">{{ $p->tipe }}</span>
                                        </div>
                                        <div class="modal-info-row">
                                            <span class="modal-info-label">Jenis</span>
                                            <span class="modal-info-value">{{ $p->jenis }}</span>
                                        </div>
                                        @isset($p->harga)
                                        <div class="modal-info-row">
                                            <span class="modal-info-label">Harga</span>
                                            <span class="modal-info-value modal-price">Rp {{ number_format($p->harga, 0, ',', '.') }}</span>
                                        </div>
                                        @endisset
                                        @isset($p->stok)
                                        <div class="modal-info-row">
                                            <span class="modal-info-label">Stok</span>
                                            <span class="modal-info-value {{ $p->stok > 0 ? 'stok-ada' : 'stok-habis' }}">
                                                {{ $p->stok > 0 ? $p->stok . ' tersedia' : 'Habis' }}
                                            </span>
                                        </div>
                                        @endisset
                                    </div>
                                    <form action="/pembelian/storeinput" method="POST" class="modal-form">
                                        @csrf
                                        <input type="hidden" name="kodeproduk" value="{{ $p->id }}">
                                        @isset($p->harga)
                                        <input type="hidden" name="harga" value="{{ $p->harga }}">
                                        @endisset
                                        <div class="modal-field">
                                            <label for="banyak-{{ $p->id }}" class="modal-field-label">Jumlah Pembelian</label>
                                            <div class="qty-wrap">
                                                <button type="button" class="qty-btn" onclick="changeQty('banyak-{{ $p->id }}', -1)">−</button>
                                                <input type="number" id="banyak-{{ $p->id }}" name="banyak" value="1" min="1"
                                                    @isset($p->stok) max="{{ $p->stok }}" @endisset
                                                    required class="qty-input"
                                                    data-harga="{{ $p->harga ?? 0 }}"
                                                    data-total-id="total-{{ $p->id }}"
                                                    onchange="updateTotal(this)">
                                                <button type="button" class="qty-btn" onclick="changeQty('banyak-{{ $p->id }}', 1)">+</button>
                                            </div>
                                            @isset($p->harga)
                                            <p class="qty-total" id="total-{{ $p->id }}">
                                                Total: <strong>Rp {{ number_format($p->harga, 0, ',', '.') }}</strong>
                                            </p>
                                            @endisset
                                        </div>
                                        <div class="modal-footer-btns">
                                            <button type="button" class="btn-cancel" onclick="closeModalBeli('{{ $p->kode ?? $p->id }}')">Batal</button>
                                            <button type="submit" class="btn-confirm">🛒 Konfirmasi Beli</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        {{-- ===== MODAL KERANJANG ===== --}}
                        <div class="modal-overlay" id="modal-keranjang-{{ $p->id }}" onclick="closeModalKeranjangIfOverlay(event, this)">
                            <div class="modal-box">
                                <div class="modal-head">
                                    <div>
                                        <span class="modal-label modal-label-cart">🧺 Keranjang Belanja</span>
                                        <h3 class="modal-title">{{ $p->nama }}</h3>
                                    </div>
                                    <button class="modal-close" onclick="closeModalKeranjang('{{ $p->id }}')" aria-label="Tutup">✕</button>
                                </div>
                                <div class="modal-body">
                                    <div class="cart-product-preview">
                                        <div class="cart-preview-img">
                                            @if($p->image)
                                                <img src="{{ asset('storage/'.$p->image) }}" alt="{{ $p->nama }}">
                                            @else
                                                <div class="modal-img-placeholder" style="height:100%"><span>🔧</span></div>
                                            @endif
                                        </div>
                                        <div class="cart-preview-info">
                                            <span class="card-jenis">{{ $p->jenis }}</span>
                                            <p class="cart-preview-name">{{ $p->nama }}</p>
                                            @isset($p->harga)
                                            <p class="cart-preview-price">Rp {{ number_format($p->harga, 0, ',', '.') }}</p>
                                            @endisset
                                            @isset($p->stok)
                                            <p class="cart-preview-stok {{ $p->stok > 0 ? 'stok-ada' : 'stok-habis' }}">
                                                {{ $p->stok > 0 ? 'Stok: ' . $p->stok : 'Stok Habis' }}
                                            </p>
                                            @endisset
                                        </div>
                                    </div>
                                    <div class="modal-divider"></div>
                                    <form action="/keranjang/store" method="POST" class="modal-form">
                                        @csrf
                                        <input type="hidden" name="produk_id" value="{{ $p->id }}">
                                        <div class="modal-field">
                                            <label for="jumlah-{{ $p->id }}" class="modal-field-label">Jumlah</label>
                                            <div class="qty-wrap">
                                                <button type="button" class="qty-btn" onclick="changeQtyCart('jumlah-{{ $p->id }}', -1)">−</button>
                                                <input type="number" id="jumlah-{{ $p->id }}" name="jumlah" value="1" min="1"
                                                    @isset($p->stok) max="{{ $p->stok }}" @endisset
                                                    required class="qty-input"
                                                    data-harga="{{ $p->harga ?? 0 }}"
                                                    data-total-id="total-cart-{{ $p->id }}"
                                                    onchange="updateTotal(this)">
                                                <button type="button" class="qty-btn" onclick="changeQtyCart('jumlah-{{ $p->id }}', 1)">+</button>
                                            </div>
                                            @isset($p->harga)
                                            <p class="qty-total" id="total-cart-{{ $p->id }}">
                                                Total: <strong>Rp {{ number_format($p->harga, 0, ',', '.') }}</strong>
                                            </p>
                                            @endisset
                                        </div>
                                        <div class="modal-footer-btns">
                                            <button type="button" class="btn-cancel" onclick="closeModalKeranjang('{{ $p->id }}')">Batal</button>
                                            <button type="submit" class="btn-confirm btn-confirm-cart">🧺 Tambah ke Keranjang</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endif

                        @empty
                        {{-- Placeholder jika tidak ada produk --}}
                        @for ($i = 0; $i < 6; $i++)
                        <div class="product-card" style="--card-delay: {{ $i * 0.08 }}s">
                            <div class="card-image-wrap">
                                <div class="card-img-placeholder"><span>🔧</span></div>
                            </div>
                            <div class="card-body">
                                <span class="card-jenis">Jenis</span>
                                <span class="card-tipe">Tipe</span>
                                <h4 class="card-title">Produk {{ $i + 1 }}</h4>
                                <p class="card-price">Rp 0</p>
                            </div>
                        </div>
                        @endfor
                        @endforelse
                    @else
                        @for ($i = 0; $i < 6; $i++)
                        <div class="product-card" style="--card-delay: {{ $i * 0.08 }}s">
                            <div class="card-image-wrap">
                                <div class="card-img-placeholder"><span>🔧</span></div>
                            </div>
                            <div class="card-body">
                                <span class="card-jenis">Jenis</span>
                                <span class="card-tipe">Tipe</span>
                                <h4 class="card-title">Produk {{ $i + 1 }}</h4>
                                <p class="card-price">Rp 0</p>
                            </div>
                        </div>
                        @endfor
                    @endisset
                </div>
            </div>

        </div>
    </section>

    <!-- ============================================================
         FOOTER
    ============================================================ -->
    <footer class="footer" id="footer">
        <div class="footer-top">
            <div class="container">
                <div class="footer-grid">
                    <!-- Brand -->
                    <div class="footer-brand">
                        <a href="#home" class="footer-logo-link">
                            <img src="{{'assets/img/logo.png' }}" alt="AutoPart Original Logo" class="footer-logo-img">
                        </a>
                        <p class="footer-tagline">Lorem ipsum dolor sit amet consectetur adipisicing elit. Solusi spare part original terpercaya.</p>
                        <div class="footer-socials">
                            <a href="#" class="social-link" aria-label="Instagram">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="2" y="2" width="20" height="20" rx="5" ry="5"/>
                                    <circle cx="12" cy="12" r="4"/>
                                    <circle cx="17.5" cy="6.5" r="1" fill="currentColor" stroke="none"/>
                                </svg>
                            </a>
                            <a href="#" class="social-link" aria-label="Facebook">
                                <svg viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>
                                </svg>
                            </a>
                            <a href="#" class="social-link" aria-label="WhatsApp">
                                <svg viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/>
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- Navigasi -->
                    <div class="footer-col">
                        <h5 class="footer-col-title">Navigasi</h5>
                        <ul class="footer-links">
                            <li><a href="#home">Home</a></li>
                            <li><a href="#about">About</a></li>
                            <li><a href="#product">Product</a></li>
                            <li><a href="/login">Login</a></li>
                            <li><a href="/register">Register</a></li>
                        </ul>
                    </div>

                    <!-- Layanan -->
                    <div class="footer-col">
                        <h5 class="footer-col-title">Layanan</h5>
                        <ul class="footer-links">
                            <li><a href="#">Spare Part Jepang</a></li>
                            <li><a href="#">Spare Part Eropa</a></li>
                            <li><a href="#">Spare Part Amerika</a></li>
                            <li><a href="#">Konsultasi Kendaraan</a></li>
                            <li><a href="#">Pengiriman Ekspres</a></li>
                        </ul>
                    </div>

                    <!-- Kontak -->
                    <div class="footer-col">
                        <h5 class="footer-col-title">Kontak</h5>
                        <ul class="footer-contact">
                            <li>
                                <span class="contact-icon">📧</span>
                                <a href="mailto:hello@autopartoriginal.id">hello@autopartoriginal.id</a>
                            </li>
                            <li>
                                <span class="contact-icon">📱</span>
                                <a href="https://wa.me/6281234567890">+62 812-3456-7890</a>
                            </li>
                            <li>
                                <span class="contact-icon">📍</span>
                                <span>Jakarta, Indonesia</span>
                            </li>
                            <li>
                                <span class="contact-icon">🕐</span>
                                <span>Senin–Jumat, 09.00–17.00</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="container">
                <p>© 2026 AutoPart Original. All rights reserved.</p>
                <div class="footer-bottom-links">
                    <a href="#">Kebijakan Privasi</a>
                    <span>·</span>
                    <a href="#">Syarat &amp; Ketentuan</a>
                    <span>·</span>
                    <a href="#">Sitemap</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        window.APP = {
            isAuth: {{ Auth::check() ? 'true' : 'false' }},
            userName: "{{ Auth::check() ? Auth::user()->name : '' }}"
        };
    </script>
    <script src="{{ asset('assets/js/script.js') }}"></script>
</body>
</html>
