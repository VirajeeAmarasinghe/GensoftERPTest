<?php

namespace App\Models\Invoice;

use App\Models\User;
use App\Models\CarDetail\Car;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable=['user_id','car_id','number_of_hrs','sub_total','discount'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function car(){
        return $this->belongsTo(Car::class);
    }
}
