<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RfqReceipt extends Model
{
    protected $fillable = [
        'rfq_id',
        'user_id',
        'received_at',
    ];

    protected $casts = [
        'received_at' => 'datetime',
    ];

    public function rfq()
    {
        return $this->belongsTo(Rfq::class, 'rfq_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
