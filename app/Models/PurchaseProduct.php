<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseProduct extends Model
{
        protected $guarded = [];

    protected $casts = [
        'data' => 'json'
    ];

    public function tenant() {
        return $this->belongsTo(Tenant::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function unit() {
        return $this->hasMany(Unit::class);
    }
    public function purchases() {
        return $this->hasMany(PurchaseProduct::class);
    }
    public function providers() {
        return $this->belongsToMany(Provider::class, 'purchase_products', 'product_id', 'provider_id');
    }

    public function products(){
    return $this->hasMany(Product::class);
}
}
