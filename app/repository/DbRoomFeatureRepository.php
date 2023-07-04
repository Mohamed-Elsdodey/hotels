<?php

namespace App\repository;
use App\Models\RoomsFeature;

use App\repositoryinterface\RoomFeatureInterface;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class DbRoomFeatureRepository implements RoomFeatureInterface{


    public function all()
    {

        $admins = RoomsFeature::query()->latest();
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


            ->editColumn('image', function ($row) {
                return ' <img height="60px" src="" class=" w-60 rounded"
                             onclick="window.open(this.src)">';
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
        ]);

        RoomsFeature::create($data);
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
        ]);

        RoomsFeature::where('id',$id)->update($data);
        return response()->json(
            [
                'code' => 200,
                'message' => 'success!'
            ]);

    }
    public function destroy($id)
    {
        RoomsFeature::destroy($id);
        return response()->json(
            [
                'code' => 200,
                'message' => 'success!'
            ]);
    }

    public function get_by_id($id)
    {
        return RoomsFeature::find($id);
    }

}
