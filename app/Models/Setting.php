<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = ['setting',  'value'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public static function get(string $key)
    {
        $setting = self::where('setting', $key)->get()->first();
        if ($setting) return $setting->value;
        return null;
    }

    public static function set(string $key, $value)
    {
        $setting = self::firstOrNew(['setting' => $key]);
        $setting->value = $value;
        $setting->save();
    }
}
