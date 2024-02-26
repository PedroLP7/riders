<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class booking_status extends Model
{
    use HasFactory;
    protected $table = 'booking_status';
    protected $primaryKey = 'id_status';
    public $timestamps = false;

    public function booking()
    {
        return $this->hasMany(booking::class, 'id_status_fk');
    }
}
