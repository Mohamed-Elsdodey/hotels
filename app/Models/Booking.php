<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class,'hotel_id');

    }
    public function categoryroom()
    {
        return $this->belongsTo(RoomsCategory::class,'category_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class,'client_id');
    }
    public function publisher()
    {
        return $this->belongsTo(Admin::class,'publisher');
    }

    public function bookingdetails(){
        return $this->hasMany(BookingDetails::class,'booking_id');
    }

}
