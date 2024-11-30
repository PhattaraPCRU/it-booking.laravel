<?php

namespace App\Http\Controllers;

// use App\Http\Requests\Storeroom_typeRequest;
// use App\Http\Requests\Updateroom_typeRequest;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\RoomType;
use App\Models\Room;
use App\Models\BookingRoom;
use App\Models\Booking;

class BookingRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $bookingroom = BookingRoom::all();
        $rooms = Room::all();
        $roomtypes = RoomType::all();

        return view('bookingroom.create', compact('bookingroom' , 'rooms', 'roomtypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        // ตรวจสอบการรับข้อมูลจากฟอร์ม
        // $request->validate([
        //     'participant_count' => 'required|integer',
        //     'date' => 'required|date',
        //     'time_start' => 'required',
        //     'time_end' => 'required',
        // ]);

        // $booking = Booking::findOrFail($id);

        // // สร้าง booking room ใหม่และตั้งค่าจากฟอร์ม
        // $bookingroom = new BookingRoom();
        // $bookingroom->booking_id = $booking->booking_id;
        // $bookingroom->participant_count = $request->participant_count;
        // $bookingroom->date = $request->date;
        // $bookingroom->time_start = $request->time_start;
        // $bookingroom->time_end = $request->time_end;

        // $bookingroom->save();

        // เปลี่ยนเส้นทางกลับไปหน้า edit ของ booking
        // return redirect()->route('booking.edit', ['id' => $booking->id])->with('success', 'บันทึกข้อมูลการจองห้องสำเร็จ');
    }


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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    
    // public function update(Request $request, $id)
    // {
    //     $booking = Booking::findOrFail($id);
    //     $booking->is_classroom = $request->has('is_classroom') ? 1 : 0;
    //     $booking->is_ext = $request->has('is_ext') ? 1 : 0;

    //     $bookingroom = new BookingRoom();
    //     $bookingroom->booking_id = $booking->booking_id;
    //     if ($request->filled('time_start') && $request->filled('time_end')) {
    //         $existingBookingQuery = BookingRoom::where('room_id', $request->room_id)
    //             ->where('date', $request->date)
    //             ->where(function ($query) use ($request) {
    //                 $query->whereBetween('time_start', [$request->time_start, $request->time_end])
    //                     ->orWhereBetween('time_end', [$request->time_start, $request->time_end])
    //                     ->orWhere(function ($query) use ($request) {
    //                         $query->where('time_start', '<=', $request->time_start)
    //                             ->where('time_end', '>=', $request->time_end);
    //                     });
    //             });
    //         if ($request->has('is_classroom')) {
    //             $existingTrainingBookings = $existingBookingQuery->whereHas('booking', function ($query) {
    //                 $query->where('is_ext', 1);
    //             })->get();

    //             foreach ($existingTrainingBookings as $trainingBooking) {
    //                 $trainingBooking->delete(); 
    //             }
    //         } else {
    //             $existingBooking = $existingBookingQuery->whereHas('booking', function ($query) {
    //                 $query->where('is_classroom', 1);
    //             })->exists();

    //             if ($existingBooking) {
    //                 return redirect()->back()->with([
    //                     'alert' => [
    //                         'type' => 'error',
    //                         'message' => 'ห้องนี้ถูกจองสำหรับการเรียนการสอนในวันที่และเวลาที่คุณเลือกแล้ว กรุณาเลือกห้องหรือเวลาอื่น',
    //                     ]
    //                 ]);
    //             }
    //         }
    //     }
    //     $lastBookingRoom = BookingRoom::where('booking_id', $booking->booking_id)
    //         ->orderBy('no', 'desc')
    //         ->first();

    //     $bookingroom->no = $lastBookingRoom ? $lastBookingRoom->no + 1 : 1;

    //     $bookingroom->room_id = $request->room_id;
    //     $bookingroom->participant_count = $request->participant_count;
    //     $bookingroom->date = $request->date;
    //     $bookingroom->time_start = $request->time_start;
    //     $bookingroom->time_end = $request->time_end;

    //     $bookingroom->save();

    //     return redirect()->route('booking.edit', ['id' => $booking->booking_id])->with(['success', 'Booking updated successfully.']);
    // }



    public function update(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);

        $bookingroom = new BookingRoom();
        $bookingroom->booking_id = $booking->booking_id;

        if ($request->filled('time_start') && $request->filled('time_end')) {
    $existingBookingQuery = BookingRoom::where('room_id', $request->room_id)
        ->where('date', $request->date)
        ->where(function ($query) use ($request) {
            $query->whereBetween('time_start', [$request->time_start, $request->time_end])
                ->orWhereBetween('time_end', [$request->time_start, $request->time_end])
                ->orWhere(function ($query) use ($request) {
                    $query->where('time_start', '<=', $request->time_start)
                        ->where('time_end', '>=', $request->time_end);
                });
        });

    // Adjust whereHas to match your schema
    if ($request->has('is_classroom')) {
        $existingTrainingBookings = $existingBookingQuery->whereHas('booking', function ($query) {
            $query->where('is_ext', 1);
        })->get();

        foreach ($existingTrainingBookings as $trainingBooking) {
            $trainingBooking->delete();
        }
    } else {
        $existingBooking = $existingBookingQuery->whereHas('booking', function ($query) {
            $query->where('is_classroom', 1);
        })->exists();

        if ($existingBooking) {
            return redirect()->back()->with([
                'alert' => [
                    'type' => 'error',
                    'message' => 'ห้องนี้ถูกจองสำหรับการเรียนการสอนในวันที่และเวลาที่คุณเลือกแล้ว กรุณาเลือกห้องหรือเวลาอื่น',
                ]
            ]);
        }
    }
}


        $lastBookingRoom = BookingRoom::where('booking_id', $booking->booking_id)
            ->orderBy('no', 'desc')
            ->first();

        $bookingroom->no = $lastBookingRoom ? $lastBookingRoom->no + 1 : 1;
        $bookingroom->room_id = $request->room_id;
        $bookingroom->participant_count = $request->participant_count;
        $bookingroom->date = $request->date;
        $bookingroom->time_start = $request->time_start;
        $bookingroom->time_end = $request->time_end;

        $bookingroom->save();
        return redirect()->route('booking.edit', ['id' => $booking->booking_id]);
    }










    /**
     * Remove the specified resource from storage.
     */
    public function destroy($booking_id, $no)
    {
        $check = BookingRoom::where('booking_id', $booking_id)->where('no' , $no)->first();
        if($check) {
           $bookingroom = BookingRoom::where('booking_id', $booking_id)->where('no' , $no)->delete();
        }


        // if($bookingroom) {
        //     // print_r($bookingroom);exit;
        //     $bookingroom->delete();
        // }

        return redirect()->route('booking.edit', ['id' => $booking_id])->with('success', 'ลบข้อมูลการจองห้องสำเร็จ');
    }

}