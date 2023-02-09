<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavoriteComic extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'id',
        'comic_id',
        'user_id'
    ];

}
