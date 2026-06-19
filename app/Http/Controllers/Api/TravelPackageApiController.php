<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\TravelPackageService;
use App\Http\Resources\TravelPackageResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests\TravelPackageRequest;
use App\Helpers\ApiResponse;


class TravelPackageApiController extends Controller
{
    protected TravelPackageService $travelPackageService;

    public function __construct(TravelPackageService $travelPackageService)
    {
        $this->travelPackageService = $travelPackageService;
    }

    public function index()
    {
        $fields = ['*'];
        $packages = $this->travelPackageService->getAll($fields);

        return ApiResponse::paginated(
            $packages,
            TravelPackageResource::collection($packages),
            'Travel packages retrieved successfully'
        );
    }

    public function store(TravelPackageRequest $request)
    {
        $package = $this->travelPackageService->create(
            $this->prepareFields($request)
        );
    
        return ApiResponse::success(
            new TravelPackageResource($package),
            'Travel package created successfully',
            201
        );
    }

    public function show($id)
    {
        try {
            $package = $this->travelPackageService->getById($id);

            return ApiResponse::success(
                new TravelPackageResource($package),
                'Travel Package retrieved successfully'
            );
        } catch (ModelNotFoundException $e) {
            return ApiResponse::error('Travel Package not found', 404);
        }
    }

    public function update(TravelPackageRequest $request, $id)
    {
        try {
            $package = $this->travelPackageService->update(
                $id,
                $this->prepareFields($request)
            );

            return ApiResponse::success(
                new TravelPackageResource($package),
                'Travel Package update successfully'
            );
        } catch (ModelNotFoundException $e) {
            return ApiResponse::error('Travel Package not found', 404);
        }
    }

    public function destroy($id)
    {
        try {
            $this->travelPackageService->delete($id);
            return ApiResponse::deleted();
        } catch (ModelNotFoundException $e) {
            return ApiResponse::error('Travel Package not found', 404);
        }
    }

    private function prepareFields($request): array
    {
        $fields = $request->validated();

        // inject images jika ada
        if ($request->hasFile('images')) {
            $fields['images'] = $request->file('images');
        }

        if ($request->has('primary_index')) {
            $fields['primary_index'] = $request->primary_index;
        }

        return $fields;
    }
}