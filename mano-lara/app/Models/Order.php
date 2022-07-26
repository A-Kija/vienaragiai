<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Animal as A;

class Order extends Model
{
    use HasFactory;

    public function animal()
    {
        return $this->belongsTo(A::class, 'animal_id', 'id');
    }
}
