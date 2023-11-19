<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use  App\Http\Controllers\Controller;
use App\Models\Payment;
use Validator;

class PaymentController extends Controller
{
    
    public function storePayments(Request $request)
    {

         $validator = Validator::make($request->all(), [

             'transaction_id' => 'required',
             'amount' => 'required',
             'paid_on' => 'required',
             
         ]);

         if($validator->fails()) {

             return $this->sendError($validator->errors(),'خطأ فى التحقق' ,442);
         }

         $payment = Payment::create($request->all());

          return $this->sendResponse([] ,'payment added successfully');
    }

   
}
