<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\BookingRepositoryInterface;
use App\Models\Booking;

class BookingRepository implements BookingRepositoryInterface
{
    public function all()
    {
        return Booking::all();
    }
    public function save($data)
    {
        return Booking::create($data);
    }
}
