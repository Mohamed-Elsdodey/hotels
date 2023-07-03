<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\HowToGetPointResource;
use App\Http\Traits\Api_Trait;
use App\Models\HowToGetPoint;
use Illuminate\Http\Request;


class HowToGetPointApiController extends Controller
{
    use Api_Trait;
    //
    public function index(Request $request){

        $rows=HowToGetPoint::with(['level'])->get();

        return $this->returnData(HowToGetPointResource::collection($rows),['done'],200);

    }
}
