<?php

namespace App\Http\Controllers\Admin\ExpenseCategories;

use App\Http\Controllers\Controller;
use App\repositoryinterface\ExpenseCategoryInterface;
use Illuminate\Http\Request;

class ExpenseCategory extends Controller
{
    private $expenseCategoryRepository;

    function __construct(ExpenseCategoryInterface $expenseCategoryRepository)
    {
        $this->expenseCategoryRepository = $expenseCategoryRepository;
    }


    public function index(Request $request)
    {

        if ($request->ajax()) {
            return   $this->expenseCategoryRepository->all();
        }
        return view('Admin.CRUDS.expenseCategory.index');
    }


    public function create()
    {
        $expenseCategories= \App\Models\ExpenseCategory::get();

        return view('Admin.CRUDS.expenseCategory.parts.create',compact('expenseCategories'));
    }

    public function store(Request $request)
    {
        return  $this->expenseCategoryRepository->store($request);
    }



    public function edit($id)
    {

        $row=  $this->expenseCategoryRepository->get_by_id($id);
        $expenseCategories= \App\Models\ExpenseCategory::get();

        return view('Admin.CRUDS.expenseCategory.parts.edit', compact('row','expenseCategories'));

    }

    public function update(Request $request,$id)
    {
        return $this->expenseCategoryRepository->update($request,$id);
    }


    public function destroy($id)
    {

        return $this->expenseCategoryRepository->destroy($id);




    }//end fun
}
