<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    public function index(Request $request)
    {
        $keyword  = trim((string) $request->query('q', ''));
        $category = trim((string) $request->query('category', ''));
        $isFiltered = $keyword !== '' || $category !== '';

        $recipes = Recipe::query()
            ->when($category !== '', fn ($q) => $q->where('category', $category))
            ->when($keyword !== '', function ($q) use ($keyword) {
                $q->where(function ($sub) use ($keyword) {
                    $sub->where('name', 'like', "%{$keyword}%")
                        ->orWhere('ingredients', 'like', "%{$keyword}%");
                });
            })
            ->orderBy('id')
            ->get();

        $categories = Recipe::query()
            ->selectRaw('category, COUNT(*) as total')
            ->groupBy('category')
            ->orderBy('category')
            ->pluck('total', 'category');

        $featured = $isFiltered ? collect() : Recipe::orderBy('id')->take(3)->get();

        return view('recipes.index', [
            'recipes'    => $recipes,
            'categories' => $categories,
            'featured'   => $featured,
            'keyword'    => $keyword,
            'category'   => $category,
            'isFiltered' => $isFiltered,
            'totalAll'   => Recipe::count(),
        ]);
    }

    public function show(Recipe $recipe)
    {
        $related = Recipe::query()
            ->where('id', '!=', $recipe->id)
            ->where('category', $recipe->category)
            ->inRandomOrder()
            ->take(3)
            ->get();

        if ($related->count() < 3) {
            $more = Recipe::query()
                ->where('id', '!=', $recipe->id)
                ->whereNotIn('id', $related->pluck('id'))
                ->inRandomOrder()
                ->take(3 - $related->count())
                ->get();
            $related = $related->concat($more);
        }

        return view('recipes.show', [
            'recipe'  => $recipe,
            'related' => $related,
        ]);
    }
}
