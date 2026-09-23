<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class PengaturanSitus extends Model
{
    use HasFactory;

    protected $table = 'pengaturan_situs';
    protected $guarded = ['id'];

    /**
     * Get a setting value with caching.
     * All settings are loaded in ONE query and cached for 1 hour.
     */
    public static function getValue(string $key, ?string $default = null): ?string
    {
        $settings = Cache::remember('pengaturan_situs_all', 3600, function () {
            return static::pluck('value', 'key')->toArray();
        });

        return $settings[$key] ?? $default;
    }

    /**
     * Clear the settings cache (call after create/update/delete).
     */
    public static function clearCache(): void
    {
        Cache::forget('pengaturan_situs_all');
    }

    protected static function booted(): void
    {
        static::saved(fn () => static::clearCache());
        static::deleted(fn () => static::clearCache());
    }
}
