<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cellar extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'user_id',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    /* public function bottles()
    {
        return $this->belongsToMany(Bottle::class, 'cellar_bottle')
            ->using(CellarBottle::class)
            ->withTimestamps();
    } */

    public function bottles()
    {
        return $this->belongsToMany(Bottle::class, 'cellar_bottle')
            ->withTimestamps();
    }



}
