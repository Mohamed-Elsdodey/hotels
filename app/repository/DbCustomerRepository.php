<?php

namespace App\repository;

use App\Models\Client;
use App\repositoryinterface\CustomerInterface;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
class DbCustomerRepository implements CustomerInterface {


    public function all()
    {

        $rows = Client::query()->latest();
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

            ->editColumn('governorate_id', function ($row) {

                if (app()->getLocale()=='ar')
                    $governorate= $row->governorate->title_ar??'';
                else
                    $governorate= $row->governorate->title_en??'';
                return $governorate;

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
            'name' => 'required' ,
            'code'=>'required|unique:clients,code',
            'phone'=>'required|unique:clients,phone',
            'governorate_id'=>'required|exists:areas,id',
            'address'=>'nullable',
        ]);
        $data['publisher']=auth('admin')->user()->id;

        Client::create($data);
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
            'name' => 'required' ,
            'code'=>'required|unique:clients,code,'.$id,
            'phone'=>'required|unique:clients,phone,'.$id,
            'governorate_id'=>'required|exists:areas,id',
            'address'=>'nullable',
        ]);
        Client::where('id',$id)->update($data);
        return response()->json(
            [
                'code' => 200,
                'message' => 'success!'
            ]);

    }
    public function destroy($id)
    {
        Client::destroy($id);
        return response()->json(
            [
                'code' => 200,
                'message' => 'success!'
            ]);
    }

    public function get_by_id($id)
    {
        return Client::find($id);
    }



}
