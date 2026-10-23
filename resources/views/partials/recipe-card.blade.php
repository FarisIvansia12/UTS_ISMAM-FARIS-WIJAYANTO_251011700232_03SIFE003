{{-- Kartu resep. Variabel: $recipe --}}
<article class="recipe-card h-100">
    <a class="recipe-card-media" href="{{ route('recipes.show', $recipe) }}" tabindex="-1" aria-hidden="true">
        <img src="{{ $recipe->image_url }}" alt="{{ $recipe->name }}" loading="lazy" data-fallback>
        <span class="chip chip-{{ $recipe->category_tone }}">
            <i class="bi {{ $recipe->category_icon }}"></i> {{ $recipe->category }}
        </span>
    </a>
    <div class="recipe-card-body">
        <h3 class="recipe-card-title">
            <a href="{{ route('recipes.show', $recipe) }}">{{ $recipe->name }}</a>
        </h3>
        <ul class="recipe-meta list-unstyled">
            <li><i class="bi bi-clock"></i> {{ $recipe->cook_time_label }}</li>
            <li><i class="bi bi-basket2"></i> {{ count($recipe->ingredient_list) }} bahan</li>
        </ul>
        <a href="{{ route('recipes.show', $recipe) }}" class="btn btn-terracotta btn-sm mt-auto">
            Lihat resep <i class="bi bi-arrow-right"></i>
        </a>
    </div>
</article>
