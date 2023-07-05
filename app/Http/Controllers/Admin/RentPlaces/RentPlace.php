<?php

namespace App\Http\Controllers\Admin\RentPlaces;

use App\Http\Controllers\Controller;
use App\repositoryinterface\CategoryRentInterface;
use App\repositoryinterface\RentPlaceInterface;
use Illuminate\Http\Request;

class RentPlace extends Controller
{
    private $RentPlaceRepository;

    function __construct(RentPlaceInterface $RentPlaceRepository)
    {
        $this->RentPlaceRepository = $RentPlaceRepository;
    }


    public function index(Request $request)
    {

        if ($request->ajax()) {
            return   $this->RentPlaceRepository->all();
        }
        return view('Admin.CRUDS.rentPlaces.index');
    }


    public function create()
    {
        $rentCategories= \App\Models\CategoryRent::get();

        return view('Admin.CRUDS.rentPlaces.parts.create',compact('rentCategories'));
    }

    public function store(Request $request)
    {
        return  $this->RentPlaceRepository->store($request);
    }



    public function edit($id)
    {

        $row=  $this->RentPlaceRepository->get_by_id($id);
        $rentCategories= \App\Models\CategoryRent::get();

        return view('Admin.CRUDS.rentPlaces.parts.edit', compact('row','rentCategories'));

    }

    public function update(Request $request,$id)
    {
        return $this->RentPlaceRepository->update($request,$id);
    }


    public function destroy($id)
    {

        return $this->RentPlaceRepository->destroy($id);




    }//end fun
}
