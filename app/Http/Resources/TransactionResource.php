<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    
    public function toArray($request)
    {

        $transaction = $this;
    
         return [

            'id' =>  $transaction->id ,
            'amount' => $transaction->name,
            'vat' => $transaction->vat,
            'payer'=> $transaction->user->name,
            'due_on'=> $transaction->due_on 
            
        ];
    }

}
