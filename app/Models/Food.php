<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;
    protected $table = "foods";
// columns inside the table
    protected $fillable = [
        'name',
        'price',
        'category',
        'description',
        'image'
    ];

    public $timestamps = true;
}
