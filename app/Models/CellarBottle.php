<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CellarBottle extends Model
{
    use HasFactory;

    protected $table = 'cellar_bottle';

    protected $fillable = [
        'cellar_id',
        'bottle_id',
        'quantity',
    ];
}
