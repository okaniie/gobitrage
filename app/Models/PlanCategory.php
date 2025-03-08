<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'ordering',
        'title',
        'description',
    ];

    public function plans()
    {
        return $this->hasMany(Plan::class);
    }
}
