<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'record_name',
        'invoice_no',
        'purchase_date',
        'item_name',
        'gst_details',
        'delivery_status',
        'payment_status',
        'supplier',
        'quantity',
        'amount',
        'invoice_file',
        'return_file',
        'document_name',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
