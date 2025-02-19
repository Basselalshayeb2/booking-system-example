<?php

namespace App\Http\Services;

use App\Exceptions\ModelNotFound;
use App\Http\Interfaces\ResourceRepositoryInterface;
use Illuminate\Http\Response;

class ResourceService
{
    public function __construct(
        protected ResourceRepositoryInterface $resourceRepository,
        protected BookingService $bookingService
    ) {
    }

    public function getAllResources(): mixed
    {
        return $this->resourceRepository->all();
    }

    public function storeResource(mixed $data): mixed
    {
        return $this->resourceRepository->save($data);
    }

    public function getAllBookings(int $resourceId): mixed
    {
        $resource = $this->resourceRepository->findById($resourceId);
        if (!$resource) {
            throw new ModelNotFound("The requested resource does not exist", Response::HTTP_NOT_FOUND);
        }
        $bookings = $this->bookingService->getAllBookingsByResourceId($resourceId);
        return $bookings;
    }
}
