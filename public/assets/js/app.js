// Fallback gambar: jika file gambar gagal dimuat, tampilkan placeholder lokal.
document.querySelectorAll('img[data-fallback]').forEach(function (img) {
    var base = img.src.split('/assets/images/')[0];
    var placeholder = base + '/assets/images/placeholder.svg';

    function useFallback() {
        if (img.src !== placeholder) {
            img.src = placeholder;
        }
    }

    img.addEventListener('error', useFallback);

    // Gambar yang sudah gagal dimuat sebelum script ini berjalan.
    if (img.complete && img.naturalWidth === 0) {
        useFallback();
    }
});

var navLinks = document.querySelectorAll('.site-nav [data-nav-section]');

function setActiveNav(section) {
    navLinks.forEach(function (link) {
        var isActive = link.dataset.navSection === section;
        link.classList.toggle('active', isActive);

        if (isActive) {
            link.setAttribute('aria-current', 'page');
        } else {
            link.removeAttribute('aria-current');
        }
    });
}

if (navLinks.length) {
    function currentSection() {
        var section = window.location.hash.slice(1);

        if (section === 'kategori' || section === 'semua-resep') {
            return section;
        }

        var activeLink = document.querySelector('.site-nav .nav-link.active');
        return activeLink ? activeLink.dataset.navSection : 'beranda';
    }

    setActiveNav(currentSection());

    navLinks.forEach(function (link) {
        link.addEventListener('click', function () {
            setActiveNav(link.dataset.navSection);

            var navMenu = document.getElementById('mainNav');
            if (navMenu && navMenu.classList.contains('show')) {
                window.bootstrap.Collapse.getOrCreateInstance(navMenu).hide();
            }
        });
    });

    window.addEventListener('hashchange', function () {
        setActiveNav(currentSection());
    });
}
