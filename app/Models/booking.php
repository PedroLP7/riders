<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class booking extends Model
{
    use HasFactory;
    protected $table = 'booking';
    protected $primaryKey = 'id_booking';
    public $timestamps = false;

    public function rider()
    {
        return $this->belongsTo(rider::class, 'id_rider_fk');
    }

    public function provider()
    {
        return $this->belongsTo(provider::class, 'id_provider_fk');
    }

    public function menu(){
        return $this->belongsTo(charity_menu::class, 'id_menu_fk');
    }

    public function status(){
        return $this->belongsTo(booking_status::class, 'id_status_fk');
    }


    public function delivery()
    {
        return $this->hasMany(delivery::class, 'id_booking_fk');
    }





}
