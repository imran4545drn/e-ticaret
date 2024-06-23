<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orderıtem extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'unit_amount',
        'total_amount'


    ];
    public function orderr() {
        return $this->belongsTo(order::class);
    }
    public function Product() {
        return $this->belongsTo(product::class);
    }

}
