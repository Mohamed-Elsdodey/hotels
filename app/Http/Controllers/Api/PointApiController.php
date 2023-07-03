<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PointResource;
use App\Http\Traits\Api_Trait;
use App\Models\Point;
use Illuminate\Http\Request;

class PointApiController extends Controller
{
    use Api_Trait;
    //
    public function index(Request $request){
        $rows=Point::with(['user'])->get();

        return $this->returnData(PointResource::collection($rows),['done'],200);
    }
}
