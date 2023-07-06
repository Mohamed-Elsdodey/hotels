<?php

namespace App\repository;
use App\Models\Hotel;

use App\Models\Room;
use App\repositoryinterface\BookingInterface;
use App\repositoryinterface\HotelInterface;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
class DbBookingRepository implements BookingInterface {


    public function all()
    {



    }


    public function getRoomsInBooking($request){
        $data = $request->validate([
            'hotel_id' => 'required|exists:hotels,id',
            'room_category_id' => 'required|exists:rooms_categories,id' ,
            'fromDate'=>'nullable',
            'toDate'=>'nullable',
        ]);


        return Room::where('hotel_id',$request->hotel_id)->where('room_category_id',$request->room_category_id)->get();




    }


}
