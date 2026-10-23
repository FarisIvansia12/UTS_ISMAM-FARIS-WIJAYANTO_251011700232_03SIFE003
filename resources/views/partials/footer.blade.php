<footer class="site-footer">
    <div class="container">
        <div class="row g-4 align-items-start">
            <div class="col-lg-5">
                <a class="brand brand-light" href="{{ route('recipes.index') }}">
                    <span class="brand-mark"><i class="bi bi-egg-fried"></i></span>
                    <span class="brand-text">Dapur <em>Nusantara</em></span>
                </a>
                <p class="footer-about mt-3">
                    Kumpulan resep masakan Indonesia yang ditulis lengkap, dari bahan sampai langkah,
                    supaya masakan rumah terasa seperti masakan warung.
                </p>
            </div>
            <div class="col-6 col-lg-3 offset-lg-1">
                <h6 class="footer-title">Jelajahi</h6>
                <ul class="list-unstyled footer-links">
                    <li><a href="{{ route('recipes.index') }}">Beranda</a></li>
                    <li><a href="{{ route('recipes.index') }}#kategori">Kategori</a></li>
                    <li><a href="{{ route('recipes.index') }}#semua-resep">Semua resep</a></li>
                </ul>
            </div>
            <div class="col-6 col-lg-3">
                <h6 class="footer-title">Kategori</h6>
                <ul class="list-unstyled footer-links">
                    @foreach (\App\Models\Recipe::CATEGORY_META as $name => $meta)
                        <li><a href="{{ route('recipes.index', ['category' => $name]) }}#semua-resep">{{ $name }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <span>&copy; {{ date('Y') }} Dapur Nusantara</span>
            <span>Ismam Faris Wijayanto &middot; 251011700232 &middot; UTS Laravel</span>
        </div>
    </div>
</footer>
