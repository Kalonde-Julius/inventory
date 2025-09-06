<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $guarded = [];

    protected $casts = [
        'data' => 'json'
    ];

    public function tenant() {
        return $this->belongsTo(Tenant::class);
    }

    public function category() {
        return $this->hasMany(Category::class);
    }

    public function product() {
        return $this->hasMany(Product::class);
    }

}
