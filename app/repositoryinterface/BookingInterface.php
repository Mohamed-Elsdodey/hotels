<?php

namespace App\repositoryinterface;


use Illuminate\Http\Request;

interface BookingInterface
{


    public function all();
    public function getRoomsInBooking(Request $request);
    public function get_by_id($id);


}

































?>
