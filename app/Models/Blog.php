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


    protected static function booted()
    {
        static::deleted(function ($blog) {
            if ($blog->thumbnail != null) {
                Storage::disk('public')->delete('blogs/' . $blog->thumbnail);
            }
        });
    }

    public function getThumbnailContentAttribute()
    {
        return $this->thumbnail ? asset('storage/blogs/' . $this->thumbnail) : asset('img/default/products.png');
    }
}
