<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CharityResource;
use App\Http\Traits\Api_Trait;
use App\Models\Charity;
use Illuminate\Http\Request;

class CharityApiController extends Controller
{
    //
    use Api_Trait;
    //
    public function index(Request $request){
        $rows=Charity::get();

        return $this->returnData(CharityResource::collection($rows),['done'],200);
    }
}
