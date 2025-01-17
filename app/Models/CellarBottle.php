<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cellar;


class CellarBottle extends Model
{
    use HasFactory;

    protected $table = 'cellar_bottle';

    protected $fillable = [
        'cellar_id',
        'bottle_id',
        'quantity',
    ];

    public function hasBottleInUserCellar() {
      
         return CellarBottle::where('bottle_id', $this->id)->exists();
    }
}
