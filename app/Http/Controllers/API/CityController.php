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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CityRequest $request)
    {


        $data = $request->all();
        return   City::create($data);

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
        return $city;
    }


   /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function approve($id)
    {
        //
    }



   

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        return  City::destroy($id);
        
    }




     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search(CityRequest $request){
        //return 'hello';

        if ($request->has('name')){

            if($request->has('governorate'))
            {
                $data = City::where('name','like','%'.$request['name'].'%')->where('governorate','like','%'.$request['governorate'].'%')->get();
                $response=[
                    'data'=>$data,
                    'error'=>''
                ];
                return response($response,201);
            }
            else
            {
                $data = City::where('name','like','%'.$request['name'].'%')->get();
                $response=[
                    'data'=>$data,
                    'error'=>''
                ];
                return response($response,201);
            }
        }
      
        else
        {
            $response=[
                'data'=>'',
                'error'=>'You Missed Search '
            ];
            return response($response,400);
        }


    }




    
}
