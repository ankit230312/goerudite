<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Catalogue extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'catalogue_title',
        'publisher_brand_name',
        'academic_session',
        'applicable_board',
        'medium',
        'print_length',
        'published_on',
        'isbn_13',
        'isbn_10',
        'reading_age',
        'dimensions',
        'volume_part_numbers',
        'mrp',
        'category',
        'subcategory',
        'cover_file',
        'sample_file',
        'description',
        'confirmed',
    ];

    protected $casts = [
        'published_on' => 'date',
        'confirmed' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function mediumDetail()
    {
        return $this->belongsTo(Medium::class, 'medium', 'medium_id');
    }
}

