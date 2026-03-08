/* ============================================================
   AUTOPART ORIGINAL — script.js
============================================================ */

(function () {
    'use strict';

    /* ========================================================
       1. NAVBAR — Scroll Effect & Active Link
    ======================================================== */
    const navbar = document.getElementById('navbar');
    const navLinks = document.querySelectorAll('.nav-link');

    // Scroll shrink
    window.addEventListener('scroll', () => {
        if (window.scrollY > 40) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }

        // Active link based on scroll position
        highlightActiveLink();
    }, { passive: true });

    function highlightActiveLink() {
        const sections = ['home', 'about', 'product'];
        let currentSection = 'home';

        sections.forEach(id => {
            const el = document.getElementById(id);
            if (!el) return;
            const rect = el.getBoundingClientRect();
            if (rect.top <= 100) {
                currentSection = id;
            }
        });

        navLinks.forEach(link => {
            const section = link.getAttribute('data-section');
            if (section === currentSection) {
                link.classList.add('active');
            } else {
                link.classList.remove('active');
            }
        });
    }

    /* ========================================================
       2. HAMBURGER MENU (Mobile)
    ======================================================== */
    const hamburger = document.getElementById('hamburger');
    const navLinksEl = document.getElementById('navLinks');

    if (hamburger && navLinksEl) {
        hamburger.addEventListener('click', () => {
            hamburger.classList.toggle('open');
            navLinksEl.classList.toggle('open');
        });

        // Close on link click
        navLinksEl.querySelectorAll('a').forEach(a => {
            a.addEventListener('click', () => {
                hamburger.classList.remove('open');
                navLinksEl.classList.remove('open');
            });
        });
    }

    /* ========================================================
       3. GREETING — Selamat Pagi/Siang/Sore/Malam
    ======================================================== */
    const greetingEl = document.getElementById('greetingTime');
    if (greetingEl) {
        const hour = new Date().getHours();
        let greet = '';
        if (hour >= 5 && hour < 11)       greet = 'Selamat Pagi,';
        else if (hour >= 11 && hour < 15)  greet = 'Selamat Siang,';
        else if (hour >= 15 && hour < 18)  greet = 'Selamat Sore,';
        else                               greet = 'Selamat Malam,';
        greetingEl.textContent = greet;
    }

    /* ========================================================
       4. BRAND FILTER — Filter produk berdasarkan jenis
    ======================================================== */
    window.filterByJenis = function (jenis, btn) {
        // Update active button
        document.querySelectorAll('.brand-card').forEach(b => b.classList.remove('active'));
        if (btn) btn.classList.add('active');

        // Update section title
        const titleEl = document.getElementById('sparepartTitle');
        if (titleEl) titleEl.textContent = 'SPAREPART — ' + jenis.toUpperCase();

        // Filter cards
        const cards = document.querySelectorAll('#productGrid .product-card');
        let visibleCount = 0;

        cards.forEach(card => {
            const cardJenis = card.getAttribute('data-jenis') || '';
            const match = cardJenis.toLowerCase() === jenis.toLowerCase();
            if (match) {
                card.classList.remove('hidden');
                card.style.animationDelay = (visibleCount * 0.08) + 's';
                // Restart animation
                card.style.animation = 'none';
                card.offsetHeight; // reflow
                card.style.animation = '';
                visibleCount++;
            } else {
                card.classList.add('hidden');
            }
        });

        // If nothing found, show all
        if (visibleCount === 0) {
            cards.forEach(card => card.classList.remove('hidden'));
        }

        // Scroll to product section
        const section = document.getElementById('sparepart-section');
        if (section) {
            section.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    };

    /* ========================================================
       5. SEARCH — Filter produk by name/tipe
    ======================================================== */
    window.doSearch = function () {
        const query = (document.getElementById('searchInput')?.value || '').toLowerCase().trim();
        const cards = document.querySelectorAll('#productGrid .product-card');

        if (!query) {
            cards.forEach(card => card.classList.remove('hidden'));
            return;
        }

        // Deactivate brand filters
        document.querySelectorAll('.brand-card').forEach(b => b.classList.remove('active'));

        let count = 0;
        cards.forEach(card => {
            const title = card.querySelector('.card-title')?.textContent.toLowerCase() || '';
            const jenis = card.getAttribute('data-jenis')?.toLowerCase() || '';
            const tipe  = card.querySelector('.card-tipe')?.textContent.toLowerCase() || '';
            const match = title.includes(query) || jenis.includes(query) || tipe.includes(query);
            if (match) {
                card.classList.remove('hidden');
                count++;
            } else {
                card.classList.add('hidden');
            }
        });

        // Update title
        const titleEl = document.getElementById('sparepartTitle');
        if (titleEl) {
            titleEl.textContent = count > 0
                ? `HASIL PENCARIAN: "${query.toUpperCase()}" (${count})`
                : `TIDAK DITEMUKAN: "${query.toUpperCase()}"`;
        }
    };

    // Search on Enter key
    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.addEventListener('keydown', function (e) {
            if (e.key === 'Enter') doSearch();
        });
    }

    /* ========================================================
       6. MODAL BELI
    ======================================================== */
    window.openModalBeli = function (kode) {
        const modal = document.getElementById('modal-beli-' + kode);
        if (modal) {
            modal.classList.add('open');
            document.body.style.overflow = 'hidden';
        }
    };

    window.closeModalBeli = function (kode) {
        const modal = document.getElementById('modal-beli-' + kode);
        if (modal) {
            modal.classList.remove('open');
            document.body.style.overflow = '';
        }
    };

    window.closeModalBeliIfOverlay = function (event, overlay) {
        if (event.target === overlay) {
            overlay.classList.remove('open');
            document.body.style.overflow = '';
        }
    };

    /* ========================================================
       7. MODAL KERANJANG
    ======================================================== */
    window.openModalKeranjang = function (id) {
        const modal = document.getElementById('modal-keranjang-' + id);
        if (modal) {
            modal.classList.add('open');
            document.body.style.overflow = 'hidden';
        }
    };

    window.closeModalKeranjang = function (id) {
        const modal = document.getElementById('modal-keranjang-' + id);
        if (modal) {
            modal.classList.remove('open');
            document.body.style.overflow = '';
        }
    };

    window.closeModalKeranjangIfOverlay = function (event, overlay) {
        if (event.target === overlay) {
            overlay.classList.remove('open');
            document.body.style.overflow = '';
        }
    };

    // Close modal on Escape key
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            document.querySelectorAll('.modal-overlay.open').forEach(m => {
                m.classList.remove('open');
            });
            document.body.style.overflow = '';
        }
    });

    /* ========================================================
       8. QTY — Update jumlah & hitung total
    ======================================================== */
    window.changeQty = function (inputId, delta) {
        const input = document.getElementById(inputId);
        if (!input) return;
        let val = parseInt(input.value) || 1;
        val += delta;
        const min = parseInt(input.min) || 1;
        const max = parseInt(input.max) || 9999;
        val = Math.max(min, Math.min(max, val));
        input.value = val;
        recalcTotal(input);
    };

    window.changeQtyCart = function (inputId, delta) {
        window.changeQty(inputId, delta);
    };

    window.updateTotal = function (input) {
        recalcTotal(input);
    };

    function recalcTotal(input) {
        const harga     = parseInt(input.getAttribute('data-harga')) || 0;
        const totalId   = input.getAttribute('data-total-id');
        const qty       = parseInt(input.value) || 1;

        if (!totalId || !harga) return;

        const totalEl = document.getElementById(totalId);
        if (totalEl) {
            const total = harga * qty;
            totalEl.innerHTML = 'Total: <strong>Rp ' + formatNumber(total) + '</strong>';
        }
    }

    function formatNumber(n) {
        return n.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    }

    /* ========================================================
       9. INIT — Run on first load
    ======================================================== */
    document.addEventListener('DOMContentLoaded', function () {
        // Trigger active brand filter on first brand card if data-jenis exists
        const firstBrand = document.querySelector('.brand-card.active');
        if (firstBrand) {
            const jenis = firstBrand.getAttribute('data-jenis');
            if (jenis) filterByJenis(jenis, firstBrand);
        }

        // Set greeting on load
        const greetEl = document.getElementById('greetingTime');
        if (greetEl) {
            const hour = new Date().getHours();
            let greet = '';
            if (hour >= 5 && hour < 11)       greet = 'Selamat Pagi,';
            else if (hour >= 11 && hour < 15)  greet = 'Selamat Siang,';
            else if (hour >= 15 && hour < 18)  greet = 'Selamat Sore,';
            else                               greet = 'Selamat Malam,';
            greetEl.textContent = greet;
        }
    });

})();
