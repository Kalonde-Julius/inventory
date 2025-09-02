<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    //
    protected $fillable = [
        'name',
        'email',
        'contact',
        'data'
    ];

    Public function users() {
        return $this->belongsToMany(User::class);
    }

    Public function customers() {
        return $this->hasMany(Customer::class);
    }

    Public function providers() {
        return $this->hasMany(Provider::class);
    }

    Public function products() {
        return $this->hasMany(Product::class);
    }

    Public function categories() {
        return $this->hasMany(Category::class);
    }

    Public function units() {
        return $this->hasMany(Unit::class);
    }

   /* protected $casts = [
        'data' => 'json'
    ];
    */


}
