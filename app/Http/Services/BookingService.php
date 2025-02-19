<?php

namespace App\Http\Services;

use App\Http\Interfaces\BookingRepositoryInterface;

class BookingService
{
    public function __construct(protected BookingRepositoryInterface $bookingRepository)
    {
    }

    public function getAllBookingsByResourceId($id)
    {
        return $this->bookingRepository->getBy($id, [
            'whereHas' => ['resourceObj' => [
                'id' => $id
                ]
            ],
            'without' => ['resourceObj']

        ]);
    }

    public function storeBooking($data)
    {
        return $this->bookingRepository->save($data);
    }

    public function cancelBooking($id)
    {
        return $this->bookingRepository->delete($id);
    }
}
