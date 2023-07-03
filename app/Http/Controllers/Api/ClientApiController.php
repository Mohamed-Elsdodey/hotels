<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ClientResource;
use App\Http\Traits\Api_Trait;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientApiController extends Controller
{
    use Api_Trait;
    //
    public function index(Request $request){
        $rows=Client::with(['currency'])->get();

        return $this->returnData(ClientResource::collection($rows),['done'],200);
    }
}
