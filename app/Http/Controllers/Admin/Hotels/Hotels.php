<?php

namespace App\Http\Controllers\Admin\Hotels;

use App\Http\Controllers\Controller;
use App\Http\Traits\Upload_Files;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;
use App\repositoryinterface\HotelInterface;
use App\repository\DbHotelRepository;
class Hotels extends Controller
{
    use Upload_Files;



    private $hotelRepository;

    function __construct()
    {
         $hotel = new Hotel();
         $hotelRepository =new DbHotelRepository($hotel);
         $this->hotelRepository = $hotelRepository;
    }


    public function index(Request $request)
    {


        if ($request->ajax()) {
           return   $this->hotelRepository->all();
         }
      return view('Admin.CRUDS.hotels.index');
    }


    public function create()
    {
        return view('Admin.CRUDS.hotels.parts.create');
    }

    public function store(Request $request)
    {
     return  $this->hotelRepository->store($request);
    }



    public function edit($id)
    {

        $hotels=  $this->hotelRepository->get_by_id($id);
        return view('Admin.CRUDS.hotels.parts.edit', compact('hotels'));

    }

    public function update(Request $request,$id)
    {
       return $this->hotelRepository->update($request,$id);
    }


    public function destroy($id)
    {

        return $this->hotelRepository->destroy($id);




    }//end fun





}
