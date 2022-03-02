<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\Users\UserAddRequest;
use App\Http\Requests\Users\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\Apartement;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users =User::all();
        return UserResource::collection($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserAddRequest $request)
    {
        $request->validated();
        User::create($request->all());
        return(response()->json(['message' => 'User Stored Succesfully'], 201));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        if($user){
            return new UserResource($user);
        }
        else
        {
            return(response()->json(['errors' => 'User Not Found'], 404));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
        $request->validated();

        $user = User::find($id);
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->role = $request['role'];
        $user->password = bcrypt($request['password']);
        $user->gender = $request['gender'];
        $user->update();
        $response=[
            'message'=>'Data Update Successfully',
        ];

        return response($response,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return(response()->json(['message' => 'User Deleted Successfully'], 200));

    }

    public function getApartement($id){

        $apartements = User::find($id)->apartments;
        if ($apartements->isNotEmpty)
        {
            $response=[
                'data'=>$apartements
            ];

            return response($response,200);

        }
        else
        {
            return(response()->json(['errors' => 'User Donot Own Any Apartement'], 404));
        }
    }


}
