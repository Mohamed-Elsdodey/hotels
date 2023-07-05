<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryRent extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function mainCategory(){
        return $this->belongsTo(CategoryRent::class,'from_id');
    }
}
