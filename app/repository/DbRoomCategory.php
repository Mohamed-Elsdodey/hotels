<?php

namespace App\repository;
use App\Models\RoomsCategory;

use App\repositoryinterface\RoomCategoryInterface;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class DbRoomCategory implements RoomCategoryInterface{


    public function all()
    {

        $admins = RoomsCategory::get();
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


            ->editColumn('type', function ($row) {
                return  TypesCategory()[$row->type];
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
            'type' => 'required',
            'title_ar' => 'required',
            'title_en' => 'required' ,
        ]);

        RoomsCategory::create($data);
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
            'type' => 'required',
        ]);

        RoomsCategory::where('id',$id)->update($data);
        return response()->json(
            [
                'code' => 200,
                'message' => 'success!'
            ]);

    }
    public function destroy($id)
    {
        RoomsCategory::destroy($id);
        return response()->json(
            [
                'code' => 200,
                'message' => 'success!'
            ]);
    }

    public function get_by_id($id)
    {
        return RoomsCategory::find($id);
    }

}
