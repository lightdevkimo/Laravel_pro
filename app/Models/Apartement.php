<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartement extends Model
{

    protected $table="apartments";
    use HasFactory;

    protected $fillable=[
        'approved',
        'description',
        'address',
        'price',
        'link',
        'gender',
        'images',
        'available',
        'max',
        'nearby',
        'owner_id',
        'city_id'
    ];

    public function users(){

        return $this->belongsTo(User::class,'owner_id');
    }

    public function city(){
        return $this->belongsTo(City::class,'city_id');
    }

}
