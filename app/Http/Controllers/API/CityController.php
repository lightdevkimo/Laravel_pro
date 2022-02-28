<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CityRequest;
use App\Http\Resources\CityResource;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index()
    {
        $city =City::all();
        return CityResource::collection($city);
    }


 
    public function show($id)
    {
        $city = City::find($id);
        return new CityResource($city);
    }

    
    public function store(CityRequest $request )
    {
        $request->validated();
        City::create($request->all());
        $response=[
            'message'=>'City Updated Successfully',
            'error'=>''
        ];
        return response($response,200);
       
    }



    public function update(CityRequest $request, $id)

    {   
        
        $request->validated();
        $city = City::find($id);
        $city->update($request->all());
        $response=[
            'message'=>'City Updated Successfully',
            'error'=>''
        ];
        return response($response,200);

    }

   
    public function destroy($id)
    {
        City::destroy($id);
        
        $response=[
            'message'=>'City Deleted Successfully',
            'error'=>''
        ];

        return response($response,200);;        
    }









    
}
