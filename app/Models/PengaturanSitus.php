<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengaturanSitus extends Model
{
    use HasFactory;

    protected $table = 'pengaturan_situs';
    protected $guarded = ['id'];

    public static function getValue(string $key, ?string $default = null): ?string
    {
        $setting = static::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }
}
