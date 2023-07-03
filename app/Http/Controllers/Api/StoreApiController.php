<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\StoreResource;
use App\Http\Resources\TypeResource;
use App\Http\Traits\Api_Trait;
use App\Models\Store;
use App\Models\UserType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StoreApiController extends Controller
{
    use Api_Trait;
    //
    public function index(Request $request){


        $rows=Store::get();

        return $this->returnData(StoreResource::collection($rows),['done'],200);
    }
}
