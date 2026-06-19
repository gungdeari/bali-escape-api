<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TravelPackageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'destination' => $this->whenLoaded('destination', function () {
                return $this->destination->name;
            }),
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'price' => $this->price,
            'duration_days' => $this->duration_days,
            'max_people'       => $this->max_people,       
            'difficulty_level' => $this->difficulty_level, 
            'images' => $this->whenLoaded('images', function () {
                return $this->images->map(fn($img) => [
                    'url' => str_starts_with($img->image_path, 'http')
                        ? $img->image_path
                        : asset('storage/' . $img->image_path),
                    'is_primary' => $img->is_primary
                ]);
            }),
            'created_at' => $this->created_at,
            'average_rating' => $this->reviews_avg_rating
                ? round($this->reviews_avg_rating, 1)
                : null,
            'total_reviews' => $this->reviews_count ?? 0,
        ];
    }
}
