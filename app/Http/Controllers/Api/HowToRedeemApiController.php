<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\HowToRedeemResource;
use App\Http\Traits\Api_Trait;
use App\Models\HowToRedeem;
use Illuminate\Http\Request;

class HowToRedeemApiController extends Controller
{
    //
    use Api_Trait;
    public function index(Request $request){
        $rows=HowToRedeem::with(['level','client','governorate','type'])->get();

        return $this->returnData(HowToRedeemResource::collection($rows),['done'],200);

    }
}
