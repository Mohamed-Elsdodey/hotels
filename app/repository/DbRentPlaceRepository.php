<?php

namespace App\repository;

use App\Models\RentPlace;
use App\repositoryinterface\CategoryRentInterface;
use App\repositoryinterface\HotelInterface;
use App\repositoryinterface\RentPlaceInterface;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
class DbRentPlaceRepository implements RentPlaceInterface {


    public function all()
    {

        $rows = RentPlace::query()->latest();
        return DataTables::of($rows)
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



            ->editColumn('category_rent_id', function ($row) {
                if (app()->getLocale()=='ar')
                    $category= $row->category->title_ar??'';
                else
                    $category= $row->category->title_en??'';
                return $category;

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
            'desc_ar' => 'required',
            'desc_en' => 'required' ,
            'category_rent_id'=>'required|exists:category_rents,id',
        ]);
        RentPlace::create($data);
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
            'desc_ar' => 'required',
            'desc_en' => 'required' ,
            'category_rent_id'=>'required|exists:category_rents,id',
        ]);
        RentPlace::where('id',$id)->update($data);
        return response()->json(
            [
                'code' => 200,
                'message' => 'success!'
            ]);

    }
    public function destroy($id)
    {
        RentPlace::destroy($id);
        return response()->json(
            [
                'code' => 200,
                'message' => 'success!'
            ]);
    }

    public function get_by_id($id)
    {
        return RentPlace::find($id);
    }


}
