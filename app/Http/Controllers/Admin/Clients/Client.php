<?php

namespace App\Http\Controllers\Admin\Clients;

use App\Http\Controllers\Controller;
use App\Models\Governorate;
use App\repositoryinterface\CustomerInterface;
use App\repositoryinterface\ExpenseInterface;
use Illuminate\Http\Request;

class Client extends Controller
{

    private $customerRepository;

    function __construct(CustomerInterface $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function index(Request $request)
    {




        if ($request->ajax()) {
            return   $this->customerRepository->all();
        }
        return view('Admin.CRUDS.clients.index');
    }


    public function create()
    {

        $governorates=Governorate::get();
        return view('Admin.CRUDS.clients.parts.create',compact('governorates'));
    }

    public function store(Request $request)
    {
        return  $this->customerRepository->store($request);
    }



    public function edit($id)
    {

        $row=  $this->customerRepository->get_by_id($id);
        $governorates=Governorate::get();

        return view('Admin.CRUDS.clients.parts.edit', compact('row','governorates'));

    }

    public function update(Request $request,$id)
    {
        return $this->customerRepository->update($request,$id);
    }


    public function destroy($id)
    {

        return $this->customerRepository->destroy($id);
    }//end fun

}
