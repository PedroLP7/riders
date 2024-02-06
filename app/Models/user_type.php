<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_type extends Model
{
    use HasFactory;


    protected $table = 'user_type';
    protected $primaryKey = 'type_id';
    public $timestamps = false;


    public function usuarios()
    {
        return $this->hasMany(Usuario::class, 'user_type_id');
    }
}
