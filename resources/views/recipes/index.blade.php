@extends('layouts.app')

@section('title', 'Portal Resep Masakan')

@section('content')

{{-- HERO --}}
@unless ($isFiltered)
<section class="hero">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <span class="eyebrow"><i class="bi bi-fire"></i> Resep rumahan Nusantara</span>
                <h1 class="hero-title">Masak enak dimulai dari <span>resep yang jelas.</span></h1>
                <p class="hero-lead">
                    {{ $totalAll }} resep pilihan dari nasi goreng sampai rendang, lengkap dengan daftar bahan,
                    langkah memasak, dan estimasi waktu.
                </p>
                <div class="d-flex flex-wrap gap-2">
                    <a href="#semua-resep" class="btn btn-terracotta btn-lg">Jelajahi resep</a>
                    <a href="#kategori" class="btn btn-outline-green btn-lg">Lihat kategori</a>
                </div>
            </div>
            <div class="col-lg-6">
                @php $heroMain = $featured->get(0); $heroA = $featured->get(1); $heroB = $featured->get(2); @endphp
                <div class="hero-visual">
                    @if ($heroMain)
                        <a href="{{ route('recipes.show', $heroMain) }}" class="hero-main">
                            <img src="{{ $heroMain->image_url }}" alt="{{ $heroMain->name }}" data-fallback>
                            <span class="hero-tag">{{ $heroMain->name }} <small>{{ $heroMain->cook_time_label }}</small></span>
                        </a>
                    @endif
                    @if ($heroA)
                        <a href="{{ route('recipes.show', $heroA) }}" class="hero-float hero-float-a">
                            <img src="{{ $heroA->image_url }}" alt="{{ $heroA->name }}" data-fallback>
                        </a>
                    @endif
                    @if ($heroB)
                        <a href="{{ route('recipes.show', $heroB) }}" class="hero-float hero-float-b">
                            <img src="{{ $heroB->image_url }}" alt="{{ $heroB->name }}" data-fallback>
                        </a>
                    @endif
                    <div class="hero-badge">
                        <strong>{{ $totalAll }}</strong>
                        <span>resep<br>tersedia</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- KATEGORI --}}
<section class="section section-green" id="kategori">
    <div class="container">
        <div class="section-head section-head-light">
            <span class="eyebrow eyebrow-light">Kategori</span>
            <h2>Mau masak apa hari ini?</h2>
        </div>
        <div class="row g-3">
            @foreach ($categories as $name => $total)
                @php $meta = \App\Models\Recipe::CATEGORY_META[$name] ?? ['icon' => 'bi-tags', 'tone' => 'saffron']; @endphp
                <div class="col-6 col-md-4 col-lg-2">
                    <a class="category-tile tone-{{ $meta['tone'] }}"
                       href="{{ route('recipes.index', ['category' => $name]) }}#semua-resep">
                        <i class="bi {{ $meta['icon'] }}"></i>
                        <strong>{{ $name }}</strong>
                        <span>{{ $total }} resep</span>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- PILIHAN EDITOR --}}
@if ($featured->count() === 3)
<section class="section">
    <div class="container">
        <div class="section-head">
            <span class="eyebrow">Pilihan editor</span>
            <h2>Hidangan yang paling sering dimasak</h2>
        </div>
        <div class="row g-4">
            <div class="col-lg-7">
                @php $f = $featured[0]; @endphp
                <a href="{{ route('recipes.show', $f) }}" class="feature-big">
                    <img src="{{ $f->image_url }}" alt="{{ $f->name }}" data-fallback>
                    <div class="feature-overlay">
                        <span class="chip chip-{{ $f->category_tone }}"><i class="bi {{ $f->category_icon }}"></i> {{ $f->category }}</span>
                        <h3>{{ $f->name }}</h3>
                        <p><i class="bi bi-clock"></i> {{ $f->cook_time_label }} &middot; {{ count($f->ingredient_list) }} bahan</p>
                    </div>
                </a>
            </div>
            <div class="col-lg-5 d-flex flex-column gap-4">
                @foreach ($featured->slice(1) as $f)
                    <a href="{{ route('recipes.show', $f) }}" class="feature-row">
                        <img src="{{ $f->image_url }}" alt="{{ $f->name }}" data-fallback>
                        <div>
                            <span class="chip chip-{{ $f->category_tone }}"><i class="bi {{ $f->category_icon }}"></i> {{ $f->category }}</span>
                            <h3>{{ $f->name }}</h3>
                            <p><i class="bi bi-clock"></i> {{ $f->cook_time_label }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endif
@endunless

{{-- SEMUA RESEP --}}
<section class="section {{ $isFiltered ? 'section-top-pad' : 'section-cream' }}" id="semua-resep">
    <div class="container">
        <div class="section-head">
            <span class="eyebrow">{{ $isFiltered ? 'Hasil penelusuran' : 'Koleksi lengkap' }}</span>
            <h2>
                @if ($category !== '' && $keyword === '') {{ $category }}
                @elseif ($keyword !== '') Hasil untuk &ldquo;{{ $keyword }}&rdquo;
                @else Semua resep
                @endif
            </h2>
        </div>

        <div class="dropdown filter-dropdown mb-3">
            <button class="btn btn-outline-green dropdown-toggle" type="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-funnel"></i>
                {{ $category !== '' ? $category : 'Filter kategori' }}
            </button>
            <div class="dropdown-menu">
                <a href="{{ route('recipes.index', array_filter(['q' => $keyword])) }}#semua-resep"
                   class="dropdown-item {{ $category === '' ? 'active' : '' }}">
                    Semua kategori <span class="badge rounded-pill text-bg-light">{{ $totalAll }}</span>
                </a>
                @foreach ($categories as $name => $total)
                    <a href="{{ route('recipes.index', array_filter(['category' => $name, 'q' => $keyword])) }}#semua-resep"
                       class="dropdown-item {{ $category === $name ? 'active' : '' }}">
                        {{ $name }} <span class="badge rounded-pill text-bg-light">{{ $total }}</span>
                    </a>
                @endforeach
            </div>
        </div>

        <p class="result-count">Menampilkan {{ $recipes->count() }} dari {{ $totalAll }} resep</p>

        @if ($recipes->isEmpty())
            <div class="empty-state">
                <i class="bi bi-search"></i>
                <h3>Resep tidak ditemukan</h3>
                <p>Coba kata kunci lain atau tampilkan semua resep.</p>
                <a href="{{ route('recipes.index') }}" class="btn btn-terracotta">Tampilkan semua resep</a>
            </div>
        @else
            <div class="row g-4">
                @foreach ($recipes as $recipe)
                    <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                        @include('partials.recipe-card', ['recipe' => $recipe])
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

@endsection
