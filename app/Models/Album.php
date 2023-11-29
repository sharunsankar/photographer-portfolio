<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Tags\HasTags;

class Album extends Model
{
    use HasFactory, HasTags;

    protected $connection = 'portfolio';

    protected $fillable = ['category_id', 'title', 'description'];
    
}
