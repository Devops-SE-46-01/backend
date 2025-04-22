<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamAchievement extends Model
{
    use HasFactory;
    public $fillable = ['photo', 'id_achievement', 'name', 'nim', 'major', 'generation'];
}
