<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'kode_invoice',
        'customer_id',
        'user_id',
        'quantity',
        'price',
        'type'
    ];

    // fungsi relasi untuk merelasikan order ke model OrderDetail
    public function orderDetail() {
        return $this->hasMany(OrderDetail::class);
    }
}
