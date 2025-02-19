<?php

namespace App\Models;

use App\Observers\BookingObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

#[ObservedBy([BookingObserver::class])]
class Booking extends Model
{
    use SoftDeletes;
    use HasFactory;

    //
    protected $fillable = ['user_id', 'resource_id', 'start_time', 'end_time'];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    protected $with = ['user', 'resourceObj'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function resourceObj()
    {
        return $this->belongsTo(Resource::class, 'resource_id', 'id');
    }
}
