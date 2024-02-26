<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;
    protected $table = 'usuario';
    protected $primaryKey = 'id_user';
    public $timestamps = false;
    public function type()
    {
        return $this->belongsTo(UserType::class, "type_id");
    }
}
