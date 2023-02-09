<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comic extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
       'id',
       'name',
       'other_name',
       'introduction_content',
       'image',
       'user_id',
       'list_category',
       'active',
       'status',
        'cover_image',
        'author',
        'last_chapter'
    ];
}
