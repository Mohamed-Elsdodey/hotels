<?php

namespace App\Http\Controllers\Admin\CategoryRents;

use App\Http\Controllers\Controller;
use App\repositoryinterface\CategoryRentInterface;
use Illuminate\Http\Request;

class CategoryRent extends Controller
{
    private $CategoryRentRepository;

    function __construct(CategoryRentInterface $CategoryRentRepository)
    {
        $this->CategoryRentRepository = $CategoryRentRepository;
    }


    public function index(Request $request)
    {

        if ($request->ajax()) {
            return   $this->CategoryRentRepository->all();
        }
        return view('Admin.CRUDS.categoryRents.index');
    }


    public function create()
    {
        $rentCategories= \App\Models\CategoryRent::get();

        return view('Admin.CRUDS.categoryRents.parts.create',compact('rentCategories'));
    }

    public function store(Request $request)
    {
        return  $this->CategoryRentRepository->store($request);
    }



    public function edit($id)
    {

        $row=  $this->CategoryRentRepository->get_by_id($id);
        $rentCategories= \App\Models\CategoryRent::get();

        return view('Admin.CRUDS.categoryRents.parts.edit', compact('row','rentCategories'));

    }

    public function update(Request $request,$id)
    {
        return $this->CategoryRentRepository->update($request,$id);
    }


    public function destroy($id)
    {

        return $this->CategoryRentRepository->destroy($id);




    }//end fun
}
