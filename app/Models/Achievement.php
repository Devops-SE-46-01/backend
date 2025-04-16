<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    use HasFactory;
    public $fillable = [
        'photo', 'name', 'description', 'category',
        'generation', 'organizer', 'showcase', 'team', 'held'
    ];

    function teams()
    {
        return $this->hasMany(TeamAchievement::class, 'id_achievement', 'id');
    }
}
