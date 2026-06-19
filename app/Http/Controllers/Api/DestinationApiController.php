<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\DestinationService;
use App\Http\Resources\DestinationResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests\DestinationRequest;
use App\Helpers\ApiResponse;

class DestinationApiController extends Controller
{
    protected $destinationService;

    public function __construct(DestinationService $destinationService)
    {
        $this->destinationService = $destinationService;
    }

    public function index()
    {
        $fields = ['*'];
        $destinations = $this->destinationService->getAll($fields);
        return ApiResponse::paginated(
            $destinations,
            DestinationResource::collection($destinations),
            'Destinations retrieved successfully'
        );
    }

    public function store(DestinationRequest $request)
    {
        $destination = $this->destinationService->create($request->validated());

        return ApiResponse::success(
            new DestinationResource($destination),
            'Destination created successfully',
            201
        );
    }

    public function show(int $id)
    {
        try{
            $fields = ['*'];
            $destination = $this->destinationService->getById($id, $fields);
            return ApiResponse::success(
                new DestinationResource($destination),
                'Destination retrieved successfully'
            );
        } catch (ModelNotFoundException $e){
            return ApiResponse::error('Destination not found', 404);
        }
    }

    public function update(DestinationRequest $request, int $destination)
    {
        try {
            $destination = $this->destinationService->update($destination, $request->validated());

            return ApiResponse::success(
                new DestinationResource($destination),
                'Destination updated successfully'
            );         
        } catch (ModelNotFoundException $e) {
            return ApiResponse::error('Destination not found', 404);
        }
    }  

    public function destroy(int $id)
    {
        try{
            $this->destinationService->delete($id);
            return ApiResponse::deleted();
        }catch(ModelNotFoundException $e){
            return ApiResponse::error('Destination not found', 404);
        }
    }
}
