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
    protected $primaryKey = 'user_id';
    public $timestamps = false;



    public function user_type()
    {
        return $this->belongsTo(user_type::class, 'user_type_id');
    }

}
