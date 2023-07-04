<?php

namespace App\repository;

use App\Models\Expense;
use App\Models\ExpenseCategory;
use App\repositoryinterface\CategoryRentInterface;
use App\repositoryinterface\ExpenseCategoryInterface;
use App\repositoryinterface\ExpenseInterface;
use App\repositoryinterface\HotelInterface;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
class DbExpenseRepository implements ExpenseInterface {


    public function all()
    {

        $rows = Expense::query()->latest();
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

            ->editColumn('main_expense_category_id', function ($row) {
                if (app()->getLocale()=='ar')
                    $main= $row->main->title_ar??'';
                else
                    $main= $row->main->title_en??'';
                return $main;

            })


            ->editColumn('sub_expense_category_id', function ($row) {
                if (app()->getLocale()=='ar')
                    $sub= $row->sub->title_ar??'';
                else
                    $sub= $row->sub->title_en??'';
                return $sub;

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
            'sub_expense_category_id' => 'required|exists:expense_categories,id',
            'main_expense_category_id' => 'required|exists:expense_categories,id',
            'value'=>'required|regex:/^\d+(\.\d{1,2})?$/',
        ]);
        Expense::create($data);
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
            'sub_expense_category_id' => 'required|exists:expense_categories,id',
            'main_expense_category_id' => 'required|exists:expense_categories,id',
            'value'=>'required|regex:/^\d+(\.\d{1,2})?$/',
        ]);
        Expense::where('id',$id)->update($data);
        return response()->json(
            [
                'code' => 200,
                'message' => 'success!'
            ]);

    }
    public function destroy($id)
    {
        Expense::destroy($id);
        return response()->json(
            [
                'code' => 200,
                'message' => 'success!'
            ]);
    }

    public function get_by_id($id)
    {
        return Expense::find($id);
    }


    public function getSubExpenseCategoryByMain($id)
    {
        return ExpenseCategory::where('from_id',$id)->get();
    }

}
