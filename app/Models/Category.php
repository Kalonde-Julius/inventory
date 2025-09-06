<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    protected $casts = [
        'data' => 'json'
    ];

    public function tenant() {
        return $this->belongsTo(Tenant::class);
    }

    public function products()
{
    return $this->hasMany(Product::class);
}
    public function units()
{
    return $this->hasMany(Unit::class);

}


}
