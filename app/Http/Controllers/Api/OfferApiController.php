<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OfferResource;
use App\Http\Traits\Api_Trait;
use App\Models\Offer;
use Illuminate\Http\Request;

class OfferApiController extends Controller
{
    use Api_Trait;
    //
    public function index(Request $request){
        $rows=Offer::with(['level','governorate','client','store','type'])->get();

        return $this->returnData(OfferResource::collection($rows),['done'],200);
    }
}
