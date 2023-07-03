<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TypeResource;
use App\Http\Resources\UserTypeResource;
use App\Http\Traits\Api_Trait;
use App\Models\UserType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserTypeApiController extends Controller
{
    //
    use Api_Trait;
    //
    public function index(Request $request){

        $validator = Validator::make($request->all(),
            [
                'client_id' => 'required|exists:clients,id',
            ], []);
        if ($validator->fails()) {
            return  $this->returnErrorValidation(collect($validator->errors())->flatten(1),403);
        }
        $rows=UserType::where('client_id',$request->client_id)->get();

        return $this->returnData(TypeResource::collection($rows),['done'],200);
    }
}
