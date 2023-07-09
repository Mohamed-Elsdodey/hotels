<?php

namespace App\Http\Controllers\Admin\Booking;

use App\Http\Controllers\Admin\RoomFeatures\RoomFeature;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Hotel;
use App\Models\Room;
use App\repositoryinterface\BookingInterface;
use Illuminate\Http\Request;

class Booking extends Controller
{
    //

    private $bookingRepository;

    function __construct(BookingInterface $bookingRepository)
    {
        $this->bookingRepository = $bookingRepository;
    }

    public function index(Request $request)
    {

        $categories=\App\Models\RoomsCategory::get();
        $hotels=Hotel::get();
        $clients=Client::get();
        return view('Admin.booking.index',compact('categories','hotels','clients'));
    }

    public function getRoomsInBooking(Request $request){
//        $rooms= $this->bookingRepository->getRoomsInBooking($request);

        $rooms=Room::where('hotel_id',$request->hotel_id)->where('room_category',$request->room_category)->get();
        $hotel=Hotel::find($request->hotel_id);
        return view('Admin.booking.parts.rooms',compact('rooms','hotel'));

    }
    public function getRoomPrice($id){
        $room=Room::find($id);
        return view('Admin.booking.parts.roomPrice',compact('room'));


    }

    public function store_booking(Request $request){

        return $request;
    }

}
