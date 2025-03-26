<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use File;

class UpdateImage extends Model
{
    public function scopeclass($item, $path, $response){
        $photo = request()->photo;
        $photo->move($path, $photo->getClientOriginalName());

        $filename = public_path($path . $response->photo);
        if(File::exists($filename)) {
            File::delete($filename);
        }

        $response->photo = $photo->getClientOriginalName();
        return $response;
    }
}
