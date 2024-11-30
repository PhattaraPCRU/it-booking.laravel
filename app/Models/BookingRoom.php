<?php

namespace App\Models;

use App\Models\Base\BookingRoom as BaseBookingRoom;
use App\Models\Room;

use App\Casts\TimeCast;

class BookingRoom extends BaseBookingRoom
{
	protected $fillable = [
		'room_id',
		'participant_count',
		'date',
		'time_start',
		'time_end'
	];

    // protected $casts = [
    //     'date' => 'date',
    //     'time_start' => TimeCast::class,
    //     'time_end' => TimeCast::class
    // ];

	public function room()
	{
		return $this->belongsTo(Room::class, 'room_id');
	}
}
