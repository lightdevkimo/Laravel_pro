<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentApartmentRequest;
use App\Http\Requests\UpdateCommentApartmentRequest;
use App\Models\CommentApartment;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(StoreCommentApartmentRequest $request)
    {
        //
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
