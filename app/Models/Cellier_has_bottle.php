<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cellier_has_bottle extends Model
{
    protected $table = 'cellier_has_bottle';

    protected $fillable = [
        'Cellier_idCellier',
        'Bottle_id',
        'quantity',
        'a_commander',
        'bu',
        'updated_at',
        'created_at'
    ];
    }
