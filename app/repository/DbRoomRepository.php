<?php

namespace App\repository;
use App\Models\Room;

use App\repositoryinterface\RoomInterface;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class DbRoomRepository implements RoomInterface{


    public function all()
    {

        $admins = Room::with('categoryroom')->get();
        return DataTables::of($admins)
            ->addColumn('action', function ($row) {

                $edit='';
                $delete='';




                return '
                            <button '.$edit.'  class="editBtn btn rounded-pill btn-primary waves-effect waves-light"
                                    data-id="' . $row->id . '"
                            <span class="svg-icon svg-icon-3">
                                <span class="svg-icon svg-icon-3">
                                    <i class="fa fa-edit"></i>
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


            ->editColumn('category', function ($row) {
                return  1;
            })




            ->editColumn('created_at', function ($admin) {
                return date('Y/m/d', strtotime($admin->created_at));
            })
            ->escapeColumns([])
            ->make(true);



    }


    public function create($data)
    {


    }

    public function store($request)
    {
        $data = $request->validate([

            'title_ar' => 'required',
            'title_en' => 'required' ,
            'room_number' => 'required' ,
            'hotel_id' => 'required',
            'floor' => 'required',
            'room_category' => 'required',
            'price' => 'required',


        ]);
       $data['features']=json_encode( $request->features);
        $data['publisher']=auth()->user()->id;

        //$data['description']=$request->description ;
        Room::create($data);
        return response()->json(
            [
                'code' => 200,
                'message' => 'success!'
            ]);
    }

    public function edit($id)
    {
        //return Hotel::create($id);

    }
    public function update(Request $request,$id)
    {

        $data = $request->validate([

            'title_ar' => 'required',
            'title_en' => 'required' ,
            'room_number' => 'required' ,
            'hotel_id' => 'required',
            'floor' => 'required',
            'room_category' => 'required',
            'price' => 'required',


        ]);
        $data['features']=json_encode( $request->features);
        $data['publisher']=auth()->user()->id;

        Room::where('id',$id)->update($data);
        return response()->json(
            [
                'code' => 200,
                'message' => 'success!'
            ]);

    }
    public function destroy($id)
    {
        Room::destroy($id);
        return response()->json(
            [
                'code' => 200,
                'message' => 'success!'
            ]);
    }

    public function get_by_id($id)
    {
        return Room::find($id);
    }

}
