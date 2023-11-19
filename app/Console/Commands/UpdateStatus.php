<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use App\Models\Payment;
use App\Models\Transaction;
use Carbon\carbon;


class UpdateStatus extends Command
{
   
    protected $signature = 'transaction:update-status';
    protected $description = 'Update transaction status';

    public function handle()
    {

        $transactions = Transaction::all();

        foreach ($transactions as $transaction) {

            $dueDate = Carbon::parse($transaction->due_on);

            $currentDate = Carbon::now();

            if ($currentDate->gt($dueDate)) {

                $status = 'overdue';
            } else {

                $status = 'outstanding';
            }

            $totalPaid = Payment::where('transaction_id', $transaction->id)->sum('amount');

            if ($totalPaid > 0) {
                
                $status = 'overdue';
            }

            if ($totalPaid >= $transaction->amount) {
                
                $status = 'paid';
            }

            $transaction->update(['status' => $status]);

        }
    }






}
