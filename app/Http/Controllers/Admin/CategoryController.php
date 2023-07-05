<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\LogActivityTrait;
use App\Http\Traits\Upload_Files;
use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
    use Upload_Files;




    public function index(Request $request)
    {


        if ($request->ajax()) {
            $admins = Category::query()->latest();
            return DataTables::of($admins)
                ->addColumn('action', function ($row) {

                    $edit='';
                    $delete='';




                    return '
                            <button '.$edit.'  class="editBtn btn rounded-pill btn-primary waves-effect waves-light"
                                    data-id="' . $row->id . '"
                            <span class="svg-icon svg-icon-3">
                                <span class="svg-icon svg-icon-3">
                                    <i class="fa fa-edit"></i>
                                </span>
                            </span>
                            </button>
                            <button '.$delete.'  class="btn rounded-pill btn-danger waves-effect waves-light delete"
                                    data-id="' . $row->id . '">
                            <span class="svg-icon svg-icon-3">
                                <span class="svg-icon svg-icon-3">
                                    <i class="fa fa-trash"></i>
                                </span>
                            </span>
                            </button>
                       ';



                })


                ->editColumn('image', function ($row) {
                    return ' <img height="60px" src="' . get_file($row->image) . '" class=" w-60 rounded"
                             onclick="window.open(this.src)">';
                })




                ->editColumn('created_at', function ($admin) {
                    return date('Y/m/d', strtotime($admin->created_at));
                })
                ->escapeColumns([])
                ->make(true);


        }
        else{
           // $this->add_log_activity(null, auth('admin')->user(), "تم عرض  الاقسام");

        }
        return view('Admin.CRUDS.categories.index');
    }


    public function create()
    {

        return view('Admin.CRUDS.categories.parts.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|unique:categories,title',
            'image'=>'nullable|mimes:jpeg,jpg,png,gif,svg,webp,avif',

        ]);
        if ($request->image)
        $data["image"] =  $this->uploadFiles('categories',$request->file('image'),null );


    $category=Category::create($data);

    //    $this->add_log_activity($category,auth('admin')->user(),"  تم اضافة قسم باسم $category->title ");


        return response()->json(
            [
                'code' => 200,
                'message' => 'success!'
            ]);
    }



    public function edit(Category $category)
    {




        return view('Admin.CRUDS.categories.parts.edit', compact('category'));

    }

    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'title' => 'required|unique:categories,title,'.$category->id,
            'image'=>'nullable|mimes:jpeg,jpg,png,gif,svg,webp,avif',

        ]);
        if ($request->image)
            $data["image"] =  $this->uploadFiles('categories',$request->file('image'),null );

        $old=$category;

        $category->update($data);

       // $this->add_log_activity($old,auth('admin')->user(),"تم  تعديل بيانات القسم    $category->title ");


        return response()->json(
            [
                'code' => 200,
                'message' => 'success!'
           ]);
    }


    public function destroy(Category $category)
    {
        $old=$category;
        $category->delete();

        $this->add_log_activity($old,auth('admin')->user()," تم   حذف بيانات القسم    $old->title ");


        return response()->json(
            [
                'code' => 200,
                'message' => 'success!'
            ]);
    }//end fun


}
