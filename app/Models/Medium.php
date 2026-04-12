<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medium extends Model
{
    use HasFactory;

    protected $table = 'mediums';
    protected $primaryKey = 'medium_id';

    protected $fillable = [
        'user_id',
        'board_id',
        'medium_name',
        'medium_code',
        'status',
    ];

    public function board()
    {
        return $this->belongsTo(Board::class, 'board_id', 'id');
    }
}
