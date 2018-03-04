<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['category_id','lm', 'name','free_shipping','description','price'];
}
