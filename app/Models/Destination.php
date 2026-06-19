<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Destination extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'address',
        'city',
        'description',
        'is_active'
    ];

    public function travelPackages(): HasMany
    {
        return $this->hasMany(TravelPackage::class);
    }
}
