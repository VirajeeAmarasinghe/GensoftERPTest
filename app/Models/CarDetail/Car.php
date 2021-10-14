<?php

namespace App\Models\CarDetail;

use App\Models\Invoice\Invoice;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CarDetail\CarModel;

class Car extends Model
{
    use HasFactory;

    protected $table = 'tbl_cars';
    public $timestamps = false;

    protected $fillable = [
        'ref_no',
        'name',
        'engine_number',
        'chassis_number',
        'color',
        'car_rent_price_per_hour',
        'number_plate',
        'transmition',
        'model_id'
    ];

    public function model()
    {
        return $this->belongsTo(CarModel::class,'model_id', 'id');
    }

    public function invoices(){
        return $this->hasMany(Invoice::class);
    }

}
