<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    
    public function toArray($request)
    {

        $customer = $this;
    
         return [

            'id' => $customer->id,
            'name' => $customer->name,
            'email' => $customer->email,
            
        ];
    }

}
