<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // registrasi nama table products
    protected $table = "products";

    // registrasi nama field products
    protected $fillable = ['name', 'code', 'price', 'size'];

    // pembuatan nama fungsi relasi products ke table stocks
    public function stocks() {
        return $this->hasMany(Stock::class);
    }
}
