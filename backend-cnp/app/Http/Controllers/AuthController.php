<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthLoginRequest;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(AuthLoginRequest $request)
    {
        $input = $request->validated();
        $token = auth()->attempt($input);
        $userType = auth()->user()->user_type;
        if (!$token) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }
        return response()->json([
            'user_type' => $userType,
            'token' => $token,
            'token_type' => 'bearer',
        ]);
    }
    public function register(Request $request)
    {
        $input = $request->all();
        $userHasBeenExist = User::where('email', $input['email'])->first();
        if(!empty($userHasBeenExist)) {
            return response()->json([
                'message' => 'User has been exist'
            ], 401);
        }
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        return $user;        
    }

}

