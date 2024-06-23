<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'grand_total',
        'payment_method',
        'payment_status',
        'currency',
        'shipping_amount',
        'shipping_method',
        'status',
        'notes'


    ];


    public function user() {
        return $this->belongsTo(User::class);
    }
    public function items() {
        return $this->hasMany(orderıtem::class);
    }
    public function adrres() {
        return $this->hasOne(adres::class);
    }

}
