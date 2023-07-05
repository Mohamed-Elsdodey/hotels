<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseCategory extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function mainCategory(){
        return $this->belongsTo(ExpenseCategory::class,'from_id');
    }
}
