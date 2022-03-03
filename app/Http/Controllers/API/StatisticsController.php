<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

use App\Models\Apartement;
use App\Models\City;
use App\Models\Contact;
use App\Models\User;

class StatisticsController extends Controller
{

    public function count_total_users()
    {
        $total_users = User::all()->count();
        $response=['data'=>$total_users];
        return response($response,200);
    }

    public function count_admins()
    {
        $count_admins = User::where('role', 0)->count();
        $response=['data'=>$count_admins];
        return response($response,200);
    }

    public function count_users()
    {
        $count_users= User::where('role', 1)->count();
        $response=['data'=>$count_users];
        return response($response,200);
    }

    public function count_owners()
    {
        $count_owners = User::where('role', 2)->count();
        $response=['data'=>$count_owners];
        return response($response,200);

    }

    public function count_approved_apartements()
    {
        $count_approved_apartements = Apartement::where('approved', 1)->count();
        $response=['data'=>$count_approved_apartements];
        return response($response,200);
    }

    public function count_requested_apartements()
    {
        $count_requested_apartements= Apartement::where('approved', 0)->count();
        $response=['data'=>$count_requested_apartements];
        return response($response,200);
    }

    public function count_messages()
    {
        $count_messages= Contact::all()->count();
        $response=['data'=>$count_messages];
        return response($response,200);
    }
}
