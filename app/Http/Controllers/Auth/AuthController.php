<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\ChangePasswordRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function register(RegisterRequest $request)
    {
            $request->validated();
            $salt='';
            $user = new User();
            $user->name = $request['name'];
            $user->email = $request['email'];
            $user->role = $request['role'];
            $user->password = bcrypt($request['password']);
            $user->gender = $request['gender'];
            $user->save();
            $token = $user->createToken(time())->plainTextToken;


            if ($request['role']==1)
            {
                $salt.='eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJoZWxsbyI6ImhlbGxvIn0.mzFAbbzRu-Oada93Er2zZj2eDdTcDpe1vLeRLAGCCPc';

            }
            elseif($request['role']==2)
            {
                $salt.='eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJieWVieWUiOiJieWVieWUifQ.EO2FQLVSrgS74bZHch0kxu-HzUK56osW8BdT7WShyoU';

            }


            $response = [
                'data'  =>$user,
                'role'  =>$user->role,
                'token' =>$token,
                'salt' =>$salt
            ];
            return response($response, 201);
    }

    public function login(LoginRequest $request)
    {
        $request->validated();

        //Check email
        $user = User::where('email', $request['email'])->first();


        //Check Password
        if (!$user || !Hash::check($request['password'], $user->password)) {

            return(response()->json(['errors' => 'Bad Credentials'], 401));

        }

        $token = $user->createToken(time())->plainTextToken;

        if ($user->role === 0)
        {
            $salt='eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJoYWJsbGxsIjoiaGhoaGgifQ.YW5xOWv0c2kyAY_GU1M5XZmJehS5wOZcehZg2KIHs-A';
        }
        elseif ($user->role === 1)
        {
            $salt='eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJoZWxsbyI6ImhlbGxvIn0.mzFAbbzRu-Oada93Er2zZj2eDdTcDpe1vLeRLAGCCPc';

        }
        elseif($user->role === 2)
        {
            $salt='eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJieWVieWUiOiJieWVieWUifQ.EO2FQLVSrgS74bZHch0kxu-HzUK56osW8BdT7WShyoU';

        }


        $response = [
            'data' => $user,
            'role' => $user->role,
            'token' => $token,
            'salt'=>$salt
        ];

        return response($response, 201);
    }

    public function changepassword(ChangePasswordRequest $request)
    {
        $request->validated();

        $user = User::where('email', $request['email'])->first();

        if (!$user || !Hash::check($request['old_password'], $user->password)) {
            return(response()->json(['errors' => 'Enter Your Right Password'], 403));
        }

        $user->password = bcrypt($request['password']);
        $user->update();

        $response = [
            'message' => 'Your Password Has Been Changed',
        ];

        return response($response, 201);


    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();
        return(response()->json(['errors' => 'Logged out'], 200));

    }
}
