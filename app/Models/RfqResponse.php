<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RfqResponse extends Model
{
    protected $fillable = [
        'rfq_id',
        'responder_user_id',
        'responder_company_id',
        'responder_role',
        'indicative_unit_price',
        'total_indicative_value',
        'available_quantity',
        'delivery_from',
        'delivery_to',
        'stock_status',
        'additional_notes',
        'status',
        'submitted_at',
    ];

    public function rfq()
    {
        return $this->belongsTo(Rfq::class);
    }

    public function responder()
    {
        return $this->belongsTo(User::class, 'responder_user_id');
    }

    public function company()
    {
        return $this->belongsTo(User::class, 'responder_company_id');
    }
}
