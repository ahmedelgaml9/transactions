<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Models\Transaction;
use  App\Http\Controllers\Controller;
use Validator;

class TransactionController extends Controller
{
    
    public function index()
    {

        $transactions = Transaction::get();

        return $this->sendResponse($transactions , 'success data');

    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [

             'amount' => 'required',
             'payer' => 'required',
             'due_on' => 'required',
             'vat' =>'required',
             'is_vat'=>'required',
        ]);

        if ($validator->fails()) {

            return $this->sendError($validator->errors(),'خطأ فى التحقق' ,442);
        }

        $transaction = Transaction::create($request->all());

        return $this->sendResponse($transaction , 'transaction added successfully');

    }


}
