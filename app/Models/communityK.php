<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class communityK extends Model
{
    use HasFactory;
    protected $table = 'communityK';
    protected $primaryKey = 'id_communityK';
    public $timestamps = false;


    public function user()
    {
        return $this->hasOne(usuario::class, 'id_user');
    }
}
