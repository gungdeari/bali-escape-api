<?php

namespace App\Repositories;

use App\Models\TravelPackage;
use App\Models\TravelPackageImage;

class TravelPackageRepository
{
    public function getAll(array $fields, array $data = [])
    {
        return TravelPackage::select($fields)
            ->latest()
            ->with($data)
            ->withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->paginate(10);
    }

    public function getById(int $id)
    {
        return TravelPackage::with(['destination', 'images'])
            ->withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->findOrFail($id);
    }

    public function create(array $fields)
    {
        return TravelPackage::create($fields);
    }

    public function update($id, array $fields)
    {
        $package = TravelPackage::findOrFail($id);
        $package->update($fields);

        return $package;
    }

    public function delete($id)
    {
        return TravelPackage::findOrFail($id)->delete();
    }

    public function createImages($packageId, array $imagesData)
    {
        foreach ($imagesData as $image) {
            TravelPackageImage::create([
                'travel_package_id' => $packageId,
                'image_path' => $image['path'],
                'is_primary' => $image['is_primary']
            ]);
        }
    }

    public function slugExists(string $slug): bool
    {
        return TravelPackage::where('slug', $slug)
            ->exists();
    }

    public function slugExistsExcept(string $slug, int $id): bool
    {
        return TravelPackage::where('slug', $slug)
            ->where('id', '!=', $id)
            ->exists();
    }
}