<?php

namespace App\Services;

use App\Repositories\TravelPackageRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TravelPackageService
{
    protected TravelPackageRepository $travelPackageRepository;

    public function __construct(TravelPackageRepository $travelPackageRepository)
    {
        $this->travelPackageRepository = $travelPackageRepository;
    }

    public function getAll(array $fields)
    {
        return $this->travelPackageRepository->getAll($fields, ['destination', 'images']);
    }

    public function getById(int $id)
    {
        return $this->travelPackageRepository->getById($id);
    }

    public function create(array $fields)
    {
        DB::beginTransaction();

        try {
            // handle slug
            $fields['slug'] = $this->generateSlug($fields['title']);

            // create package
            $package = $this->travelPackageRepository->create($fields);

            // handle images (optional)
            if (isset($fields['images'])) {
                $this->handleImages($package->id, $fields);
            }

            DB::commit();

            return $this->travelPackageRepository->getById(
                $package->id,
                ['destination', 'images']
            );

        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function update(int $id, array $fields)
    {
        DB::beginTransaction();

        try {
            if (isset($fields['title'])) {
                $fields['slug'] = $this->generateSlug($fields['title'], $id);
            }

            $package = $this->travelPackageRepository->update($id, $fields);

            if (isset($fields['images'])) {
                $this->handleImages($package->id, $fields);
            }

            DB::commit();

            return $this->travelPackageRepository->getById($package->id, []);

        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function delete(int $id)
    {
        return $this->travelPackageRepository->delete($id);
    }

    private function generateSlug(string $title, ?int $id = null): string
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $count = 1;

        while (
            $id
                ? $this->travelPackageRepository->slugExistsExcept($slug, $id)
                : $this->travelPackageRepository->slugExists($slug)
        ) {
            $slug = $originalSlug . '-' . $count++;
        }

        return $slug;
    }

    private function handleImages(int $packageId, array $fields): void
    {
        $imagesData = [];

        foreach ($fields['images'] as $index => $image) {

            // kalau dari request → file
            if (is_object($image)) {
                $path = $image->store('travel-packages', 'public');
            } else {
                $path = $image; 
            }

            $imagesData[] = [
                'path' => $path,
                'is_primary' => $index == ($fields['primary_index'] ?? 0)
            ];
        }

        $this->travelPackageRepository->createImages($packageId, $imagesData);
    }
}