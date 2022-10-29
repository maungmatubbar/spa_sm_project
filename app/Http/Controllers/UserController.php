<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use function Psr\Log\error;

class UserController extends Controller
{
    private $user;
    public function login(Request $request)
    {
        $request->validate([
            'email'   => 'required|email',
            'password'=> 'required'
        ]);
        try {
            $this->user = User::where('email',$request->email)->first();
            if(!empty($this->user->email))
            {
                if(password_verify($request->password,$this->user->password))
                {
                    if(!Auth::attempt(['email'=>$request->email,'password'=>$request->password]))
                    {
                        return response()->json([
                            'status' => false,
                            'errors' => 'Credential does not match our records.'
                        ],Response::HTTP_UNAUTHORIZED);
                    }
                    $this->user = User::where('email',$request->email)->first();
                    return response()->json([
                        'status' => true,
                        'data'   => $this->user,
                        'token'  => $this->user->createToken($this->user->name)->plainTextToken,
                        'message'=> 'User logged in successfully.'
                    ],Response::HTTP_OK);

                }
                else
                {
                    return response()->json([
                        'status' => false,
                        'errors' => [
                            'error' => ["Password not match."]
                        ]
                    ],Response::HTTP_NOT_ACCEPTABLE);
                }
            }
            else
            {
                return response()->json([
                    'status' => false,
                    'errors' => [
                        'error' => ["Email does not exits."]
                    ]
                ],Response::HTTP_NOT_ACCEPTABLE);
            }
        }
        catch (\Exception $ex)
        {
            return response()->json([
                'status' => false,
                'errors' => [
                    'error' => $ex->getMessage()
                ]
            ],Response::HTTP_NOT_ACCEPTABLE);
        }


    }
    public function getUserInfo()
    {
        try {
            $this->user = User::where('id',Auth::user())->first();
            return response()->json([
                'status' => true,
                'data' => $this->user
            ],Response::HTTP_ACCEPTED);
        }
        catch (\Exception $exception)
        {
            return response()->json([
                'status' => false,
                'errors' => [
                    'error' => $exception->getMessage()
                ]
            ],Response::HTTP_NOT_ACCEPTABLE);
        }
    }
}
