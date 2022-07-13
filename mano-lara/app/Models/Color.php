<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Animal as A;

class Color extends Model
{
    use HasFactory;

    public function animals()
    {
        return $this->hasMany(A::class, 'color_id', 'id');
    }
}
