<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dealer extends Model
{
    protected $fillable = [
    'name', 'shop_name', 'email', 'phone', 'address', 
    'district', 'state', 'pincode', 'gst_no', 'pan_no', 'valid_from', 'valid_till', 'status'
];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // Sabse latest record uthana (Custom ID ke basis par)
            $lastDealer = self::orderBy('id', 'desc')->first();
            
            if (!$lastDealer || !$lastDealer->dealer_id_custom) {
                // Agar koi record nahi hai toh seedha 1001 se shuru karein
                $nextNumber = 1001;
            } else {
                // Last ID se 'KHDC' hata kar sirf number nikalna
                // filter_var isliye use kiya taaki agar string mein kuch aur ho toh sirf digits milein
                $lastId = $lastDealer->dealer_id_custom;
                $lastNumber = (int) filter_var($lastId, FILTER_SANITIZE_NUMBER_INT);
                
                // Agar kisi wajah se number 1001 se chota hai (jaise KHDC1), 
                // toh use automatically 1001 par le aao, warna increment karo.
                $nextNumber = ($lastNumber < 1001) ? 1001 : $lastNumber + 1;
            }

            // Naya ID set karna: KHDC + Number (e.g., KHDC1001)
            $model->dealer_id_custom = 'KHDC' . $nextNumber;
        });
    }
}