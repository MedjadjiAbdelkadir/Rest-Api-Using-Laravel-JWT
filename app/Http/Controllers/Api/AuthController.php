<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Auth;
use JWTAuth;
use App\GeneralTrait;
use Traits\GeneralTrait as TraitsGeneralTrait;

class AuthController extends Controller{
    
    //--------------------------------------------------------------------------------------//
    use TraitsGeneralTrait;
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    
    //--------------------------------------------------------------------------------------//
    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:8',
        ]);
        if($validator->fails()){
            // return $this->returnError(400, $validator->errors());
            
            // return response()->json($validator->errors()->toJson(), 400);
        }
        $user = User::create(array_merge(
                    $validator->validated(),
                    ['password' => bcrypt($request->password)]
                ));
        $token = $user->createToken('Laravel Password Grant Client')->accessToken;
        return response()->json([
            '' => $token ,
            'message' => 'User successfully registered',
            'user' => $user
        ], 201);

    } // End register function

    //--------------------------------------------------------------------------------------//

    public function login(Request $request){
    	$validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:5',
        ]);

        if ($validator->fails()) {

            return response()->json($validator->errors(), 422);
        }

        $credentials = request(['email', 'password']);

        // ! $token = auth()->attempt($validator->validated())
        // !$token = auth('api')->attempt($credentials)

        if (!$token = auth('api')->attempt($credentials)) {
            return $this->returnError(400, 'Email or Password incorect');
            // return response()->json(['error'=> true , 'message'=>'Email or Password incorect'], 401);
        }
        return $this->createNewToken($token);
    }
    //--------------------------------------------------------------------------------------//


    public function userProfile() {
        return response()->json(auth()->user());

    } // End userProfile function
    
    //--------------------------------------------------------------------------------------//

    public function refresh() {
        return $this->createNewToken(auth()->refresh());
    } // End refresh function

    //--------------------------------------------------------------------------------------//

    public function logout() {
        auth()->logout();
        return response()->json(['message' => 'User successfully signed out']);
    } // End logout function

    //--------------------------------------------------------------------------------------//

    protected function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'user' => auth('api')->user()
        ]);

    } // End createNewToken function


}  // End AuthController Class
