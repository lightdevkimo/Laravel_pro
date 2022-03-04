<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cities\CityRequest;
use App\Http\Resources\CityResource;
use App\Models\Apartement;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index()
    {
        $city =City::all();
        return CityResource::collection($city);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $city = City::find($id);
        return new CityResource($city);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CityRequest $request)
    {
        $request->validated();
        City::create($request->all());
        $response=[
            'massage'=>'City Stored succesfully',
            'error'=>''
        ];
        return response($response,201);

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CityRequest $request, $id)
    {
        $city = City::find($id);
        $city->update($request->all());
        return response('Apartment updated succesfully',201);
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        City::destroy($id);
        return response('Apartment deleted succesfully',201);
    }


    public function governorate()
    {

        $data= City::distinct()->get(['governorate']);
        $response=[
            'data'=>$data,
            'error'=>''
        ];
        return response($response,200);

    }

    public function findcity($gov)
    {
        $data= City::where('governorate',$gov)->get();
        $response=[
            'data'=>$data,
            'error'=>''
        ];
        return response($response,200);
    }


    public function CityOfApartement($id)
    {
        $cities = Apartement::find($id)->city;
        return $cities;
    }




}
