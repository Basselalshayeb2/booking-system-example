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

    public function getBy($id, $options = [])
    {
        $query = Booking::query();
        if (isset($options['whereHas'])) {
            foreach ($options['whereHas'] as $relation => $conditions) {
                $query->whereHas($relation, function ($query) use ($conditions) {
                    foreach ($conditions as $column => $value) {
                        if (is_array($value)) {
                            $query->where($column, $value[0], $value[1]);
                        } else {
                            $query->where($column, $value);
                        }
                    }
                });
            }
        }

        $query->without($options['without'] ?? []);
        return $query->get();
    }
}
