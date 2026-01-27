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
}
