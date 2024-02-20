<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User ;
use Illuminate\Support\Facades\Hash;
use App\Http\Traits\GeneralTrait ;

class AuthController extends Controller
{
    use GeneralTrait ; 

    public function RegisterUser(request $request)
    {
        $validator = Validator::make($request->all(), [
        
            'name' =>'required|unique:users|regex:/[a-z]/',
            'email' =>'required|email|unique:users,email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->requiredField($validator->errors()->first());
        }
        try{

            $user = User::Create([
                'name' => $request->name ,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            return response()->json([
                'status' => true ,
                'message' =>'user created successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ],200) ;
        }catch(\Throwable $th)
        {
            return response()->json([
                'status'=> false ,
                'message' => $th->getMessage()
            ],500) ;
        }
    }
    public function LoginUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        if ($validator->fails()) {
            return $this->requiredField($validator->errors()->first());
        }

        try {

            $user = User::where('email', $request->input('email'))->first();

               
            if (!$user) {
                return $this->apiResponse(null, false, 'Invalid email .', 401);
            }

            if (!Hash::check($request->input('password'), $user->password)) {
                return $this->apiResponse(null, false, 'Invalid phone password.', 401);
            }

            // Generate a token for the user

            $data = [
                'status' => true ,
                'message' => 'User logged in successfully .' ,
                'token' => $user->createToken('API TOKEN')->plainTextToken 
            ] ;

            return $this->apiResponse($data, true, null, 200);
        } catch (\Exception $ex) {
            return $this->apiResponse(null, false, $ex->getMessage(), 500);
        }
    }

    public function LogoutUser(Request $request)
    {
        try {
            $user = auth('sanctum')->user();

            if ($user) {
                $user->tokens()->delete();
                return $this->apiResponse([], true, null, 200);
            }else {
                return $this->unAuthorizeResponse();
            }

        } catch (\Exception $ex) {
            return $this->apiResponse(null, false, $ex->getMessage(), 500);
        }
    }
}
