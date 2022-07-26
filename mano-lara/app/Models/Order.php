<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Animal as A;
use App\Models\User as U;

class Order extends Model
{
    use HasFactory;

    const STATUSES = [
        1 => 'New',
        2 => 'Das ist gut',
        3 => 'Canceled',
        4 => 'The End'
    ];

    public function animal()
    {
        return $this->belongsTo(A::class, 'animal_id', 'id');
    }

    public function client()
    {
        return $this->belongsTo(U::class, 'user_id', 'id');
    }
}
