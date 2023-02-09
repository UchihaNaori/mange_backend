<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShareComic extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'id',
        'owner',
        'user_id',
        'comic_id',
        'accept'
    ];
}
