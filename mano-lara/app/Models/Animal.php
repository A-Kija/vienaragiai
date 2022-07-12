<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Color as C;

class Animal extends Model
{
    use HasFactory;

    public function getThisAnimalsColor_plese()
    {
        return $this->belongsTo(C::class, 'color_id', 'id');
    }
}
