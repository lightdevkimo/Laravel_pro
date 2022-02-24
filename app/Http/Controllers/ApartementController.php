<?php

namespace App\Http\Controllers;

use App\Http\Resources\ApartementResource;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Apartement;
class ApartementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return Apartement::all();
        $apartement =Apartement::all();
        return ApartementResource::collection($apartement);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'gender'=>'required',
            'max'=>'required',
            'images'=>'required',
            'nearby'=>'required',
            'price'=> 'required',
            'address'=> 'required',
            'description'=> 'required',
            'owner_id'=>'required',
            'city_id'=>'required'
        ]);
        return Apartement::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $apartement = Apartement::find($id);
        return new ApartementResource($apartement);
    }


    public function search(Request $request)
    {

        $apartement = Apartement::query();

        if ($request->has('gender')) {

            $apartement = $apartement->where('gender', $request['gender']);
        }

        if ($request->has('max_price') && $request->has('min_price')) {

            $apartement = $apartement->whereBetween('price', [$request['min_price'], $request['max_price']]);

        }

        if ($request->has('city_id')) {

            $apartement = $apartement->where('city_id', $request['city_id']);

        }

        $apartement = $apartement->get();

        if ($apartement->isNotEmpty()){

            $response=[
                'data'=>$apartement,
                'error'=>''
            ];

            return response($response,200);
        }
        else
        {
            $response=[
                'error'=>'Not Found'
            ];

            return response($response,404);
        }


    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'gender'=>'required',
            'max'=>'required',
            'images'=>'required',
            'nearby'=>'required',
            'price'=> 'required',
            'address'=> 'required',
            'description'=> 'required'
        ]);
        return Apartement::create($request->all());
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Apartement::destroy($id);
    }
}
