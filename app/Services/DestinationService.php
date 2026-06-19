<?php

namespace App\Services;

use App\Repositories\DestinationRepository;
use Illuminate\Support\Str;

class DestinationService
{
    protected DestinationRepository $destinationRepository;

    public function __construct(DestinationRepository $destinationRepository)
    {
        $this->destinationRepository = $destinationRepository;
    }

    public function getAll(array $fields)
    {
        return $this->destinationRepository->getAll($fields);
    }

    public function getById(int $id, array $fields)
    {
        return $this->destinationRepository->getById($id, $fields);
    }  

    public function create(array $fields)
    {
        $slug = Str::slug($fields['name']);
        $originalSlug = $slug;
        $count = 1;
    
        while ($this->destinationRepository->slugExists($slug)) {
            $slug = $originalSlug . '-' . $count++;
        }
    
        $fields['slug'] = $slug;
    
        $destination = $this->destinationRepository->create($fields);
    
        return $this->destinationRepository->getById($destination->id, ['*']);
    }

    public function update(int $id, array $fields)
    {
        if (isset($fields['name'])) {
            $slug = Str::slug($fields['name']);
            $originalSlug = $slug;
            $count = 1;
    
            while ($this->destinationRepository->slugExistsExcept($slug, $id)) {
                $slug = $originalSlug . '-' . $count++;
            }
    
            $fields['slug'] = $slug;
        }
    
        return $this->destinationRepository->update($id, $fields);
    }

    public function delete($id)
    {
        return $this->destinationRepository->delete($id);
    }
}