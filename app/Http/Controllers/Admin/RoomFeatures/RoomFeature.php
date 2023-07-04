<?php

namespace App\Http\Controllers\Admin\RoomFeatures;

use App\Http\Controllers\Controller;
use App\Http\Traits\LogActivityTrait;
use App\Http\Traits\Upload_Files;
use App\Models\Category;
use App\Models\RoomsFeature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;



use App\repository\DbRoomFeatureRepository;
use App\repositoryinterface\RoomFeatureInterface;
use App\repositoryinterface\HotelInterface;
class RoomFeature extends Controller
{
    use Upload_Files;
    private $RoomFeatureRepository;

    function __construct(RoomFeatureInterface  $RoomFeatureRepository,RoomsFeature $model)
    {
        $this->RoomFeatureRepository = $RoomFeatureRepository;
    }


    public function index(Request $request)
    {
      if ($request->ajax()) {
            return   $this->RoomFeatureRepository->all();
        }
          return view('Admin.CRUDS.rooms_features.index');
    }


    public function create()
    {
        return view('Admin.CRUDS.rooms_features.parts.create');
    }

    public function store(Request $request)
    {
        return  $this->RoomFeatureRepository->store($request);
    }



    public function edit($id)
    {

        $RoomsFeature=  $this->RoomFeatureRepository->get_by_id($id);
        return view('Admin.CRUDS.rooms_features.parts.edit', compact('RoomsFeature'));

    }

    public function update(Request $request,$id)
    {
        return $this->RoomFeatureRepository->update($request,$id);
    }


    public function destroy($id)
    {

        return $this->RoomFeatureRepository->destroy($id);


    }//end fun





}
