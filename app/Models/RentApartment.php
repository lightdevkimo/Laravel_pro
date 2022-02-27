<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentApartment extends Model
{
    protected $table="rented_apartments";
    use HasFactory;

    protected $fillable=[
        'user_id',
        'apartment_id',
        'comments',
        'status'
    ];
}
