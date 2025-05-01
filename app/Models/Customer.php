<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model {
    use HasFactory;

    protected $fillable = [
        'customer_id', 'name', 'address1', 'address2', 'city',
        'state', 'zip', 'phone', 'email', 'business_type', 'preferred_days'
    ];

    protected $casts = [
        'preferred_days' => 'array',
    ];
}