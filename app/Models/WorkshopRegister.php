<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkshopRegister extends Model
{
    use HasFactory;

    public $fillable = ['id_workshop', 'email', 'name', 'phone'];

    public function workshop()
    {
        return $this->hasOne(Workshop::class, "id", "id_workshop");
    }
}
