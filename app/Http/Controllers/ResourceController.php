<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreResourceRequest;
use App\Http\Resources\BookingResource;
use App\Http\Resources\ResourceResource;
use App\Http\Services\ResourceService;

class ResourceController extends Controller
{
    public function __construct(protected ResourceService $resourceService)
    {
    }

    public function getAllResources()
    {
        $resources = $this->resourceService->getAllResources();

        return response()->success(ResourceResource::collection($resources));
    }

    public function storeResource(StoreResourceRequest $request)
    {
        //
        $data = $request->validated();
        $resource = $this->resourceService->storeResource($data);

        return response()->success(new ResourceResource($resource));
    }

    public function getAllBookings($resourceId)
    {
        $bookings = $this->resourceService->getAllBookings($resourceId);
        return response()->success(BookingResource::collection($bookings));
    }
}
