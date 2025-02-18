<?php

namespace App\Http\Services;

use App\Http\Interfaces\BookingRepositoryInterface;

class BookingService
{
    public function __construct(protected BookingRepositoryInterface $bookingRepository)
    {
    }

    public function storeBooking($data)
    {
        return $this->bookingRepository->save($data);
    }
}
