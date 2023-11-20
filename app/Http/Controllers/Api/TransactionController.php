<?php

namespace App\Http\Controllers\Api;
use App\Http\Requests\TransactionRequest;
use Illuminate\Http\Request;
use App\Models\Transaction;
use  App\Http\Controllers\Controller;
use App\Http\Resources\TransactionResource;
use Validator;



class TransactionController extends Controller
{
    
    public function index()
    {

        $transactions = Transaction::get();

        return $this->sendResponse(TransactionResource::collection($transactions) ,'transaction viewed successfully');

    }

    public function userTransactions()
    {

        $transactions = Transaction::where('payer',auth()->user()->id)->get();

        return $this->sendResponse($transactions , 'transaction viewed successfully');

    }

    public function store(Request $request)
    {
        
         $validator = Validator::make($request->all(),[

                'amount'=>'required',
                'payer' => 'required',
                'due_on' => 'required|date_format:Y-m-d',
                'vat' =>'required',
                'is_vat'=>'required',
         ]);
   
         if($validator->fails()) {

               return $this->sendError($validator->errors(),'خطأ فى التحقق' ,422);
         }  

         $transaction = Transaction::create($request->all());

          return $this->sendResponse([], 'transaction added successfully');

    }


}
