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
}
