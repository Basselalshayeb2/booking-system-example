<?php

namespace App\Observers;

use App\Models\Booking;
use App\Models\User;
use App\Notifications\BookingCanceledNotification;
use App\Notifications\BookingCreatedNotification;
use Illuminate\Contracts\Events\ShouldHandleEventsAfterCommit;

// Todo: Demo notifications
class BookingObserver implements ShouldHandleEventsAfterCommit
{
    public function created(Booking $booking): void
    {
        $users = User::all();
        foreach ($users as $user) {
            $user->notify(new BookingCreatedNotification($booking));
        }
    }

    public function deleted(Booking $booking): void
    {
        //
        $users = User::all();
        foreach ($users as $user) {
            $user->notify(new BookingCanceledNotification($booking));
        }
    }

}
