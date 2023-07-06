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

        $features=\App\Models\RoomFeature::get();
        $hotels=Hotel::get();
        $clients=Client::get();
        return view('Admin.booking.index',compact('features','hotels','clients'));
    }

    public function getRoomsInBooking(Request $request){
//        $rooms= $this->bookingRepository->getRoomsInBooking($request);

        $rooms=Room::get();
        $hotel=Hotel::find($request->hotel_id);
        return view('Admin.booking.parts.rooms',compact('rooms','hotel'));

    }

}
