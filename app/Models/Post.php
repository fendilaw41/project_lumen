<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{

    use HasFactory;

    protected $connection = 'mongodb';
    protected $collection = 'lumen';

    protected $primaryKey = '_id';

    protected $fillable = [
        'title', 'slug', 'body'
    ];

    
}
