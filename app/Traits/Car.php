<?php

namespace App\Traits;

use App\Models\CarDetail\Car as CarModel;

trait Car {

    public function saveCar(array $carArray): string
    {
        $carArray['ref_no'] = $this->generateReference();
        $car = CarModel::updateOrCreate(['id' => $carArray['id']],$carArray);
        if($car){
            return "successfully created $car->name (Ref:$car->ref_no)";
        }else{
            return "Error Occurred.Try Again!";
        }
        
    }

    private function generateReference(): string
    {
        return 'CAR'.time();
    }
    
}