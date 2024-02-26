<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rider extends Model
{
    use HasFactory;
    protected $table = 'rider';
    protected $primaryKey = 'id_rider';
    public $timestamps = false;
    public function user()
    {
        return $this->hasOne(usuario::class, 'id_user');
    }
}
