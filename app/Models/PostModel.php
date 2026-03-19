<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostModel extends Model
{
    protected $fillable = ['title', 'content', 'image', 'category_id', 'status'];
}
