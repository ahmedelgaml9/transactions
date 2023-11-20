<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use  App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Validator;
use Hash;

class AuthController extends Controller
{
  
    public function login(Request $request)
    {
        
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){

              $user = Auth::user();
              $success['token'] =  $user->createToken('auth-token')->plainTextToken;
              $success['id'] =  $user->id;
              $success['name'] =  $user->name;

               return $this->sendResponse($success , 'data success');
          }
          
         else{

             return $this->sendError([], 'unauthorized',401);
         }
    }
    
    public function createUser(Request $request)
    {
        
         $validator = Validator::make($request->all(),[

               'name' => 'required',
               'email' => 'required|email|unique:users,email,'.auth()->id(),
               'password'=>'required',
          ]);

          if($validator->fails()) {

               return $this->sendError($validator->errors(),'خطأ فى التحقق' ,422);
          }  

          $user = User::create([
            
                'name' => $request->name,
                'email' => $request->email,
                'user_type' =>'user',
                'password' => Hash::make($request->password)
            ]);

            return $this->sendResponse(new UserResource($user), 'user generated successfully');
    }  


}
