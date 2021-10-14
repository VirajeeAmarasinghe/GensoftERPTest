@extends('layouts.master')

@section('content')
    <div class="panel panel-primary col-sm-offset-3 col-sm-6">
        <div class="panel-heading"><div class="col-sm-offset-5">Add Cars</div></div>
        <div class="panel-body">
                <form action="{{route('car.save')}}" method="POST" id="car-form">
                    @csrf
                    <input type="hidden" name="id" value="{{ !is_null($car) ? $car->id : null }}">
                    <div class="form-group">
                        <label for="car_brand">Brand:</label>
                        <select class="form-control" name="car_brand" id="car_brand">
                            <option value="">Pleace Select Brand</option>
                            @foreach($brands as $brand)
                                <option value="{{$brand->id}}"  {{ (($brand->id==old('car_brand'))||((!is_null($car)) && ($brand->id==$car->model->brand->id))) ? 'selected' : '' }}>{{$brand->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="car_model">Model:</label>
                        <select class="form-control" name="car_model" id="car_model" required>
                            <option value="">Pleace Select Model</option>
                            @foreach($models as $model)
                                <option value="{{$model->id}}" {{ (($model->id==old('car_model'))||((!is_null($car)) && ($model->id==$car->model_id))) ? 'selected' : '' }}>{{$model->name}}</option>
                            @endforeach
                        </select>
                        <span class="text-danger" id="car_model_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="car_name">Car Name:</label>
                        <input type="text" class="form-control" name="car_name" id="car_name" required value="{{ old('car_name') ? old('car_name'): !is_null($car) ? $car->name : '' }}">
                        <span class="text-danger" id="car_name_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="car_color">Car Color:</label>
                        <input type="text" class="form-control" name="car_color" id="car_color" value="{{ old('car_color') ? old('car_color'): !is_null($car) ? $car->color : '' }}">
                        <span class="text-danger" id="car_color_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="car_color">Engine Number:</label>
                        <input type="text" class="form-control" name="eng_number" id="eng_number" value="{{ old('eng_number') ? old('eng_number'): !is_null($car) ? $car->engine_number : '' }}">
                        <span class="text-danger" id="eng_number_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="chas_number">Chassis Number:</label>
                        <input type="text" class="form-control" name="chas_number" id="chas_number" value="{{ old('chas_number') ? old('chas_number'): !is_null($car) ? $car->chassis_number : '' }}">
                        <span class="text-danger" id="chas_number_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="rent_price">Car Rent Price Per Hour:</label>
                        <input type="text" class="form-control" name="rent_price" id="rent_price" required value="{{ old('rent_price') ? old('rent_price'): !is_null($car) ? $car->car_rent_price_per_hour : '' }}">
                        <span class="text-danger" id="rent_price_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="rent_price">Number Plate:</label>
                        <input type="text" class="form-control" name="number_plate" id="number_plate" required value="{{ old('number_plate') ? old('number_plate'): !is_null($car) ? $car->number_plate : '' }}">
                        <span class="text-danger" id="number_plate_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="car_trans">Transmission:</label>
                        <select class="form-control" name="car_trans" id="car_trans">
                            <option {{ (('Auto'==old('car_trans'))||((!is_null($car)) && ('Auto'==$car->transmition))) ? 'selected' : '' }}>Auto</option>
                            <option {{ (('Manual'==old('car_trans'))||((!is_null($car)) && ('Manual'==$car->transmition))) ? 'selected' : '' }}>Manual</option>
                            <option {{ (('Tiptronic'==old('car_trans'))||((!is_null($car)) && ('Tiptronic'==$car->transmition))) ? 'selected' : '' }}>Tiptronic</option>
                        </select>
                        <span class="text-danger" id="car_trans_error"></span>
                    </div>
                    <button type="submit" class="btn-sm btn-primary pull-right" id="btn-submit">Submit</button>
                </form>
        </div>
    </div>
@endsection