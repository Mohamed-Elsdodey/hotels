<?php

namespace App\Http\Controllers\Admin\Governorates;

use App\Http\Controllers\Controller;
use App\repositoryinterface\GovernorateInterface;
use Illuminate\Http\Request;

class Governorate extends Controller
{
    //
    private $governorateRepository;

    function __construct(GovernorateInterface $governorateRepository)
    {
        $this->governorateRepository = $governorateRepository;
    }


    public function index(Request $request)
    {

        if ($request->ajax()) {
            return   $this->governorateRepository->all();
        }
        return view('Admin.CRUDS.governorates.index');
    }


    public function create()
    {

        return view('Admin.CRUDS.governorates.parts.create');
    }

    public function store(Request $request)
    {
        return  $this->governorateRepository->store($request);
    }



    public function edit($id)
    {

        $row=  $this->governorateRepository->get_by_id($id);

        return view('Admin.CRUDS.governorates.parts.edit', compact('row'));

    }

    public function update(Request $request,$id)
    {
        return $this->governorateRepository->update($request,$id);
    }


    public function destroy($id)
    {

        return $this->governorateRepository->destroy($id);




    }//end fun

}
