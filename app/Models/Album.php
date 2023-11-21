<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;

    protected $connection = 'portfolio';

    protected $fillable = ['category_id', 'title', 'cover_image', 'description'];
    
}
