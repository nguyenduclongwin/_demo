<?php

namespace App\Http\Controllers\API;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Service\RegisterController;
use App\Http\Requests\RegisterFormRequest;
use Illuminate\Http\Response;

class AuthController extends RegisterController
{
    public function register(Request $request){
        $input= $request->all();
        $validator=Validator::make($input,[
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|max:10',
        ]);
        if($validator->fails()){
            return $this->sendError('Validator error',$validator->errors());
        }
        $this->store($input);
        $response=[
            'name'=>$input['name'],
            'email'=>$input['email']
        ];
        return $this->sendResponse($response,'Register Successfully');
    }
    public function login(Request $request){
        $input=$request->all();
        $valid_email=User::where('email','=',$input['email'])->get();
        if(!$valid_email){
            return $this->sendError('email not exists');
        }
        else{
            $valid_pass=User::where('email','=',$input['email'])->where('password','=',$input['password']);
            if(!$valid_pass){
                return $this->sendError('password false');
            }else{
                return $this->sendResponse()
            }
        }
    }
}
