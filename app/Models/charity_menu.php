<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class charity_menu extends Model
{
    use HasFactory;
    protected $table = 'charity_menu';
    protected $primaryKey = 'id_menu';
    public $timestamps = false;


    public function providers()
    {
        return $this->belongsToMany(provider::class, 'provider_has_menus','id_m', 'id_prov')->withPivot('quantity');
    }

    public function bookings()
    {
        return $this->hasMany(booking::class, 'id_menu_fk');
    }

}
