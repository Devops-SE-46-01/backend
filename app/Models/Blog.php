<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'thumbnail',
        'author',
    ];

    // protected $appends = ['thumbnail_content'];

    // protected static function booted()
    // {
    //     static::deleted(function ($product) {
    //         if ($product->image != null)
    //             Storage::disk('public')->delete('blogs/' . $product->rawImage);
    //     });
    // }

    // public function getThumbnailContentAttribute()
    // {
    //     return $this->attributes['thumbnail'] ? asset('storage/blogs/' . $this->attributes['thumbnail']) : asset('img/default/products.png');
    // }
}
