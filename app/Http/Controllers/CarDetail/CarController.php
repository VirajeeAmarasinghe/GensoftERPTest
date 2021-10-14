<?php

namespace App\Http\Controllers\CarDetail;

use DataTables;
use App\Http\Controllers\Controller;
use App\Models\CarDetail\CarModel;
use App\Traits\Car;
use Illuminate\Http\Request;
use App\Models\CarDetail\CarModel as Model;
use App\Models\CarDetail\CarBrand as Brand;
use App\Models\CarDetail\Car as CarDetail;

class CarController extends Controller
{
    use Car;

    public function index()
    {        
         $cars = CarDetail::with(['model','model.brand'])->paginate(10);
         return view('car-details.cars.index',compact('cars'));
    }

    public function carList(Request $request){ 
        if($request->ajax()){
            $cars = CarDetail::with(['model','model.brand'])->get();
            return DataTables::of($cars)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="'.route("car.form",["id"=>$row->id]).'" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a> <a href="'.route("invoice",["id"=>$row->id]).'" class="invoice btn btn-primary btn-sm">Invoice</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function form($id)
    {
        $car=CarDetail::with(['model','model.brand'])->find($id); 
        
        $brands = Brand::get();
        $models = Model::get();
        return view('car-details.cars.components.form',compact(['car','brands','models']));
    }

    public function save(Request $request)
    { 

        $request->validate([
            'car_model' => 'required',
            'car_name'=>'required',
            'rent_price'=>'required|numeric',
            'number_plate'=>'required|regex:/^[a-zA-Z0-9-]+$/',
            'eng_number'=>'nullable|regex:/^[a-zA-Z0-9]+$/',
            'chas_number'=>'nullable|regex:/^[a-zA-Z0-9]+$/'
        ]);

        $carArray = [
            'id'=>$request->id,
            'model_id' => $request->car_model,
            'name' => $request->car_name,
            'color' => $request->car_color,
            'engine_number' => $request->eng_number,
            'chassis_number' => $request->chas_number,
            'car_rent_price_per_hour'=>$request->rent_price,
            'number_plate'=>$request->number_plate,
            'transmition' => $request->car_trans
        ];

        $message=$this->saveCar($carArray);

        return response()->json(["message"=>$message]);
    }

}
