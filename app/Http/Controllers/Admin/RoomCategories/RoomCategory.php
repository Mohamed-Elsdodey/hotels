<?php

namespace App\Http\Controllers\Admin\RoomCategories;

use App\Http\Controllers\Controller;
use App\Http\Traits\LogActivityTrait;
use App\Http\Traits\Upload_Files;
use App\Models\RoomsCategory;
use App\Models\RoomsFeature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;
use App\repository\DbRoomCategory;
use App\repositoryinterface\RoomCategoryInterface;

class RoomCategory extends Controller
{
    use Upload_Files;
    private $RoomsCategory;

    function __construct(RoomCategoryInterface  $RoomsCategory)
    {
        $this->RoomsCategory = $RoomsCategory;
    }


    public function index(Request $request)
    {


        if ($request->ajax()) {
            return   $this->RoomsCategory->all();
        }
      return view('Admin.CRUDS.roomscategories.index');
    }


    public function create()
    {
        $category_types= TypesCategory();
        return view('Admin.CRUDS.roomscategories.parts.create',compact('category_types'));
    }

    public function store(Request $request)
    {
        return  $this->RoomsCategory->store($request);
    }



    public function edit($id)
    {
        $category_types= TypesCategory();
        $RoomsCategory=  $this->RoomsCategory->get_by_id($id);

        return view('Admin.CRUDS.roomscategories.parts.edit', compact('RoomsCategory','category_types'));

    }

    public function update(Request $request,$id)
    {
        return $this->RoomsCategory->update($request,$id);
    }

    public function destroy($id)
    {

        return $this->RoomsCategory->destroy($id);


    }//end fun





}
