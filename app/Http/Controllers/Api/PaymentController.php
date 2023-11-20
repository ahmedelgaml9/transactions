<?php

namespace App\Http\Controllers\Api;
use App\Http\Requests\PaymentRequest;
use Illuminate\Http\Request;
use  App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Payment;
use Validator;

class PaymentController extends Controller
{
    
    public function storePayments(Request $request)
    {

          $validator = Validator::make($request->all(),[

               'transaction_id' => 'required',
                'amount' => 'required',
                'paid_on' => 'required|date_format:Y-m-d'
          ]);

           if($validator->fails()) {
  
               return $this->sendError($validator->errors(),'خطأ فى التحقق' ,422);
          }  

          $transaction = Transaction::find($request->transaction_id);
          
          if(!$transaction)
          {

             return $this->sendError([],'transaction not found' ,404);

          }

          $payment = Payment::create($request->all());

          return $this->sendResponse([] ,'payment added successfully');
    }

}
