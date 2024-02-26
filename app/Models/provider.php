<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class provider extends Model
{
    use HasFactory;
    protected $table = 'provider';
    protected $primaryKey = 'id_provider';
    public $timestamps = false;
    public function user()
    {
        return $this->hasOne(usuario::class, 'id_user');
    }



    public function menus()
    {
        return $this->belongsToMany(charity_menu::class, 'provider_has_menus','id_prov', 'id_m');
    }
    //quitar la cantidad del menu y ponerlo en la tabla del medio en SQL , luego ponerle el withpivot para que la enseñe tambien :)
}
