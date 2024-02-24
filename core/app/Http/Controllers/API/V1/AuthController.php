<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if ($validator->fails())
        {
            $response = [
                'status' => 'fail',
                'message' => 'Validation Failed',
                'errors' => $validator->errors()->all(),
                'data' => ''
            ];
            return response($response, 422);
        }

        try {
            if( Auth::attempt(['email'=>$request->email, 'password'=>$request->password]) ) {
                $user = Auth::user();
                $token = $user->createToken($user->email.'-'.now())->accessToken;
                $response = [
                    'status' => 'success',
                    'message' => 'Login Successful',
                    'errors' => '',
                    'data' => [
                        'user' => $user,
                        'token' => $token
                    ]
                ];
            }
            else {
                $response = [
                    'status' => 'fail',
                    'message' => 'Authentication Failed',
                    'errors' => '',
                    'data' => ''
                ];
            }
            return response($response, 200);
        }
        catch (\Exception $ex) {
            $response = [
                'status' => 'fail',
                'message' => 'Exception',
                'errors' => $ex->getMessage(),
                'data' => ''
            ];
            return response($response, 500);
        }
    }

    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required',
        ]);
        if ($validator->fails())
        {
            $response = [
                'status' => 'fail',
                'message' => 'Validation Failed',
                'errors' => $validator->errors()->all(),
                'data' => ''
            ];
            return response($response, 422);
        }

        try {
            $user = User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => bcrypt($request['password']),
                'role' => $request['role'],
                'remember_token' => Str::random(10)
            ]);

            $access_token = $user->createToken($user->email.'-'.now())->accessToken;
            $response = [
                'status' => 'success',
                'message' => 'Registration Successful',
                'errors' => '',
                'data' => [
                    'user' => $user,
                    'access_token' => $access_token
                ]
            ];
            return response($response, 200);
        }
        catch (\Exception $ex) {
            $response = [
                'status' => 'fail',
                'message' => 'Exception',
                'errors' => $ex->getMessage(),
                'data' => ''
            ];
            return response($response, 500);
        }
    }

    public function verifyToken(Request $request) {
        try {

            $response = [
                'status' => 'success',
                'message' => 'You have been successfully logged out!',
                'errors' => '',
                'data' => ''
            ];
            return response($response, 200);
        }
        catch (\Exception $ex) {
            $response = [
                'status' => 'fail',
                'message' => 'Exception',
                'errors' => $ex->getMessage(),
                'data' => ''
            ];
            return response($response, 500);
        }
    }

    public function logout(Request $request) {
        try {
            $user = Auth::user()->token();
            $user->revoke();
            $response = [
                'status' => 'success',
                'message' => 'You have been successfully logged out!',
                'errors' => '',
                'data' => ''
            ];
            return response($response, 200);
        }
        catch (\Exception $ex) {
            $response = [
                'status' => 'fail',
                'message' => 'Exception',
                'errors' => $ex->getMessage(),
                'data' => ''
            ];
            return response($response, 500);
        }
    }
}
