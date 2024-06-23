<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'images',
        'category_id',
        'brand_id',
        'description',
        'price',
        'is_active',
        'is_featured',
        'in_stock',
        'on_sale'

    ];
    protected $casts = [
        'images' =>'array',
    ];
    public function category() {
        return $this->belongsTo(cotegary::class);
    }
    public function orderıtems() {
        return $this->hasMany(orderıtem::class);
    }
    public function Brand() {
        return $this->belongsTo(brand::class);
    }


}



