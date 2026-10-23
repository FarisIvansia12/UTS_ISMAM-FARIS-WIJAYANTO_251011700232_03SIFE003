<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $table = 'recipes';

    protected $fillable = [
        'name',
        'ingredients',
        'steps',
        'cook_time',
        'image',
        'category',
    ];

    protected $casts = [
        'cook_time' => 'integer',
    ];

    /**
     * Metadata tampilan tiap kategori (ikon Bootstrap Icons dan kelas warna).
     */
    public const CATEGORY_META = [
        'Makanan Utama' => ['icon' => 'bi-egg-fried', 'tone' => 'saffron'],
        'Lauk Pauk'     => ['icon' => 'bi-fire',      'tone' => 'terracotta'],
        'Sup & Soto'    => ['icon' => 'bi-cup-hot',   'tone' => 'green'],
        'Sayur & Salad' => ['icon' => 'bi-flower1',   'tone' => 'leaf'],
        'Camilan'       => ['icon' => 'bi-cookie',    'tone' => 'brown'],
        'Minuman'       => ['icon' => 'bi-cup-straw', 'tone' => 'sky'],
    ];

    public function getCategoryIconAttribute(): string
    {
        return self::CATEGORY_META[$this->category]['icon'] ?? 'bi-tags';
    }

    public function getCategoryToneAttribute(): string
    {
        return self::CATEGORY_META[$this->category]['tone'] ?? 'saffron';
    }

    /** Daftar bahan (satu bahan per baris di database). */
    public function getIngredientListAttribute(): array
    {
        return $this->splitLines($this->ingredients);
    }

    /** Daftar langkah memasak (satu langkah per baris di database). */
    public function getStepListAttribute(): array
    {
        return $this->splitLines($this->steps);
    }

    /** Contoh: 25 => "25 menit", 90 => "1 jam 30 menit". */
    public function getCookTimeLabelAttribute(): string
    {
        $minutes = (int) $this->cook_time;
        $hours = intdiv($minutes, 60);
        $rest = $minutes % 60;

        if ($hours === 0) {
            return $minutes . ' menit';
        }

        return $hours . ' jam' . ($rest ? ' ' . $rest . ' menit' : '');
    }

    public function getImageUrlAttribute(): string
    {
        return asset('assets/images/' . $this->image);
    }

    private function splitLines(?string $text): array
    {
        return array_values(array_filter(
            array_map('trim', preg_split('/\R/', (string) $text)),
            fn ($line) => $line !== ''
        ));
    }
}
