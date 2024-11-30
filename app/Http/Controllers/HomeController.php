<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\RoomSchedule as RS;
use App\Models\BookingRoom as BR;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $events = $this->fetchEvent();

        // dd($events); // Check what is being fetched

        return view('welcome', ['events' => $events]);
    }


    //     public function homestaff(){

    //     return view('homestaff');
    // }

    // static public function fetchEvent()
    // {
    //     $schedules = RS::all();
    //     $approved = $schedules->map(function ($schedule) {
    //         return [
    //             'id' => $schedule->schedule_id,
    //             'groupId' => $schedule->booking_id,
    //             'title' => $schedule->booking->booking_id,
    //             'start' => $schedule->dt_start,
    //             'end' => $schedule->dt_end,
    //             'backgroundColor' => 'green',
    //             // 'status' => $schedule->status,
    //             // 'calendar_event_id' => $schedule->calendar_event_id,
    //             // 'calendar_status' => $schedule->calendar_status,
    //         ];
    //     });

    //     // $br = BR::whereHas('booking', function ($query) {
    //     //     $query->where('doc_status', 0);
    //     // })->get();
    //     // $pending = $br->map(function ($booking) {
    //     //     return [
    //     //         // 'id' => $booking->booking_id,
    //     //         'id' => null,
    //     //         'groupId' => $booking->booking_id,
    //     //         'title' => $booking->booking_id,
    //     //         'start' => $booking->dt_start,
    //     //         'end' => $booking->dt_end,
    //     //         'backgroundColor' => 'red',
    //     //         // 'status' => $booking->status,
    //     //         // 'calendar_event_id' => $booking->calendar_event_id,
    //     //         // 'calendar_status' => $booking->calendar_status,
    //     //     ];
    //     // });

    //     // $events = $approved->merge($pending);

    //     // return response()->json($events);
    //     return response()->json($approved);
    // }

    static public function fetchEvent()
    {
        $schedules = RS::all();

        
        $approved = $schedules->map(function ($schedule) {
            $name = $schedule->room->room_name . ($schedule->booking->reason ? ' - ' . $schedule->booking->reason : '');

            return [
                'id' => $schedule->schedule_id,
                'groupId' => $schedule->booking_id,
                'title' => $name,
                'start' => $schedule->dt_start,
                'end' => $schedule->dt_end,
                'backgroundColor' => '#B6E2A1',
                'borderColor' => '#B6E2A1',
                'textColor' => '#000000',
            ];
        });

        $br = BR::whereHas('booking', function ($query) {
            $query->where('doc_status', '!=', 2)
                ->where('review_status', 0);
        })->get();

        // $br = BR::all();

        $pending = $br->map(function ($br) {
            $name = $br->room->room_name . ($br->booking->reason ? ' - ' . $br->booking->reason : '');

            // Extract only the date part from $br->date
            $date = Carbon::parse($br->date)->format('Y-m-d');

            // Extract only the time part from $br->time_start and $br->time_end
            $timeStart = Carbon::parse($br->time_start)->format('H:i:s');
            $timeEnd = Carbon::parse($br->time_end)->format('H:i:s');

            // Combine date and time to form valid datetime strings
            $start = Carbon::parse("{$date} {$timeStart}")->format('Y-m-d H:i:s');
            $end = Carbon::parse("{$date} {$timeEnd}")->format('Y-m-d H:i:s');

            return [
                'id' => null,
                'groupId' => $br->booking_id,
                'title' => $name,
                'start' => $start,
                'end' => $end,
                'backgroundColor' => '#FEBE8C',
                'borderColor' => '#FEBE8C',
                'textColor' => '#000000',
            ];
        });

        // Merge approved and pending events
        $events = $approved->merge($pending);

        // Return as a plain array, not a JSON response
        return $events->toArray();
    }


}