<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRentApartmentRequest;
use App\Http\Requests\UpdateRentApartmentRequest;
use App\Http\Resources\RentApartment as RentApartmentResources;
use App\Models\Apartement;
use App\Models\RentApartment;
use App\Models\User;

class RentApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rent = RentApartment::all();
        return RentApartmentResources::collection($rent);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRentApartmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRentApartmentRequest $request)
    {
        $request->validated();
        $isExist = RentApartment::where('user_id', '=', $request['user_id'])->where('apartment_id', '=', $request['apartment_id'])->get();
        if ($isExist->isNotEmpty()) {

            return response([
                'error' => 'this user already rent this apartment'
            ], 402);
        }
        $user_gender = User::where('id', $request['user_id'])->first()['gender'];

        $apartment = Apartement::where('id', $request['apartment_id'])->first();

        if ($user_gender !== $apartment['gender']) {

            return response([
                'data' => 'your gender is not match with requested apartment'
            ], 402);
        }
        if ($apartment['available'] < 1) {
            return response([
                'data' => 'this apartment is full'
            ], 200);
        }
        RentApartment::create($request->all());
        Apartement::where('id', $request['apartment_id'])
            ->decrement('available');
        return response([
            'data' => 'your request successfully done'
        ], 200);
    }

    /* public function delete(StoreRentApartmentRequest $request)
    {
        $request->validated();
        $isExist = RentApartment::where('user_id', '=', $request['user_id'])->where('apartment_id', '=', $request['apartment_id'])->first();
        if ($isExist) {

            $isExist->delete();
            Apartement::where('id', $request['apartment_id'])
                ->increment('available');
            return response([
                'data' => 'withdrawing your request successfully'
            ], 200);
        }
        return response([
            'error' => 'this user did not rent this apartment'
        ], 402);
    } */

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RentApartment  $rentApartment
     * @return \Illuminate\Http\Response
     */
    public function show(
        // StoreRentApartmentRequest $request,
        $rent_id
    ) {
        // $request->validated();
        $isExist = RentApartment::find($rent_id);
        /* $isExist = RentApartment::where('user_id', '=', $request['user_id'])->where('apartment_id', '=', $request['apartment_id'])->first(); */
        if ($isExist) {

            return response([
                'data' => $isExist
            ], 200);
        }
        return response([
            'error' => 'this rent not found'
        ], 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RentApartment  $rentApartment
     * @return \Illuminate\Http\Response
     */
    public function edit($rent_id)
    {
        // $request->validated();
        $isExist = RentApartment::find($rent_id);
        // return $isExist;
        /* $isExist = RentApartment::where('user_id', '=', $request['user_id'])->where('apartment_id', '=', $request['apartment_id'])->first(); */
        if ($isExist) {
            // $isExist->update('status', 'confirmed');
            $isExist->status = 'confirmed';
            $isExist->save();
            return response([
                'data' => 'confirming done successfully'
            ], 200);
        }
        return response([
            'error' => 'this rent not found'
        ], 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRentApartmentRequest  $request
     * @param  \App\Models\RentApartment  $rentApartment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRentApartmentRequest $request, RentApartment $rentApartment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RentApartment  $rentApartment
     * @return \Illuminate\Http\Response
     */
    public function destroy($rent_id)
    {
        $isExist = RentApartment::find($rent_id);
        if ($isExist) {
            RentApartment::destroy($rent_id);
            Apartement::where('id', $isExist['apartment_id'])
                ->increment('available');
            return response([
                'data' => 'withdrawing your request successfully'
            ], 200);
        }
        return response([
            'error' => 'this user did not rent this apartment'
        ], 402);
    }
}
