<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Tags\HasTags;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;

class Album extends Model
{
    use HasFactory, HasTags, InteractsWithMedia;

    protected $connection = 'portfolio';

    protected $fillable = ['category_id', 'title', 'description'];
    
}
