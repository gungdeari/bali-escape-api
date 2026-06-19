<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class TravelPackage extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'destination_id',
        'title',
        'slug',
        'description',
        'price',
        'duration_days',
        'max_people',
        'difficulty_level',
        'is_active'
    ];

    public function destination(): BelongsTo
    {
        return $this->belongsTo(Destination::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(TravelPackageImage::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    // public function wishlists(): HasMany
    // {
    //     return $this->hasMany(Wishlist::class);
    // }
}
