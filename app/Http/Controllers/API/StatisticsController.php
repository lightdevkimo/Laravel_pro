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


    public function count_admins()
    {
        return User::where('role', 0)->count();
    }

    public function count_users()
    {
        return User::where('role', 1)->count();
    }

    public function count_owners()
    {
        return User::where('role', 2)->count();

    }

    public function count_approved_apartements()
    {
        return Apartement::where('approved', 1)->count();
    }

    public function count_requested_apartements()
    {
        return Apartement::where('approved', 0)->count();
    }
}
