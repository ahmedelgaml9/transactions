<?php

namespace App\Services;
use App\Models\Transaction;
use App\Models\Payment;
use Carbon\carbon;



 class TransactionService{


    public function changeStatus($payment)
    {

        $transaction = Transaction::where('id', $payment->transaction_id)->first();

        $due_date = $transaction->due_on->format('Y-m-d');
        $amount = $transaction->amount ;
        $now  = Carbon::now()->format('Y-m-d');


        if($now < $due_date && $transaction->amount < $amount)
        {

            $transaction->update(['status'=>'outstanding']);

        }

        if($now >= $due_date && $transaction->amount < $amount)
        {

            $transaction->update(['status'=>'overdue']);

        }

        if($now < $due_date && $transaction->amount == $amount)
        {

            $transaction->update(['status'=>'paid']);

        }

        return "true";
    }


    
}