<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    use HasFactory;
     protected $table = 'customer';
   protected $primaryKey = 'id_customer';
   public $timestamps = false;
   public function deliverys(){
    return $this->hasMany(delivery::class, 'id_customer_fk');
}
}
