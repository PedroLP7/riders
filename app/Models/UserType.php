<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    use HasFactory;
    protected $table = 'customer';
    protected $primaryKey = 'type_id';
    
    public $timestamps = false;

    public function usuario()
    {
        return $this->hasOne(Usuario::class);
    }
}
