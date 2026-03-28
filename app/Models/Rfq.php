<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rfq extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'school_name',
        'city',
        'target_roles',
        'target_state',
        'target_city',
        'academic_session',
        'books',
        'delivery_from',
        'delivery_to',
        'urgency',
        'evaluation_criteria',
        'rfq_closing_date',
        'notes',
        'confirmed',
        'status'
    ];

    protected $casts = [
        'books' => 'array',
        'target_roles' => 'array',
        'evaluation_criteria' => 'array',
        'delivery_from' => 'date',
        'delivery_to' => 'date',
        'rfq_closing_date' => 'date',
        'confirmed' => 'boolean'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function receipts()
    {
        return $this->hasMany(RfqReceipt::class, 'rfq_id');
    }

    public function responses()
    {
        return $this->hasMany(RfqResponse::class, 'rfq_id');
    }
}

