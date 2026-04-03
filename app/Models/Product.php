<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'price', 'quantity', 'image', 'category_id', 'status'];
    public function category(){
        return $this->belongsTo(Category::class);
    }
}