<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ApartementResource;
use App\Http\Requests\ApartementRequest;
use App\Http\Requests\ApartementUpdateRequest;
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
        $apartement =Apartement::all();
        return ApartementResource::collection($apartement);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ApartementRequest $request)
    {
        $request->validated();

        if ($request->hasFile('images')) {
            //dd('image');
            $completeFileName = $request->file('images')->getClientOriginalName();
            //dd($completeFileName);

            $fileNameOnly = pathinfo($completeFileName, PATHINFO_FILENAME);
            //dd($fileNameOnly);

            $extenshion = $request->file('images')->getClientOriginalExtension();
            //dd($extenshion);

            $compPic = str_replace('', '_', $fileNameOnly . '-' . rand() . '_' . time() . '.' . $extenshion);
            //dd($compPic);

            $path = $request->file('images')->storeAs('public/images', $compPic);
            //
            //dd($path);
            $request['images']->images = $path;
        }


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
        if($apartement){
            return new ApartementResource($apartement);
        }
        else
        {
            return response('No Data',404);
        }
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
    public function update(ApartementUpdateRequest $request, $id)
    {
        $request->validated();
        $apartement = Apartement::find($id);
        $apartement->update($request->all());
        $response=[
            'message'=>'Data Update Successfully',
            'error'=>''
        ];

        return response($response,200);
    }

    public function approve($id){

        $apartement = Apartement::find($id);

        $apartement->update(['approved','1']);

        $response=[
            'message'=>'Apartement Approved Successfully',
            'error'=>''
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
        Apartement::destroy($id);
        $response=[
            'message'=>'Date Deleted Successfully',
            'error'=>''
        ];
        return response($response,200);
    }
}
