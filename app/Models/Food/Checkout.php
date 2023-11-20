<?php

namespace App\Models\Food;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    use HasFactory;

    protected $table = "checkouts";

    protected $fillable = [
        'full_name',
        'email',
        'town',
        'country',
        'zip_code',
        'phone_number',
        'address',
        'user_id',
        'price',
        'status'
    ];
}
