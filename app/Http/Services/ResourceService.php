<?php

namespace App\Http\Services;

use App\Http\Interfaces\ResourceRepositoryInterface;

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
            return 'Resource not found'; // Todo:
        }
        $bookings = $this->bookingService->getAllBookingsByResourceId($resourceId);
        return $bookings;
    }
}
