<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ClientResource;
use App\Http\Resources\GovernorateResource;
use App\Http\Traits\Api_Trait;
use App\Models\Governorate;
use Illuminate\Http\Request;

class GovernorateApiController extends Controller
{
    //
    use Api_Trait;
    //
    public function index(Request $request){
        $rows=Governorate::get();

        return $this->returnData(GovernorateResource::collection($rows),['done'],200);
    }
}
