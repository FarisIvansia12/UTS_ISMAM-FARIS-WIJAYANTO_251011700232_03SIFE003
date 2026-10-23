@extends('layouts.app')

@section('title', $recipe->name)
@section('description', 'Resep ' . $recipe->name . ': ' . count($recipe->ingredient_list) . ' bahan, ' . $recipe->cook_time_label . '.')

@section('content')

<section class="detail-hero">
    <div class="container">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('recipes.index') }}">Beranda</a></li>
                <li class="breadcrumb-item">
                    <a href="{{ route('recipes.index', ['category' => $recipe->category]) }}#semua-resep">{{ $recipe->category }}</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{ $recipe->name }}</li>
            </ol>
        </nav>

        <div class="row g-5 align-items-center">
            <div class="col-lg-6 order-lg-2">
                <div class="detail-photo">
                    <img src="{{ $recipe->image_url }}" alt="{{ $recipe->name }}" data-fallback>
                </div>
            </div>
            <div class="col-lg-6 order-lg-1">
                <span class="chip chip-{{ $recipe->category_tone }} chip-lg">
                    <i class="bi {{ $recipe->category_icon }}"></i> {{ $recipe->category }}
                </span>
                <h1 class="detail-title">{{ $recipe->name }}</h1>

                <div class="stat-row">
                    <div class="stat">
                        <i class="bi bi-stopwatch"></i>
                        <div><small>Waktu memasak</small><strong>{{ $recipe->cook_time_label }}</strong></div>
                    </div>
                    <div class="stat">
                        <i class="bi bi-basket2"></i>
                        <div><small>Bahan</small><strong>{{ count($recipe->ingredient_list) }} macam</strong></div>
                    </div>
                    <div class="stat">
                        <i class="bi bi-list-check"></i>
                        <div><small>Langkah</small><strong>{{ count($recipe->step_list) }} tahap</strong></div>
                    </div>
                </div>

                <div class="d-flex flex-wrap gap-2 mt-4">
                    <a href="#langkah" class="btn btn-terracotta">Mulai memasak</a>
                    <a href="{{ route('recipes.index') }}#semua-resep" class="btn btn-outline-green">
                        <i class="bi bi-arrow-left"></i> Kembali ke daftar resep
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="row g-4 g-lg-5">
            <div class="col-lg-5">
                <aside class="ingredients-card">
                    <h2><i class="bi bi-basket2"></i> Bahan-bahan</h2>
                    <p class="hint">Centang bahan yang sudah siap.</p>
                    <ul class="list-unstyled ingredient-list">
                        @foreach ($recipe->ingredient_list as $i => $item)
                            <li>
                                <input class="form-check-input" type="checkbox" id="ing-{{ $i }}">
                                <label for="ing-{{ $i }}">{{ $item }}</label>
                            </li>
                        @endforeach
                    </ul>
                </aside>
            </div>
            <div class="col-lg-7" id="langkah">
                <h2 class="steps-title">Langkah memasak</h2>
                <ol class="list-unstyled steps-list">
                    @foreach ($recipe->step_list as $i => $step)
                        <li>
                            <span class="step-no">{{ $i + 1 }}</span>
                            <p>{{ $step }}</p>
                        </li>
                    @endforeach
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="section section-cream">
    <div class="container">
        <div class="section-head">
            <span class="eyebrow">Rekomendasi</span>
            <h2>Resep lain yang mungkin Anda suka</h2>
        </div>
        <div class="row g-4">
            @foreach ($related as $item)
                <div class="col-12 col-sm-6 col-lg-4">
                    @include('partials.recipe-card', ['recipe' => $item])
                </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
