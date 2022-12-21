<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\PostResource;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:api') ;
    }  
    
    
    public function index()
    {
        $user = auth('api')->user() ;

        if(!$user){
            return response()->json(['error'=> true , 'message'=>'Unauthorized' ], 200) ;
        }
        return PostResource::collection($user->posts) ;
    }
}
