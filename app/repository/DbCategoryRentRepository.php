<?php

namespace App\repository;

use App\Models\CategoryRent;
use App\repositoryinterface\CategoryRentInterface;
use App\repositoryinterface\HotelInterface;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
class DbCategoryRentRepository implements CategoryRentInterface {


    public function all()
    {

        $rows = CategoryRent::query()->latest();
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



            ->editColumn('from_id', function ($row) {
                if (app()->getLocale()=='ar')
                $from= $row->mainCategory->title_ar??'';
                else
                    $from= $row->mainCategory->title_en??'';

                return $from;

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
            'from_id'=>'nullable',
        ]);
        CategoryRent::create($data);
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
            'from_id'=>'nullable',
        ]);
        CategoryRent::where('id',$id)->update($data);
        return response()->json(
            [
                'code' => 200,
                'message' => 'success!'
            ]);

    }
    public function destroy($id)
    {
        CategoryRent::destroy($id);
        return response()->json(
            [
                'code' => 200,
                'message' => 'success!'
            ]);
    }

    public function get_by_id($id)
    {
        return CategoryRent::find($id);
    }


}
