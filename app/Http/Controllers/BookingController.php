<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\StorebookingRequest;
use App\Http\Requests\UpdatebookingRequest;
use App\Models\Booking;
use App\Models\RoomType;
use App\Models\Room;
use App\Models\RoomSchedule;
use App\Models\BookingRoom;
use App\Models\Sect;
use App\Models\Department;
use App\Models\ModelConst;

use Illuminate\Support\Facades\DB;


class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = Booking::with(['user', 'department', 'sect'])
            ->where('user_id', auth()->user()->id)
            ->get();

        $room = Room::all();
        $bookingrooms = BookingRoom::all();

        $attrConfig = Booking::getAttributeOptions('state');
        $attrConfigdoc = Booking::getArrtibuteOptions('doc_status');

        return view('booking.index', compact('bookings', 'room', 'attrConfig' , 'attrConfigdoc' , 'bookingrooms'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $booking = booking::all();
        $bookings = new booking();

        $user = auth()->user();
        $bookings->user_id = $user->id;

        if ($bookings->save()) {
            return redirect()->route('booking.edit', ['id' => $bookings->booking_id]);
        }
        // return view('booking.create');
        return redirect()->route('bookings');

    }

    /**
     * Store a newly created resource in storage.
     */
    //  public function store(Request $request)
    // {
    //     $bookings = new Booking();
    //     $user = auth()->user();
    //     $bookings->user_id = $user->id;

    //     $bookings->save();

    //     return redirect()->route('booking.edit', ['id' => $bookings->id]);
    // }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit($id)
    {
        $booking = Booking::with(['rooms'])->findOrFail($id);
        $rooms = Room::all();
        $roomtypes = RoomType::all();
        $sects = Sect::all();
        $departments = Department::all();

        return view('booking.edit', compact('booking', 'rooms', 'roomtypes', 'sects', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);

        $booking->update([
            'user_id' => auth()->id(),
            'is_classroom' => $request->has('is_classroom') ? 1 : 0,
            'is_ext' => $request->has('is_ext') ? 1 : 0,
            // 'is_ext' => $request->department_id == 19 ? 1 : 0,
            'reason' => $request->reason,
            'sect_id' => $request->sect_id,
            'department_id' => $request->department_id,

        ]);

        return redirect()->route('booking.edit', ['id' => $booking->booking_id])->with('success', 'Booking updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return redirect()->route('bookings')->with('success', 'Booking deleted successfully.');
    }

    public function send(Request $request)
    {
        $booking = Booking::findOrFail($request->id);
        $booking->send();
        return redirect()->route('bookings')->with('success', 'Booking sent successfully.');
    }

    public function unsent(Request $request)
    {
        $booking = Booking::findOrFail($request->id);
        $booking->unsent();
        return redirect()->route('bookings')->with('success', 'Booking unsent successfully.');
    }

   public function review(Request $request , $id)
    {
        $booking = Booking::findOrFail($id);

        $booking->review_comment = $request->review_comment;
        $booking->review_status = $request->review_status;
        // dd($booking->toArray());
        // exit();

        $booking->revieww($request->review_status);

        $booking->save();

        RoomSchedule::generateRoomSchedule($booking->rooms);

        return redirect()->route('review.index')->with('success', 'Booking reviewed successfully.');

    }


    public function cancel(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        $reason = $request->input('cancel_reason', 'ไม่ระบุเหตุผล');

        $booking->cancel($reason);
        RoomSchedule::cancelRoomSchedule($booking->roomschedules);

        return redirect()->route('bookings')->with('success', 'Booking cancelled successfully.');
    }


}