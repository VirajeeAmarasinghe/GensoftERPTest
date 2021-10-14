@extends('layouts.master')

@section('content')
    <div class="panel panel-primary col-sm-offset-3 col-sm-6">
        <div class="panel-heading"><div class="col-sm-offset-5">Add Invoice</div></div>
        <div class="panel-body">
                <form action="{{route('invoice.save')}}" method="POST" id="car-form">
                    @csrf
                    <input type="hidden" name="car_id" value="{{ $car->id }}">
                    <div class="form-group">
                        <label for="person_name">Name of the Person:</label>
                        <input type="text" class="form-control" name="person_name" id="person_name" value="{{ old('person_name') }}" required>
                        <span class="text-danger" id="person_name_error"></span>
                    </div>
                    
                    <div class="form-group">
                        <label for="nic_number">NIC Number:</label>
                        <input type="text" class="form-control" name="nic_number" id="nic_number" value="{{ old('nic_number') }}" required>
                        <span class="text-danger" id="nic_number_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="car_reference_num">Car Reference Number:</label>
                        <input type="text" class="form-control" name="car_reference_num" id="car_reference_num" value="{{ $car->ref_no }}" readonly>
                        <span class="text-danger" id="car_reference_num_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="car_number_plate">Car Number Plate:</label>
                        <input type="text" class="form-control" name="car_number_plate" id="car_number_plate" value="{{ $car->number_plate }}" readonly>
                        <span class="text-danger" id="car_number_plate_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="renting_price">Car Renting Price per Hr:</label>
                        <input type="text" class="form-control" name="renting_price" id="renting_price" value="{{ $car->car_rent_price_per_hour }}" readonly>
                        <span class="text-danger" id="renting_price_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="num_hrs">Number of Hours Rented:</label>
                        <input type="text" class="form-control" name="num_hrs" id="num_hrs" value="{{ old('num_hrs') }}" required>
                        <span class="text-danger" id="num_hrs_error"></span>
                    </div>
                    <div class="form-group" id="div-discount">
                        <label for="discount">Discount:</label>
                        <input type="text" class="form-control" name="discount" id="discount" readonly value="{{ old('discount') ? old('discount') : 0.00}}">
                        <span class="text-danger" id="discount_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="discount">Total Cost:</label>
                        <input type="text" class="form-control" name="total_cost" id="total_cost" readonly value="{{ old('total_cost')}}">
                        <span class="text-danger" id="total_cost_error"></span>
                    </div>
                    
                    <button type="submit" class="btn-sm btn-primary pull-right" id="btn-submit-invoice">Submit</button>
                </form>
        </div>
    </div>
@endsection