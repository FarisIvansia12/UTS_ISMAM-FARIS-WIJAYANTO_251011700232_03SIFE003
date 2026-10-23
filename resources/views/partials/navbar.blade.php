<nav class="navbar navbar-expand-lg site-nav sticky-top">
    <div class="container">
        <a class="navbar-brand brand" href="{{ route('recipes.index') }}">
            <span class="brand-mark"><i class="bi bi-egg-fried"></i></span>
            <span class="brand-text">Dapur <em>Nusantara</em></span>
        </a>

        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse"
                data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Buka menu">
            <i class="bi bi-list fs-2"></i>
        </button>

        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav me-auto ms-lg-4 mb-3 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('recipes.index') && !request()->filled('category') && !request()->filled('q') ? 'active' : '' }}"
                       data-nav-section="beranda"
                       href="{{ route('recipes.index') }}">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-nav-section="kategori"
                       href="{{ route('recipes.index') }}#kategori">Kategori</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('recipes.show') || request()->filled('category') || request()->filled('q') ? 'active' : '' }}"
                       data-nav-section="semua-resep"
                       href="{{ route('recipes.index') }}#semua-resep">Semua Resep</a>
                </li>
            </ul>

            <form class="nav-search" action="{{ route('recipes.index') }}#semua-resep" method="GET" role="search">
                <i class="bi bi-search"></i>
                <input type="search" name="q" value="{{ request('q') }}" placeholder="Cari resep atau bahan..."
                       aria-label="Cari resep">
                <button type="submit" class="btn btn-outline-green btn-sm">Cari</button>
            </form>
        </div>
    </div>
</nav>
