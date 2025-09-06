<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $guarded = [];

    protected $casts = [
        'data' => 'json'
    ];

    public function tenant() {
        return $this->belongsTo(Tenant::class);
    }

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function category() {
        return $this->hasMany(Category::class);
    }

    public function unit() {
        return $this->hasMany(Unit::class);
    }

    // Purchase has many products
    public function products() {
        return $this->hasMany(PurchaseProduct::class);
    }

    // Purchase belongs to a provider
    public function provider() {
        return $this->belongsTo(Provider::class);
    }

}
