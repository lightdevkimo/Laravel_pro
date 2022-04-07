<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\RentedApartments\StoreRentApartmentRequest;
use App\Http\Requests\RentedApartments\UpdateRentApartmentRequest;
use App\Http\Resources\RentApartmentResources;
use App\Models\Apartement;
use App\Models\RentApartment;
use App\Models\User;
use Illuminate\Http\Request;

class RentApartmentController extends Controller
{
    public function index(Request $request)
    {
        $rent = RentApartment::query();

        if ($request->has('owner') && $request->has('status')) {
            $rent =  User::find($request['owner'])->rentedApartment->where('status', $request['status']);

            if ($rent->isNotEmpty()) {
                return RentApartmentResources::collection($rent);
            } else {

                return (response()->json(['errors' => 'No Renters Requests'], 404));
            }
        }

        if ($request->has('user') && $request->has('status')) {
            $rent = $rent->get()->where('user_id', $request['user'])->where('status', $request['status']);
            if ($rent->isNotEmpty()) {
                if ($rent->count() === 1) {

                return RentApartmentResources::collection($rent);

                } else {

                return RentApartmentResources::collection($rent);

                }
            } else {

                return (response()->json(['errors' => 'This User Does not have any request'], 404));
            }
        }


        $rent = $rent->get();

        if ($rent->isNotEmpty()) {
            return response([
                'data' => $rent
            ], 200);
        } else {

            return RentApartmentResources::collection($rent);

        }

    }




    public function store(StoreRentApartmentRequest $request)
    {
        $request->validated();
        //
        $user_gender = User::where('id', $request['user_id'])->first()['gender'];

        $apartment = Apartement::where('id', $request['apartment_id'])->first();

        if ($user_gender !== $apartment['gender']) {


            return (response()->json(['errors' => 'your gender is not match with requested apartment'], 404));
        }
        if ($apartment['available'] < 1) {
            return response([
                'data' => 'this apartment is full'
            ], 200);
        }
        //
        $isExist = RentApartment::where('user_id', '=', $request['user_id'])->where('apartment_id', '=', $request['apartment_id'])->get();

        if ($isExist->where('status', 'requested')->first()) {


            return (response()->json(['errors' => 'this user already request this apartment'], 404));
        }


        RentApartment::create($request->all());
        return response([
            'data' => 'your request successfully done'
        ], 200);
    }




    public function show(
        // StoreRentApartmentRequest $request,
        $rent_id
    ) {
        // $request->validated();
        $isExist = RentApartment::find($rent_id);
        if ($isExist) {
            return response([
                'data' => $isExist
            ], 200);
        }

        return (response()->json(['errors' => 'this rent not found'], 404));
    }


    public function edit($rent_id)
    {
        $isExist = RentApartment::find($rent_id);
        if ($isExist) {
            // $isExist->update('status', 'confirmed');
            $isExist->status = 'confirmed';
            $isExist->save();
            Apartement::where('id', $isExist['apartment_id'])
                ->decrement('available');
            return response([
                'data' => 'confirming done successfully'
            ], 200);
        }

        return (response()->json(['errors' => 'this rent not found'], 404));
    }




    public function destroy(Request $request, $rent_id)
    {
        $isExist = RentApartment::find($rent_id);
        if ($isExist) {
            //if ($isExist['status'] === 'requested') {

                Apartement::where('id','=',$isExist->apartment_id)->increment('available');
                RentApartment::destroy($rent_id);
                return response([
                    'data' => 'withdrawing / rejecting the request successfully'
                ], 200);
                /*
            } else {

                return (response()->json(['errors' => 'Can not withdraw / reject confirmed requests'], 404));
            }
                */
        }

        return (response()->json(['errors' => 'this rent is not found'], 404));
    }
}
