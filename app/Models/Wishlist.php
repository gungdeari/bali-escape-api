<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    protected $fillable = [
        'user_id',
        'travel_package_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // public function travelPackage()
    // {
    //     return $this->belongsTo(TravelPackage::class);
    // }
}
