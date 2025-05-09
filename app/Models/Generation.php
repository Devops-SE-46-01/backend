<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Generation extends Model
{
    use HasFactory;
    public $fillable = ['name'];

    function member()
    {
        return $this->hasMany(Member::class, 'id_gen', 'id');
    }
}
