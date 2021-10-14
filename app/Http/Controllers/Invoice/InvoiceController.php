<?php

namespace App\Http\Controllers\Invoice;

use Illuminate\Http\Request;
use App\Models\Invoice\Invoice;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\CarDetail\Car as CarDetail;

class InvoiceController extends Controller
{
    public function getInvoiceForm($id){
        $car=CarDetail::find($id);
        return view('invoices.form',compact(['car']));
    }

    public function saveInvoice(Request $request){
        $request->validate([
            'person_name' => 'required',
            'nic_number' => 'required|regex:/^[a-zA-Z0-9]+$/',
            'num_hrs' => 'required|numeric',
        ]);
        
        $user=User::where('nic_number','=',$request->nic_number)->first(); 

        $num_of_hrs=(float)$request->num_hrs;
        $rent_price=(float)$request->renting_price;

        if($user){
            //update user name
            $user->name=$request->person_name;
            $user->save();
           
        }else{
            //save user data
            $user=User::updateOrCreate(['id'=>null],["name"=>$request->person_name,"nic_number"=>$request->nic_number]);
           
        }

        if($user){
            $invoiceData = [
                'id'=>null,
                'user_id' => $user->id,
                'car_id' => $request->car_id,
                'number_of_hrs' => $num_of_hrs,
                'sub_total' => ($num_of_hrs*$rent_price),
                'discount' => $request->discount
            ];
            $invoice = Invoice::updateOrCreate(['id' => null],$invoiceData);
            
            if($invoice){
                return response()->json(["message"=>"Invoice Saved Successfully!"]);
            }else{
                return response()->json(["message"=>"Error Occurred.Try Again!"]);
            }
        }else{
            return response()->json(["message"=>"Error Occurred.Try Again!"]); 
        }
        
    }

    public function hasDiscount(Request $request){ 
        $user=User::with(["invoices"])->where('nic_number','=',$request->person_nic)->first(); 

        if($user && count($user->invoices)>5){
            return response()->json(["has_discount"=>true]);
        }else{
            return response()->json(["has_discount"=>false]);
        }
    }
}
