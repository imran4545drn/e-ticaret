<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class adres extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'first_name',
        'last_name',
        'phone',
        'street_adress',
        'city',
        'state',
        'zip_code'
    ];
    public function Order() {
        return $this->belongsTo(order::class);
    }
    public function getFullNameAttribute() {
        return "{$this->first_name} {$this->last_name}";
    }
}
