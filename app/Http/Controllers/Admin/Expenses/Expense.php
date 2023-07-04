<?php

namespace App\Http\Controllers\Admin\Expenses;

use App\Http\Controllers\Controller;
use App\repositoryinterface\ExpenseCategoryInterface;
use App\repositoryinterface\ExpenseInterface;
use Illuminate\Http\Request;

class Expense extends Controller
{
    private $expenseRepository;

    function __construct(ExpenseInterface $expenseRepository)
    {
        $this->expenseRepository = $expenseRepository;
    }


    public function index(Request $request)
    {

        if ($request->ajax()) {
            return   $this->expenseRepository->all();
        }
        return view('Admin.CRUDS.expenses.index');
    }


    public function create()
    {
        $expenseCategories= \App\Models\ExpenseCategory::get();

        return view('Admin.CRUDS.expenses.parts.create',compact('expenseCategories'));
    }

    public function store(Request $request)
    {
        return  $this->expenseRepository->store($request);
    }



    public function edit($id)
    {

        $row=  $this->expenseRepository->get_by_id($id);
        $expenseCategories= \App\Models\ExpenseCategory::get();
        $subExpenseCategories= \App\Models\ExpenseCategory::where('from_id',$row->main_expense_category_id)->get();

        return view('Admin.CRUDS.expenses.parts.edit', compact('row','expenseCategories','subExpenseCategories'));

    }

    public function update(Request $request,$id)
    {
        return $this->expenseRepository->update($request,$id);
    }


    public function destroy($id)
    {

        return $this->expenseRepository->destroy($id);




    }//end fun

    public function getSubExpenseCategoryByMain($id){
        $subExpenseCategories= $this->expenseRepository->getSubExpenseCategoryByMain($id);

        return view('Admin.CRUDS.expenses.parts.subExpenseCategories', compact('subExpenseCategories'));

    }
}
