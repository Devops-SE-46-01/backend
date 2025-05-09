<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public $fillable = ['photo', 'name', 'description', 'url', 'url_android', 'url_ios', 'creator', 'platform'];
}
