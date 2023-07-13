<?php

namespace App\repository;
use App\Models\Hotel;

use App\Models\Room;
use App\Models\Booking;
use App\repositoryinterface\BookingInterface;
use App\repositoryinterface\HotelInterface;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
class DbBookingRepository implements BookingInterface {


    public function all()
    {
        $admins = Booking::with('categoryroom','hotel','client')->get();
        return DataTables::of($admins)
            ->addColumn('action', function ($row) {

                $edit='';
                $delete='';




                return '
                            <button '.$edit.' onclick="check2('. $row->id .');" id="edit' . $row->id . '"   class="btn rounded-pill btn-primary waves-effect waves-light" title="make egyptian invoice"
                                    data-id="' . $row->id . '"
                            <span class="svg-icon svg-icon-3">
                                <span class="svg-icon svg-icon-3">
                                    <i class="fa fa-redo"></i>
                                </span>
                            </span>
                            </button>
                            <button '.$delete.'  class="btn rounded-pill btn-danger waves-effect waves-light delete"
                                    data-id="' . $row->id . '">
                            <span class="svg-icon svg-icon-3">
                                <span class="svg-icon svg-icon-3">
                                    <i class="fa fa-trash"></i>
                                </span>
                            </span>
                            </button>
                       ';



            })


            ->editColumn('from_date', function ($row) {
                return  date('Y-m-d',$row->from_date);
            })

            ->editColumn('to_date', function ($row) {
                return  date('Y-m-d',$row->to_date);
            })

            ->editColumn('category', function ($row) {
                return  $row->categoryroom->title_en ;
            })




            ->editColumn('hotel', function ($row) {
                return  $row->hotel->name ;
            })




            ->editColumn('created_at', function ($admin) {
                return date('Y/m/d', strtotime($admin->created_at));
            })
            ->escapeColumns([])
            ->make(true);




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

    public function get_by_id($id)
    {
        $Room = Room::findOrFail($id);
        return $Room;
    }





}
