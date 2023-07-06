<?php

namespace App\Http\Controllers\Admin\Rooms;

use App\Http\Controllers\Controller;
use App\Http\Traits\LogActivityTrait;
use App\Http\Traits\Upload_Files;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

use App\repositoryinterface\RoomInterface;

class Rooms extends Controller
{
    use Upload_Files;
    private $Room;

    function __construct(RoomInterface  $Room)
    {
        $this->Room = $Room;
    }


    public function index(Request $request)
    {

      $rooms =$this->Room->all();

        if ($request->ajax()) {
            return   $this->Room->all();
        }
        return view('Admin.CRUDS.rooms.index');
    }


    public function create()
    {
        $category_types= TypesCategory();
        $Roomstypes=DB::table('rooms_categories')->where('type',1)->get();
        $hotels=DB::table('hotels')->get();
        $features=DB::table('rooms_features')->get();
        return view('Admin.CRUDS.rooms.parts.create',compact('Roomstypes','hotels','features'));
    }

    public function store(Request $request)
    {

        return  $this->Room->store($request);
    }



    public function edit($id)
    {

        $Roomstypes=DB::table('rooms_categories')->where('type',1)->get();
        $hotels=DB::table('hotels')->get();
        $features=DB::table('rooms_features')->get();
        $Room=  $this->Room->get_by_id($id);
        return view('Admin.CRUDS.rooms.parts.edit', compact('Roomstypes','hotels','features','Room'));

    }

    public function update(Request $request,$id)
    {
        return $this->Room->update($request,$id);
    }

    public function destroy($id)
    {

        return $this->Room->destroy($id);


    }//end fun





}