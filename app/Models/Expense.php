<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function Main(){
        return $this->belongsTo(ExpenseCategory::class,'main_expense_category_id');
    }

    public function sub(){
        return $this->belongsTo(ExpenseCategory::class,'sub_expense_category_id');
    }
}
