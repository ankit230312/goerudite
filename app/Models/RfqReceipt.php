<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RfqReceipt extends Model
{
    use HasFactory;

    protected $fillable = [
        'rfq_id',
        'user_id',
        'received_at',
    ];

    protected $casts = [
        'received_at' => 'datetime',
    ];
}
