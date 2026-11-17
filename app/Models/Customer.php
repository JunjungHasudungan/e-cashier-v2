<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens; # penggunakan scantum untuk membuat token

class Customer extends Model {
    # menggunakan api token
    use HasApiTokens, HasFactory, Notifiable;
    # registrasi nama table customers
    protected $table = 'customers';
    # registrasi nama fields / kolom table
    protected $fillable = [
        'email',
        'password',
        'company_name',
        'contact_name',
        'address',
        'user_id',
        'city',
        'postal_code',
        'country',
        'phone'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
