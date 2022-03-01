<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use App\Http\Requests\ContactUs\ContactusRequest;

use App\Http\Resources\ContactResource;

use App\Models\Contact;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    //
    public function index()
    {
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        $contact =Contact::all();
        return ContactResource::collection($contact);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactusRequest $request)
    {
        $request->validated();
        return Contact::create($request->all());
    }
}
