<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class delivery extends Model
{
    use HasFactory;
    protected $table = 'delivery';
    protected $primaryKey = 'id_delivery';
    public $timestamps = false;




    public function bookings(){
        return $this->belongsTo(booking::class, 'id_booking_fk');
    }

   public function customerK(){
    return $this->belongsTo(communityK::class, 'id_communityK_fk');


   }

   public function customer(){
    return $this->belongsTo(customer::class, 'id_customer_fk');
}
}
