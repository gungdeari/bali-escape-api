<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TravelPackageImage extends Model
{
    protected $fillable = [
        'travel_package_id',
        'image_path',
        'is_primary',
        'sort_order'
    ];

    public function travelPackage(): BelongsTo
    {
        return $this->belongsTo(TravelPackage::class);
    }
}
