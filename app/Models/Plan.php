<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'plan_category_id',
        'title',
        'ordering',
        'has_badge',
        'minimum',
        'maximum',
        'percentage',
        'referral_percentage',
        'duration_type',
        'profit_frequency',
        'duration',
        'status',
    ];

    public function plan_category()
    {
        return $this->belongsTo(PlanCategory::class);
    }
}
