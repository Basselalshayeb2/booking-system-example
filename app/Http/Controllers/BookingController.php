<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingRequest;
use App\Http\Resources\BookingResource;
use App\Http\Services\BookingService;

class BookingController extends Controller
{
    public function __construct(protected BookingService $bookingService)
    {
    }

    public function storeBooking(StoreBookingRequest $request)
    {
        $data = $request->validated();
        return response()->success(new BookingResource($this->bookingService->storeBooking($data)));
    }

    public function cancelBooking($id)
    {
        $this->bookingService->cancelBooking($id);
        return response()->success(true);
    }
}
