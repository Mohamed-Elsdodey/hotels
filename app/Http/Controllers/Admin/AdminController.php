<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\LogActivityTrait;
use App\Http\Traits\Upload_Files;
use App\Models\Admin;
use App\Models\AdminRole;
use App\Models\AdminTokens;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class AdminController extends Controller
{
    use Upload_Files;

    public function index(Request $request)
    {

        if ($request->ajax()) {
            $admins = Admin::query()->latest();
            return Datatables::of($admins)
                ->addColumn('action', function ($admin) {

                    $edit = '';
                    $delete = '';


                    return '
                            <button ' . $edit . '  class="editBtn btn rounded-pill btn-primary waves-effect waves-light"
                                    data-id="' . $admin->id . '"
                            <span class="svg-icon svg-icon-3">
                                <span class="svg-icon svg-icon-3">
                                    <i class="las la-edit"></i>
                                </span>
                            </span>
                            </button>
                            <button ' . $delete . '  class="btn rounded-pill btn-danger waves-effect waves-light delete"
                                    data-id="' . $admin->id . '">
                            <span class="svg-icon svg-icon-3">
                                <span class="svg-icon svg-icon-3">
                                    <i class="las la-trash-alt"></i>
                                </span>
                            </span>
                            </button>
                       ';


                })
                ->editColumn('image', function ($admin) {
                    return '
                              <a data-fancybox="" href="' . get_file($admin->image) . '">
                                <img height="60px" src="' . get_file($admin->image) . '">
                            </a>
                             ';
                })
                ->editColumn('is_active', function ($row) {
                    $active = '';
                    $operation = '';

                    if ($row->is_active == 1)
                        $active = 'checked';

                    return '<div class="form-check form-switch">
  <input ' . $operation . '  class="form-check-input activeBtn" data-id="' . $row->id . ' " type="checkbox" role="switch" id="flexSwitchCheckChecked" ' . $active . '  >
</div>';
                })
                ->editColumn('created_at', function ($admin) {
                    return date('Y/m/d', strtotime($admin->created_at));
                })
                ->escapeColumns([])
                ->make(true);


        }
        return view('Admin.CRUDS.admin.index');
    }


    public function create()
    {
        $roles = Role::get();

        return view('Admin.CRUDS.admin.parts.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:admins,email',
            'phone' => 'required|unique:admins,phone',

            'password' => 'required',
//             'business_name'=>'required',
            'image' => 'required|mimes:jpeg,jpg,png,gif,svg,webp,avif',
            'is_active' => 'required',

        ]);
        $data["image"] = $this->uploadFiles('admins', $request->file('image'), null);

        $data['password'] = bcrypt($request->password);

//        $data['image'] = $this->createImageFromTextManual('admins' , $request->name ,256 , '#000', '#fff');

        $admin = Admin::create($data);


        DB::table('model_has_roles')->where('model_id', $admin->id)->delete();

        $admin->assignRole($request->input('roles'));

        return response()->json(
            [
                'code' => 200,
                'message' => 'تمت العملية بنجاح!'
            ]);
    }


    public function show(Admin $admin)
    {

        $html = view('Admin.CRUDS.admin.parts.show', compact('admin'))->render();
        return response()->json([
            'code' => 200,
            'html' => $html,
        ]);

        //
    }


    public function edit(Admin $admin)
    {
        $roles = Role::get();

        $adminRoles = DB::table("model_has_roles")->where("model_has_roles.model_id", $admin->id)
            ->get();

        return view('Admin.CRUDS.admin.parts.edit', compact('admin', 'roles', 'adminRoles'));

    }

    public function update(Request $request, Admin $admin)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:admins,email,' . $admin->id,
            'phone' => 'required|unique:admins,phone,' . $admin->id,
            'password' => 'nullable',
//            'business_name'=>'required',
            'image' => 'nullable|mimes:jpeg,jpg,png,gif,svg,webp,avif',
            'is_active' => 'nullable',


        ]);
        if ($request->password) {
            $data['password'] = bcrypt($request->password);

        } else {

            $data['password'] = $admin->password;


        }
        if ($request->image) {
            $data["image"] = $this->uploadFiles('admins', $request->file('image'), null);

        }
        $admin->update($data);


        DB::table('model_has_roles')->where('model_id', $admin->id)->delete();


        $admin->assignRole($request->input('roles'));


        $html = view('Admin.CRUDS.admin.parts.header')->render();

        return response()->json(
            [
                'code' => 200,
                'message' => 'تمت العملية بنجاح!',
                'html' => $html,
                'name' => $admin->name,
                'logo' => get_file($admin->image),
                'business_name' => $admin->business_name,
            ]);
    }


    public function destroy(Admin $admin)
    {
        $admin->delete();

        return response()->json(
            [
                'code' => 200,
                'message' => 'تمت العملية بنجاح!'
            ]);
    }//end fun


    public function activate(Request $request)
    {

        $admin = Admin::findOrFail($request->id);
        if ($admin->is_active == true) {
            $admin->is_active = 0;
            $admin->save();
        } else {
            $admin->is_active = 1;
            $admin->save();
        }

        return response()->json(['status' => true]);
    }//end fun

}//end class
