<?php 

namespace App\Repositories;

use App\Models\Destination;

class DestinationRepository
{
    public function getAll(array $fields, array $data = [])
    {
        return Destination::select($fields)
            ->latest()
            ->with($data)
            ->withCount('travelPackages')
            ->paginate(10);
    }

    public function getById(int $id, array $fields = [])
    {
        return Destination::select($fields)
            ->findOrFail($id);
    }

    public function create(array $fields)
    {  
        return Destination::create($fields);
    }

    public function update($id, array $fields)
    {
        $destination = Destination::findOrFail($id);
        $destination->update($fields);
        
        return $destination;
    }

    public function delete($id)
    {
        return Destination::findOrFail($id)
            ->delete();
    }

    public function slugExists($slug)
    {
        return Destination::where('slug', $slug)
            ->exists();
    }

    public function slugExistsExcept($slug, $id)
    {
        return Destination::where('slug', $slug)
            ->where('id', '!=', $id)
            ->exists();
    }
}