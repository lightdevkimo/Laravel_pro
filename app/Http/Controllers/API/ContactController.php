<?php

namespace App\Http\Controllers;
use App\Http\Resources\ContactResource;
use Illuminate\Http\Request;
use App\Models\Contact;

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
    public function store(Request $request)
    {
        $contact=Contact::save();
        return ContactResource::collection($contact);

    }


}
