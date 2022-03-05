<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Comments\StoreCommentApartmentRequest;
use App\Http\Requests\Comments\UpdateCommentApartmentRequest;
use App\Http\Resources\RentApartmentResources;
use App\Models\CommentApartment;
use App\Models\RentApartment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $comments = RentApartment::query();
        if($request->has('apartment'))
        {
            $comments = $comments->where('apartment_id', $request['apartment']);
        }
        if($request->has('user'))
        {
            $comments = $comments->where('user_id', $request['user']);
        }

        $comments= $comments->whereNotNull('comments')->get();
        if ($comments->isNotEmpty()){

            return RentApartmentResources::collection($comments);

        }
        else
        {
            $response=[
                'error'=>'No comments found.'
            ];

            return response($response,404);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCommentApartmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $comments = new RentApartment;
        if($request->has('apartment') && $request->has('user'))
        {
            $comments = $comments->where('apartment_id', $request['apartment'])->where('user_id', $request['user'])->where('status', 'confirmed');
        }
        else
        {
            $response=[
                'error'=>'Can not add comment from / on anonymous.'
            ];

            return response($response,402);
        }

        $comments= $comments->orderBy('created_at','desc')->first();
        if ($comments){
            $comments->comments = $request['comment'];
            $comments->save();
            $response=[
                'data'=>'Comment updated successfully!',
                'error'=>''
            ];

            return response($response,200);
        }
        else
        {
            $response=[
                'error'=>'You can not comment this apartment right now.'
            ];

            return response($response,404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CommentApartment  $commentApartment
     * @return \Illuminate\Http\Response
     */
    public function show(CommentApartment $commentApartment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CommentApartment  $commentApartment
     * @return \Illuminate\Http\Response
     */
    public function edit(CommentApartment $commentApartment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCommentApartmentRequest  $request
     * @param  \App\Models\CommentApartment  $commentApartment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCommentApartmentRequest $request, CommentApartment $commentApartment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CommentApartment  $commentApartment
     * @return \Illuminate\Http\Response
     */
    public function destroy(CommentApartment $commentApartment)
    {
        //
    }
}
