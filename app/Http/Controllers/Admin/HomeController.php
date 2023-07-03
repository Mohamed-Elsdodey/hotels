<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\LogActivityTrait;
use App\Http\Traits\Upload_Files;
use App\Models\Activity;
use App\Models\Admin;
use App\Models\City;
use App\Models\Client;
use App\Models\Contact;
use App\Models\Currency;
use App\Models\Order;
use App\Models\Service;
use App\Models\Store;
use App\Models\Subscription;
use App\Models\User;
use App\Models\Vendor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    use Upload_Files;

    public function index()
    {

        $admins=Admin::count();

        return view('Admin.home.index',compact('admins'));
    }//end fun



    public function calender(Request $request)
    {
        $arrResult =[];
        $orders = Order::get();
        //get count of orders by days
        foreach ($orders as $row) {
            $date = date('Y-m-d', strtotime($row->date_order));
            if (isset($arrResult[$date])) {
                $arrResult[$date]["counter"] += 1;
                $arrResult[$date]["id"][]  = $row->id;
            } else {
                $arrResult[$date]["counter"] = 1;
                $arrResult[$date]["id"][]  = $row->id;

            }
        }
        //  dd($arrResult);
        //make format of calender
        $Events = [];
        if (count($arrResult)>0) {
            $i = 0;
            foreach ($arrResult as $item => $value) {
                $title= $value['counter'];
                $Events[$i] = array(
                    'id' => $i,
                    'title' => $title,
                    'start' => $item,
                    'ids' => $value['id'],
                );
                $i++;
            }
        }
        //return to calender
        return $Events ;
    }//end fun



}//end clas
