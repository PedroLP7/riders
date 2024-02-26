<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class usuario extends Authenticatable{
    use HasFactory,HasApiTokens,Notifiable;


   protected $table = 'usuario';
    protected $primaryKey = 'id_user';
    public $timestamps = false;



    public function type_user()
    {
        return $this->belongsTo(user_type::class, 'user_type');
    }


    public function rider()
    {
        return $this->hasOne(rider::class, 'id_rider');
    }


    public function provider()
    {
        return $this->hasOne(provider::class, 'id_provider');
    }

    public function communityK()
    {
        return $this->hasOne(communityK::class, 'id_communityK');
    }

}
